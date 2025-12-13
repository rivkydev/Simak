<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;
use App\Models\InformasiUmkm;
use App\Models\Kriteria;
use App\Models\JenisSuratSetting;
use Carbon\Carbon;

class LurahController extends Controller
{
    public function index(Request $request)
    {
        // --- 1. OTENTIKASI ---
        $pegawai = Auth::guard('pegawai')->user();
        if (!$pegawai->relationLoaded('kelurahan')) {
            $pegawai->load('kelurahan');
        }
        $idKelurahan = $pegawai->id_kelurahan;

        // --- 2. STATISTIK (Chart Data Real-time dari Database) ---
        
        // A. Statistik Kartu
        $jumlahDisetujui = Surat::where('id_kelurahan', $idKelurahan)->where('status_verifikasi', 'diterima')->count();
        $jumlahMenunggu = Surat::where('id_kelurahan', $idKelurahan)->where(function($q){
            $q->whereNull('status_verifikasi')->orWhere('status_verifikasi', 'menunggu');
        })->count();
        $jumlahUMKM = InformasiUmkm::where('id_kelurahan', $idKelurahan)->count();

        $statistik = [
            ['label' => 'Surat Disetujui', 'value' => $jumlahDisetujui, 'icon' => 'suratDisetujui.png'],
            ['label' => 'Surat Menunggu', 'value' => $jumlahMenunggu, 'icon' => 'suratMenunggu.png'],
            ['label' => 'Jumlah UMKM', 'value' => $jumlahUMKM, 'icon' => 'UMKM.png'],
        ];

        // B. Data Grafik Tren Surat Masuk (Per Bulan di Tahun Ini) [REQUEST 1]
        $dataPerBulan = array_fill(1, 12, 0); // Siapkan array bulan 1-12 dengan nilai 0

        $suratDb = Surat::where('id_kelurahan', $idKelurahan)
            ->whereYear('created_at', date('Y')) // Filter tahun sekarang
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        foreach ($suratDb as $bulan => $total) {
            $dataPerBulan[$bulan] = $total;
        }

        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'values' => array_values($dataPerBulan), // Data Asli dari DB
        ];

        // C. Data Grafik Status (Donat)
        $statusData = [
            'Menunggu' => $jumlahMenunggu,
            'Disetujui' => $jumlahDisetujui,
            'Ditolak' => Surat::where('id_kelurahan', $idKelurahan)->where('status_verifikasi', 'ditolak')->count(),
        ];

        // --- 3. QUERY DATA TABEL ---
        $query = Surat::where('id_kelurahan', $idKelurahan)
            ->where(function($q) {
                $q->whereNull('status_verifikasi')
                  ->orWhere('status_verifikasi', 'menunggu');
            });

        // Filter Search
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_pemohon', 'LIKE', "%{$request->search}%");
        }
        if ($request->has('jenis_surat') && $request->jenis_surat != '') {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        // --- 4. LOGIKA WSM ---
        $gunakanWSM = $request->has('filter_wsm') && $request->filter_wsm == '1';

        if ($gunakanWSM) {
            // Ambil Bobot & Settingan
            $k_waktu   = Kriteria::where('id_kelurahan', $idKelurahan)->where('atribut', 'lama_menunggu')->first();
            $k_urgensi = Kriteria::where('id_kelurahan', $idKelurahan)->where('atribut', 'urgensi')->first();
            $k_status  = Kriteria::where('id_kelurahan', $idKelurahan)->where('atribut', 'status_surat')->first();

            $b_waktu   = $k_waktu ? $k_waktu->bobot : 0;
            $b_urgensi = $k_urgensi ? $k_urgensi->bobot : 0;
            $b_status  = $k_status ? $k_status->bobot : 0;

            $settingSurat = JenisSuratSetting::where('id_kelurahan', $idKelurahan)
                            ->pluck('nilai', 'jenis_surat')->toArray();

            $suratRaw = $query->get();

            $suratMasuk = $suratRaw->map(function ($surat) use ($b_waktu, $b_urgensi, $b_status, $settingSurat) {
                $hari = Carbon::parse($surat->created_at)->diffInDays(now());
                $n_waktu = ($hari >= 7) ? 100 : (($hari >= 3) ? 75 : (($hari >= 1) ? 50 : 25));
                $n_urgensi = $settingSurat[$surat->nama_surat] ?? 50; 
                $n_status = ($surat->status_verifikasi === null || $surat->status_verifikasi == 'menunggu') ? 100 : 20;

                $surat->skor_wsm = ($n_waktu * $b_waktu) + ($n_urgensi * $b_urgensi) + ($n_status * $b_status);
                return $surat;
            });

            $suratMasuk = $suratMasuk->sortByDesc('skor_wsm');
        } else {
            $suratMasuk = $query->latest()->get();
        }

        return view('lurah.dashboard', [
            'pegawai' => $pegawai,
            'statistik' => $statistik,
            'suratMasuk' => $suratMasuk,
            'statusData' => $statusData,
            'chartData' => $chartData,
            'currentSearch' => $request->search,
            'currentJenis' => $request->jenis_surat,
            'gunakanWSM' => $gunakanWSM,
        ]);
    }

    // --- FITUR BARU: VERIFIKASI SURAT (TERIMA/TOLAK) [REQUEST 2] ---
    public function verifikasiSurat(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak'
        ]);

        $surat = Surat::findOrFail($id);
        
        // Update status
        $surat->status_verifikasi = $request->status;
        $surat->save();

        $pesan = $request->status == 'diterima' ? 'Surat berhasil disetujui.' : 'Surat telah ditolak.';
        return back()->with('success', $pesan);
    }

    // Method lain (umkm, pengaturanBobot, updateBobot) tetap sama...
    public function pengaturanBobot()
    {
        $pegawai = Auth::guard('pegawai')->user();
        $kriterias = Kriteria::where('id_kelurahan', $pegawai->id_kelurahan)->get();
        $jenisSurat = JenisSuratSetting::where('id_kelurahan', $pegawai->id_kelurahan)->get();
        return view('lurah.pengaturan_bobot', compact('pegawai', 'kriterias', 'jenisSurat'));
    }

    public function updateBobot(Request $request)
    {
        $pegawai = Auth::guard('pegawai')->user();
        if ($request->has('bobot')) {
            foreach ($request->bobot as $id => $nilai) {
                Kriteria::where('id', $id)->where('id_kelurahan', $pegawai->id_kelurahan)->update(['bobot' => $nilai]);
            }
        }
        if ($request->has('nilai_surat')) {
            foreach ($request->nilai_surat as $id => $nilai) {
                JenisSuratSetting::where('id', $id)->where('id_kelurahan', $pegawai->id_kelurahan)->update(['nilai' => $nilai]);
            }
        }
        return back()->with('success', 'Pengaturan prioritas berhasil diperbarui!');
    }

    public function umkm() { return view('lurah.umkm'); }
}