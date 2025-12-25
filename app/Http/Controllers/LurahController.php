<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Pastikan nama model sesuai dengan file Anda (Case Sensitive)
use App\Models\Surat; 
use App\Models\InformasiUmkm;
use App\Models\Kriteria;
use App\Models\JenisSuratSetting;
use Carbon\Carbon;
use App\Helpers\PdfSigner;
use Illuminate\Support\Facades\Storage;

class LurahController extends Controller
{
    public function index(Request $request)
{
    // 1. OTENTIKASI & DATA PEGAWAI
    $pegawai = Auth::guard('pegawai')->user();
    if (!$pegawai->relationLoaded('kelurahan')) {
        $pegawai->load('kelurahan');
    }
    $idKelurahan = $pegawai->id_kelurahan;

    // 2. STATISTIK (Header Dashboard)
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

    // 3. CHART DATA
    $dataPerBulan = array_fill(1, 12, 0); 
    $suratDb = Surat::where('id_kelurahan', $idKelurahan)
        ->whereYear('created_at', date('Y'))
        ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
        ->groupBy('bulan')
        ->pluck('total', 'bulan');

    foreach ($suratDb as $bulan => $total) {
        $dataPerBulan[$bulan] = $total;
    }

    $chartData = [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        'values' => array_values($dataPerBulan),
    ];

    $statusData = [
        'Menunggu' => $jumlahMenunggu,
        'Disetujui' => $jumlahDisetujui,
        'Ditolak' => Surat::where('id_kelurahan', $idKelurahan)->where('status_verifikasi', 'ditolak')->count(),
    ];

    // 4. QUERY UTAMA SURAT (SEMUA SURAT - TAMPILKAN SEMUA)
    $query = Surat::where('id_kelurahan', $idKelurahan);

    // Filter Pencarian
    if ($request->has('search') && $request->search != '') {
        $query->where('nama_pemohon', 'LIKE', "%{$request->search}%");
    }
    if ($request->has('jenis_surat') && $request->jenis_surat != '') {
        $query->where('jenis_surat', $request->jenis_surat);
    }

    // 5. LOGIKA WSM (Weighted Scoring Model)
    $gunakanWSM = $request->has('filter_wsm') && $request->filter_wsm == '1';

    if ($gunakanWSM) {
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

        // Sort: Menunggu di atas (skor tinggi), sudah diproses di bawah (skor rendah)
        $suratMasuk = $suratMasuk->sortByDesc('skor_wsm');
    } else {
        // TANPA WSM: Urutkan berdasarkan status dan tanggal
        // Menunggu di atas, sudah diproses di bawah
        $suratMasuk = $query->orderByRaw("
            CASE 
                WHEN status_verifikasi IS NULL OR status_verifikasi = 'menunggu' THEN 0
                ELSE 1
            END
        ")->latest()->get();
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

    // --- FITUR VERIFIKASI SURAT ---
    public function verifikasiSurat(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:diterima,ditolak'
    ]);

    $surat = Surat::findOrFail($id);
    $pegawai = Auth::guard('pegawai')->user();
    
    // Update status verifikasi
    $surat->status_verifikasi = $request->status;
    $surat->verified_by = $pegawai->id_pegawai;
    $surat->verified_at = now();
    
    // Jika disetujui, tambahkan tanda tangan ke PDF
    if ($request->status === 'diterima' && $surat->file_surat) {
    try {
        $originalPdfPath = storage_path('app/public/' . $surat->file_surat);
        $signaturePath = public_path('signatures/bahrul_signature.png'); // Path gambar signature
        
        // Panggil PdfSigner (hanya tambah gambar)
        $signedPdfPath = PdfSigner::addSignature($originalPdfPath, $signaturePath, $pegawai->nama, $pegawai->nip ?? '-');
        
        // Backup PDF unsigned (optional)
        $backupPath = str_replace('.pdf', '_unsigned.pdf', $surat->file_surat);
        Storage::copy('public/' . $surat->file_surat, 'public/' . $backupPath);
        
        // Replace dengan signed
        Storage::put('public/' . $surat->file_surat, file_get_contents($signedPdfPath));
        
        // Hapus temp
        if (file_exists($signedPdfPath)) {
            unlink($signedPdfPath);
        }
    } catch (\Exception $e) {
        \Log::error('Failed to add signature: ' . $e->getMessage());
        // Lanjutkan verifikasi meski gagal tambah signature
    }
}
    
    $surat->save();

    $pesan = $request->status == 'diterima' 
        ? 'Surat berhasil disetujui dan ditandatangani.' 
        : 'Surat telah ditolak.';
        
    return back()->with('success', $pesan);
}

    // --- PENGATURAN BOBOT ---
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

    public function umkm() { 
        return view('lurah.umkm'); 
    }
}