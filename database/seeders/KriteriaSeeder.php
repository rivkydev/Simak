<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        // Sesuai Tabel 2.2 Proposal Skripsi
        $kriteria = [
            [
                'id_kelurahan' => 1, // Sesuaikan ID kelurahan
                'nama_kriteria' => 'Jenis Surat',
                'atribut' => 'benefit', // Semakin penting jenisnya, semakin tinggi nilainya
                'bobot' => 0.50, // Bobot 50%
            ],
            [
                'id_kelurahan' => 1,
                'nama_kriteria' => 'Lama Menunggu (Tanggal)',
                'atribut' => 'benefit', // Semakin lama menunggu, semakin prioritas
                'bobot' => 0.30, // Bobot 30%
            ],
            [
                'id_kelurahan' => 1,
                'nama_kriteria' => 'Status Surat',
                'atribut' => 'cost', // (Atau benefit tergantung logika, disini kita pakai logika: Belum diproses = nilai tinggi)
                'bobot' => 0.20, // Bobot 20%
            ],
        ];

        DB::table('kriterias')->insert($kriteria);
    }
}