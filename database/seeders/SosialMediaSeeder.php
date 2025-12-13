<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SosialMediaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id_kelurahan' => 8,
                'jenis_sosial_media' => 'Instagram',
                'link_sosial_media' => 'https://instagram.com/kelurahanlumpue',
            ],
            [
                'id_kelurahan' => 8,
                'jenis_sosial_media' => 'Facebook',
                'link_sosial_media' => 'https://facebook.com/kelurahanlumpue',
            ],
            [
                'id_kelurahan' => 8,
                'jenis_sosial_media' => 'Website',
                'link_sosial_media' => 'https://lumpue.pareparekota.go.id',
            ],
            [
                'id_kelurahan' => 8,
                'jenis_sosial_media' => 'Twitter',
                'link_sosial_media' => 'https://twitter.com/KelurahanLumpue',
            ],
        ];

        foreach ($data as $item) {
            DB::table('sosial_media')->insert([
                'id_kelurahan' => $item['id_kelurahan'],
                'jenis_sosial_media' => $item['jenis_sosial_media'],
                'link_sosial_media' => $item['link_sosial_media'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
