<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;
use App\Models\InformasiUmkm;
use Carbon\Carbon;

class LurahController extends Controller
{
    /**
     * IMPLEMENTASI SKRIPSI:
     * * RUMUSAN MASALAH [Halaman 17]:
     * 1. Bagaimana penerapan metode WSM membantu menentukan prioritas surat masuk pada SIMAK?
     * 2. Seberapa efektif penerapan WSM dalam meningkatkan efisiensi pengelolaan surat?
     * * TUJUAN PENELITIAN [Halaman 18]:
     * - Menerapkan metode Weighted Scoring Model (WSM) pada SIMAK untuk menentukan 
     * prioritas surat masuk secara objektif dan terukur.
     * * BATASAN MASALAH [Halaman 17]:
     * - Fokus pada Admin, Sekretaris Lurah, dan Lurah.
     * - Kriteria: Jenis Surat, Tanggal Masuk, dan Status Surat.
     */
    public function index(Request $request)
    {
        // --- 1. OTENTIKASI & DATA PEGAWAI ---
        $pegawai = Auth::guard('pegawai')->user();
        if (!$pegawai->relationLoaded('kelurahan')) {
            $pegawai->load('kelurahan');
        }
        $idKelurahan = $pegawai->id_kelurahan;

        // --- 2. STATISTIK DASHBOARD ---
        $jumlahDisetujui = Surat::where('id_kelurahan', $idKelurahan)->where('status_verifikasi', 'diterima')->count();
        $jumlahMenunggu = Surat::where('id_kelurahan', $idKelurahan)->whereNull('status_verifikasi')->count();
        $jumlahUMKM = class_exists('App\Models\InformasiUmkm') 
            ? InformasiUmkm::where('id_kelurahan', $idKelurahan)->count() 
            : 0;

        $statistik = [
            ['label' => 'Surat Disetujui', 'value' => $jumlahDisetujui, 'icon' => 'suratDisetujui.png'],
            ['label' => 'Surat Menunggu', 'value' => $jumlahMenunggu, 'icon' => 'suratMenunggu.png'],
            ['label' => 'Jumlah UMKM', 'value' => $jumlahUMKM, 'icon' => 'UMKM.png'],
        ];

        // --- 3. PENGAMBILAN DATA & FILTER ---
        $query = Surat::where('id_kelurahan', $idKelurahan);

        // Fitur Search (Nama/Jenis)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_pemohon', 'LIKE', "%{$search}%")
                  ->orWhere('jenis_surat', 'LIKE', "%{$search}%");
            });
        }

        // Fitur Filter Jenis Surat
        if ($request->has('jenis_surat') && $request->jenis_surat != '') {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        $suratMasuk = $query->get();

        // ==================================================================================
        // IMPLEMENTASI METODE WEIGHTED SCORING MODEL (WSM)
        // Referensi: Bab II Tinjauan Pustaka, Halaman 25-26
        // Rumus: Si = Sum(wj * xij)
        // ==================================================================================

        $suratMasuk->transform(function ($item) {
            
            // --- KRITERIA 1: JENIS SURAT (C1) ---
            // Bobot (w1): 0.50 [Lihat Tabel 2.2 Halaman 26]
            // "Surat yang berdampak langsung terhadap pelayanan publik diberikan nilai lebih tinggi"
            
            $c1_nilai = match ($item->jenis_surat) {
                'Surat Keterangan Domisili Usaha' => 5, // Poin tertinggi di Tabel 2.2
                'Surat Keterangan Belum Menikah' => 4,  // Poin 4 di Tabel 2.2
                'Surat Keterangan Domisili' => 4,       // Poin 4 di Tabel 2.2
                'Surat Keterangan Tempat Tinggal' => 3, // Poin 3 di Tabel 2.2
                'Surat Keterangan Penghasilan Orang Tua' => 3, // Poin 3 di Tabel 2.2
                default => 2, // Default untuk surat lain yang tidak terdaftar
            };

            // --- KRITERIA 2: TANGGAL SURAT MASUK (C2) ---
            // Bobot (w2): 0.30 [Lihat Tabel 2.2 Halaman 26]
            // Teori: "Semakin lama surat menunggu... tingkat urgensinya semakin tinggi" [Halaman 26]
            
            $hariBerjalan = Carbon::parse($item->created_at)->diffInDays(now());
            
            if ($hariBerjalan > 7) {
                $c2_nilai = 5;      // Sangat Mendesak (> 1 Minggu)
            } elseif ($hariBerjalan >= 5) {
                $c2_nilai = 4;      // Mendesak (5-7 Hari)
            } elseif ($hariBerjalan >= 3) {
                $c2_nilai = 3;      // Cukup Mendesak (3-5 Hari)
            } elseif ($hariBerjalan >= 1) {
                $c2_nilai = 2;      // Baru (1-3 Hari)
            } else {
                $c2_nilai = 1;      // Sangat Baru (Hari ini)
            }

            // --- KRITERIA 3: STATUS SURAT (C3) ---
            // Bobot (w3): 0.20 [Lihat Tabel 2.2 Halaman 26]
            // Teori: "Surat yang baru masuk atau belum diproses akan mendapat prioritas lebih tinggi" [Halaman 26]
            
            if ($item->status_verifikasi === null) {
                $c3_nilai = 5; // Belum diproses (Prioritas Tinggi)
            } else {
                $c3_nilai = 1; // Sudah diproses/Selesai (Prioritas Rendah)
            }

            // --- PERHITUNGAN SKOR TOTAL (Si) ---
            // Rumus (2-1) Halaman 25: Si = Sum(wj * xij)
            
            $w1 = 0.50;
            $w2 = 0.30;
            $w3 = 0.20;

            $skor_total = ($w1 * $c1_nilai) + ($w2 * $c2_nilai) + ($w3 * $c3_nilai);
            
            // Simpan skor ke objek item untuk ditampilkan/diurutkan
            $item->wsm_score = $skor_total;
            
            // Debugging (Opsional, untuk melihat detail perhitungan di view jika diperlukan)
            $item->wsm_detail = "C1:{$c1_nilai} x {$w1} + C2:{$c2_nilai} x {$w2} + C3:{$c3_nilai} x {$w3}";

            return $item;
        });

        // --- 4. PENGURUTAN BERDASARKAN PRIORITAS (HASIL PENELITIAN) ---
        // Sesuai Tujuan Penelitian: "Menentukan prioritas surat masuk secara objektif"
        // Data selalu diurutkan dari Skor WSM Tertinggi ke Terendah
        $suratMasuk = $suratMasuk->sortByDesc('wsm_score');

        // Data Grafik (Visualisasi)
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
        ]);
    }

    public function umkm()
    {   
        return view('lurah.umkm');
    }
}