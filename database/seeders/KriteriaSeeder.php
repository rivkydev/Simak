<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kelurahan;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        // =================================================================
        // PENGATURAN BOBOT UTAMA (Edit nilai di sini)
        // Total harus 1.00
        // =================================================================
        $bobotSetting = [
            'urgensi'        => 0.50, // C1: Jenis Surat (Paling Tinggi)
            'lama_menunggu'  => 0.30, // C2: Waktu
            'status_surat'   => 0.20, // C3: Status
        ];

        $kelurahans = Kelurahan::all();

        foreach ($kelurahans as $kel) {
            DB::table('kriterias')->where('id_kelurahan', $kel->id_kelurahan)->delete();

            // Insert C1: Jenis Surat
            DB::table('kriterias')->insert([
                'id_kelurahan'  => $kel->id_kelurahan,
                'nama_kriteria' => 'Tingkat Urgensi Surat (Jenis)',
                'atribut'       => 'urgensi',
                'bobot'         => $bobotSetting['urgensi'],
                'jenis'         => 'benefit',
                'created_at'    => now(), 'updated_at' => now()
            ]);

            // Insert C2: Lama Menunggu
            DB::table('kriterias')->insert([
                'id_kelurahan'  => $kel->id_kelurahan,
                'nama_kriteria' => 'Lama Waktu Menunggu',
                'atribut'       => 'lama_menunggu',
                'bobot'         => $bobotSetting['lama_menunggu'],
                'jenis'         => 'benefit',
                'created_at'    => now(), 'updated_at' => now()
            ]);

            // Insert C3: Status Surat
            DB::table('kriterias')->insert([
                'id_kelurahan'  => $kel->id_kelurahan,
                'nama_kriteria' => 'Status Pengerjaan',
                'atribut'       => 'status_surat',
                'bobot'         => $bobotSetting['status_surat'],
                'jenis'         => 'cost', // Cost: Status "Selesai" mengurangi prioritas
                'created_at'    => now(), 'updated_at' => now()
            ]);
        }
    }
}