<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StrukturPemerintahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('struktur_pemerintah')->insert([
            'id_kelurahan' => 8, // Lumpue
            'document_struktur' => 'Struktur_Kelurahan/Lumpue.pdf',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
