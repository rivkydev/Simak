<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jabatan')->insert([
            [
                'id_jabatan' => 1,
                'nama' => 'pelayan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jabatan' => 2,
                'nama' => 'seklur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jabatan' => 3,
                'nama' => 'lurah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
