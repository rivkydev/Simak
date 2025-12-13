<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiKontakSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id_kelurahan' => 8,
                'jenis_kontak' => 'Alamat',
                'informasi_kontak' => 'Jl. Bau Massepe No.151, Bacukiki Barat, Parepare',
            ],
            [
                'id_kelurahan' => 8,
                'jenis_kontak' => 'Email',
                'informasi_kontak' => 'kel.lumpue@gmail.com',
            ],
            [
                'id_kelurahan' => 8,
                'jenis_kontak' => 'Telepon',
                'informasi_kontak' => '(0421) 123456',
            ],
            [
                'id_kelurahan' => 8,
                'jenis_kontak' => 'wa',
                'informasi_kontak' => '+6281234567890',
            ],
            [
                'id_kelurahan' => 8,
                'jenis_kontak' => 'jam kerja',
                'informasi_kontak' => 'Senin - Jumat, 08.30 – 17.30 WITA',
            ],
        ];

        foreach ($data as $item) {
            DB::table('informasi_kontak')->insert([
                'id_kelurahan' => $item['id_kelurahan'],
                'jenis_kontak' => $item['jenis_kontak'],
                'informasi_kontak' => $item['informasi_kontak'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}