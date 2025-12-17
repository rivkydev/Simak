<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kelurahan;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        $kelurahans = Kelurahan::all();

        foreach ($kelurahans as $kel) {
            // Hapus data lama untuk kelurahan ini agar tidak duplikat
            DB::table('kriterias')->where('id_kelurahan', $kel->id_kelurahan)->delete();

            $kriteria = [
                [
                    'id_kelurahan' => $kel->id_kelurahan,
                    'nama_kriteria' => 'Jenis Surat',
                    'atribut' => 'urgensi', 
                    'bobot' => 0.50,
                    'jenis' => 'benefit',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_kelurahan' => $kel->id_kelurahan,
                    'nama_kriteria' => 'Lama Menunggu (Tanggal)',
                    'atribut' => 'lama_menunggu',
                    'bobot' => 0.30,
                    'jenis' => 'benefit',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_kelurahan' => $kel->id_kelurahan,
                    'nama_kriteria' => 'Status Surat',
                    'atribut' => 'status_surat',
                    'bobot' => 0.20,
                    'jenis' => 'benefit',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            DB::table('kriterias')->insert($kriteria);
        }
    }
}