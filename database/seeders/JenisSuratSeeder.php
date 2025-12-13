<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kelurahan;

class JenisSuratSeeder extends Seeder
{
    public function run()
    {
        // =================================================================
        // DAFTAR NILAI JENIS SURAT (Edit di sini jika ada revisi)
        // Konversi: 5->100, 4->80, 3->60, 2->40 (Default)
        // =================================================================
        $daftarNilai = [
            // Poin 5 (Sangat Tinggi)
            'Surat Keterangan Domisili Usaha' => 100, 
            
            // Poin 4 (Tinggi)
            'Surat Keterangan Belum Menikah' => 80,
            'Surat Keterangan Domisili'      => 80,
            
            // Poin 3 (Sedang)
            'Surat Keterangan Tempat Tinggal'        => 60,
            'Surat Keterangan Penghasilan Orang Tua' => 60,
            'Surat Keterangan Ahli Waris'            => 60, // Asumsi setara

            // Poin 2 (Default / Rendah)
            'Surat Keterangan Kematian' => 40, // Default (Sesuai kode match Anda yg tidak memasukkan ini)
        ];

        // Nilai Default untuk surat yang tidak terdaftar di atas
        $nilaiDefault = 40; 

        // =================================================================

        $kelurahans = Kelurahan::all();

        // Daftar lengkap semua kemungkinan surat di sistem (dari PelayananController)
        $semuaJenisSurat = [
            'Surat Keterangan Domisili Usaha',
            'Surat Keterangan Kematian',
            'Surat Keterangan Belum Menikah',
            'Surat Keterangan Tempat Tinggal',
            'Surat Keterangan Ahli Waris',
            'Surat Keterangan Penghasilan Orang Tua',
            'Surat Keterangan Domisili' // Tambahan dari kode Anda
        ];

        foreach ($kelurahans as $kel) {
            // Hapus data lama biar bersih
            DB::table('jenis_surat_settings')->where('id_kelurahan', $kel->id_kelurahan)->delete();

            foreach ($semuaJenisSurat as $jenis) {
                // Ambil nilai dari array $daftarNilai, jika tidak ada pakai $nilaiDefault
                $nilai = $daftarNilai[$jenis] ?? $nilaiDefault;

                DB::table('jenis_surat_settings')->insert([
                    'id_kelurahan' => $kel->id_kelurahan,
                    'jenis_surat'  => $jenis,
                    'nilai'        => $nilai,
                    'created_at'   => now(), 
                    'updated_at'   => now()
                ]);
            }
        }
    }
}