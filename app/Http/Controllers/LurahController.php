<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;
use App\Models\InformasiUmkm;
use App\Models\Kriteria;
use App\Models\JenisSuratSetting; // Model Baru
use Carbon\Carbon;

class LurahController extends Controller
{
    public function index(Request $request)
    {
        // --- 1. OTENTIKASI ---
        $pegawai = Auth::guard('pegawai')->user();
        $pegawai->load('kelurahan');
        $idKelurahan = $pegawai->id_kelurahan;

        // --- 2. STATISTIK ---
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

        // --- 3. QUERY DATA ---
        $query = Surat::where('id_kelurahan', $idKelurahan)
            ->where(function($q) {
                $q->whereNull('status_verifikasi')
                  ->orWhere('status_verifikasi', 'menunggu');
            });

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_pemohon', 'LIKE', "%{$request->search}%");
        }
        if ($request->has('jenis_surat') && $request->jenis_surat != '') {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        // --- 4. LOGIKA WSM (SKRIPSI) ---
        $gunakanWSM = $request->has('filter_wsm') && $request->filter_wsm == '1';

        if ($gunakanWSM) {
            // A. AMBIL BOBOT KRITERIA
            $k_waktu   = Kriteria::where('id_kelurahan', $idKelurahan)->where('atribut', 'lama_menunggu')->first();
            $k_urgensi = Kriteria::where('id_kelurahan', $idKelurahan)->where('atribut', 'urgensi')->first();
            $k_status  = Kriteria::where('id_kelurahan', $idKelurahan)->where('atribut', 'status_surat')->first();

            $b_waktu   = $k_waktu ? $k_waktu->bobot : 0;
            $b_urgensi = $k_urgensi ? $k_urgensi->bobot : 0;
            $b_status  = $k_status ? $k_status->bobot : 0;

            // B. AMBIL SETTINGAN NILAI JENIS SURAT (DINAMIS DARI DB)
            // Mengambil semua settingan surat untuk kelurahan ini dan menjadikannya array [ 'Jenis A' => 100, 'Jenis B' => 80 ]
            $settingSurat = JenisSuratSetting::where('id_kelurahan', $idKelurahan)
                            ->pluck('nilai', 'jenis_surat')
                            ->toArray();

            $suratRaw = $query->get();

            // C. PERHITUNGAN SKOR
            $suratMasuk = $suratRaw->map(function ($surat) use ($b_waktu, $b_urgensi, $b_status, $settingSurat) {
                
                // 1. Nilai Waktu (Benefit)
                $hari = Carbon::parse($surat->created_at)->diffInDays(now());
                $n_waktu = ($hari >= 7) ? 100 : (($hari >= 3) ? 75 : (($hari >= 1) ? 50 : 25));

                // 2. Nilai Jenis Surat (Benefit) - DIAMBIL DARI DB
                // Jika jenis surat ada di database, pakai nilainya. Jika tidak, default 50.
                $n_urgensi = $settingSurat[$surat->nama_surat] ?? 50; 

                // 3. Nilai Status (Cost/Logic)
                $n_status = ($surat->status_verifikasi === null || $surat->status_verifikasi == 'menunggu') ? 100 : 20;

                // Rumus WSM
                $surat->skor_wsm = ($n_waktu * $b_waktu) + 
                                   ($n_urgensi * $b_urgensi) + 
                                   ($n_status * $b_status);
                
                return $surat;
            });

            $suratMasuk = $suratMasuk->sortByDesc('skor_wsm');

        } else {
            $suratMasuk = $query->latest()->get();
        }

        // Data Grafik & View
        $statusData = [
            'Menunggu' => $jumlahMenunggu,
            'Disetujui' => $jumlahDisetujui,
            'Ditolak' => Surat::where('id_kelurahan', $idKelurahan)->where('status_verifikasi', 'ditolak')->count(),
        ];
        
        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'values' => [2, 4, 3, 5, 6, 3, 4, 5, 2, 4, 3, 5], 
        ];

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

    // --- HALAMAN PENGATURAN (BOBOT & NILAI SURAT) ---
    public function pengaturanBobot()
    {
        $pegawai = Auth::guard('pegawai')->user();
        
        // Ambil Data Kriteria
        $kriterias = Kriteria::where('id_kelurahan', $pegawai->id_kelurahan)->get();

        // Ambil Data Nilai Jenis Surat
        $jenisSurat = JenisSuratSetting::where('id_kelurahan', $pegawai->id_kelurahan)->get();
        
        return view('lurah.pengaturan_bobot', compact('pegawai', 'kriterias', 'jenisSurat'));
    }

    public function updateBobot(Request $request)
    {
        $pegawai = Auth::guard('pegawai')->user();

        // 1. Update Bobot Kriteria
        if ($request->has('bobot')) {
            foreach ($request->bobot as $id => $nilai) {
                Kriteria::where('id', $id)
                        ->where('id_kelurahan', $pegawai->id_kelurahan)
                        ->update(['bobot' => $nilai]);
            }
        }

        // 2. Update Nilai Jenis Surat (Fitur Baru)
        if ($request->has('nilai_surat')) {
            foreach ($request->nilai_surat as $id => $nilai) {
                JenisSuratSetting::where('id', $id)
                        ->where('id_kelurahan', $pegawai->id_kelurahan)
                        ->update(['nilai' => $nilai]);
            }
        }

        return back()->with('success', 'Pengaturan prioritas berhasil diperbarui!');
    }

    public function umkm()
    {   
        return view('lurah.umkm');
    }
}