<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelurahan;

class KelurahanSeeder extends Seeder
{
    public function run()
    {
        $kelurahanList = [
            [
                'id_kelurahan' => 1,
                'nama' => 'Galung Maloang',
                'kode_pos' => '91121',
                'kecamatan' => 'Bacukiki',
                'foto_kelurahan' => 'foto_kelurahan/GalungMaloang.jpg',
                'lokasi_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.012146123244!2d119.66005407360939!3d-4.0179068447105095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d95bbbcdc0d3adb%3A0x5150d99549496cb6!2sKantor%20Kelurahan%20Galung%20Maloang!5e0!3m2!1sid!2sid!4v1754319469327!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade',
            ],
            [
                'id_kelurahan' => 2,
                'nama' => 'Lemoe',
                'kode_pos' => '91121',
                'kecamatan' => 'Bacukiki',
                'foto_kelurahan' => 'foto_kelurahan/Lemoe.jpg',
                'lokasi_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.9224301056547!2d119.65691297360968!3d-4.036252344812819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d95bb87b2403e01%3A0x5cc59d76987e0ae!2sKantor%20Lurah%20Lemoe!5e0!3m2!1sid!2sid!4v1754319519587!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade',
            ],
            [
                'id_kelurahan' => 3,
                'nama' => 'Lompoe',
                'kecamatan' => 'Bacukiki',
                'kode_pos' => '91125',
                'foto_kelurahan' => 'foto_kelurahan/lompoe.jpg',
                'lokasi_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.016834995822!2d119.64858397360939!3d-4.01694574470519!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d95bba0b7139573%3A0x4bb362709683e0e5!2sKantor%20Kelurahan%20Lompoe!5e0!3m2!1sid!2sid!4v1754319553302!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade',
            ],
            [
                'id_kelurahan' => 4,
                'kode_pos' => '91121',
                'nama' => 'Wattang Bacukiki',
                'kecamatan' => 'Bacukiki',
                'foto_kelurahan' => 'foto_kelurahan/WattangBacukiki.jpg',
                'lokasi_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63677.25258699766!2d119.5826196670532!3d-4.055414092094561!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d95bc60c6a279a7%3A0xa8dc78481990de39!2sKantor%20Kelurahan%20Wt.%20Bacukiki!5e0!3m2!1sid!2sid!4v1754319652724!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade',
            ],
            [
                'id_kelurahan' => 5,
                'nama' => 'Bumi Harapan',
                'kecamatan' => 'Bacukiki Barat',
                'kode_pos' => '91121',
                'foto_kelurahan' => 'foto_kelurahan/BumiHarapan.jpeg',
                'lokasi_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.952501338297!2d119.63070097360963!3d-4.0301125447785235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d95bba9a49694e3%3A0x27360280b8543e42!2sKantor%20kelurahan%20bumi%20harapan!5e0!3m2!1sid!2sid!4v1754319693992!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade',
            ],
            [
                'id_kelurahan' => 6,
                'nama' => 'Cappa Galung',
                'kecamatan' => 'Bacukiki Barat',
                'kode_pos' => '91122',
                'foto_kelurahan' => 'foto_kelurahan/CappaGalung.jpg',
                'lokasi_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.916791625733!2d119.62342747360967!3d-4.037402544819244!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d95bb5e31fe8645%3A0xa6c702b49cdf72f0!2sKantor%20Kelurahan%20CAPPAGALUNG!5e0!3m2!1sid!2sid!4v1754319731439!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade',
            ],
            [
                'id_kelurahan' => 7,
                'nama' => 'Kampung Baru',
                'kecamatan' => 'Bacukiki Barat',
                'kode_pos' => '91121',
                'foto_kelurahan' => 'foto_kelurahan/KampungBaru.jpg',
                'lokasi_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.001230682589!2d119.62295577360943!3d-4.020143344722983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d95bb3fc90339f9%3A0x776b8da98d714af9!2sKantor%20Kelurahan%20Kampung%20Baru!5e0!3m2!1sid!2sid!4v1754319816519!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade',
            ],
            // Sisanya tanpa lokasi_maps
            ['nama' => 'Lumpue', 'kecamatan' => 'Bacukiki Barat', 'kode_pos' => '91123'],
            ['nama' => 'Sumpang Minangae', 'kecamatan' => 'Bacukiki Barat', 'kode_pos' => '91121'],
            ['nama' => 'Tiro Sompe', 'kecamatan' => 'Bacukiki Barat', 'kode_pos' => '91125'],
            ['nama' => 'Bukit Harapan', 'kecamatan' => 'Soreang', 'kode_pos' => '91131'],
            ['nama' => 'Bukit Indah', 'kecamatan' => 'Soreang', 'kode_pos' => '91131'],
            ['nama' => 'Kampung Pisang', 'kecamatan' => 'Soreang', 'kode_pos' => '91131'],
            ['nama' => 'Lakessi', 'kecamatan' => 'Soreang', 'kode_pos' => '91133'],
            ['nama' => 'Ujung Baru', 'kecamatan' => 'Soreang', 'kode_pos' => '91131'],
            ['nama' => 'Ujung Lare', 'kecamatan' => 'Soreang', 'kode_pos' => '91131'],
            ['nama' => 'Watang Soreang', 'kecamatan' => 'Soreang', 'kode_pos' => '91132'],
            ['nama' => 'Labukkang', 'kecamatan' => 'Ujung', 'kode_pos' => '91111'],
            ['nama' => 'Lapadde', 'kecamatan' => 'Ujung', 'kode_pos' => '91112'],
            ['nama' => 'Mallusetasi', 'kecamatan' => 'Ujung', 'kode_pos' => '91111'],
            ['nama' => 'Ujung Bulu', 'kecamatan' => 'Ujung', 'kode_pos' => '91113'],
            ['nama' => 'Ujung Sabbang', 'kecamatan' => 'Ujung', 'kode_pos' => '91114'],
        ];

        foreach ($kelurahanList as $kel) {
            Kelurahan::create([
                'nama' => $kel['nama'],
                'kecamatan' => $kel['kecamatan'],
                'kode_pos' => $kel['kode_pos'],
                'foto_kelurahan' => $kel['foto_kelurahan'] ?? null,
                'lokasi_maps' => $kel['lokasi_maps'] ?? null,
            ]);
        }
    }
}
