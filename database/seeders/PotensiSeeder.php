<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Potensi;

class PotensiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Kelurahan 1
            1 => [
                'Pertanian, Perkebunan, dan Peternakan',
                'UMKM dan Industri Rumah Tangga',
                'Digitalisasi dan Teknologi Informasi',
            ],
            // Kelurahan 2
            2 => [
                'Perikanan dan Kelautan',
                'Energi Terbarukan dan Lingkungan',
            ],
            // Kelurahan 3
            3 => [
                'Ekowisata dan Wisata Budaya',
                'Pendidikan dan Literasi Masyarakat',
                'Kesehatan dan Layanan Sosial',
                'Infrastruktur dan Aksesibilitas',
            ],
            // Kelurahan 4
            4 => [
                'UMKM dan Industri Rumah Tangga',
            ],
            // Kelurahan 5
            5 => [
                'Pertanian, Perkebunan, dan Peternakan',
                'Perikanan dan Kelautan',
                'Ekowisata dan Wisata Budaya',
                'Digitalisasi dan Teknologi Informasi',
                'Partisipasi dan Kelembagaan Komunitas',
            ],
        ];

        foreach ($data as $idKelurahan => $kategoriPotensi) {
            foreach ($kategoriPotensi as $kategori) {
                Potensi::create([
                    'id_kelurahan' => $idKelurahan,
                    'jenis_potensi' => $kategori,
                    'deskripsi_jenis_potensi' => $this->generateRandomDeskripsi($kategori),
                ]);
            }
        }
    }

    private function generateRandomDeskripsi($kategori)
    {
        $deskripsiList = [
            'Pertanian, Perkebunan, dan Peternakan' => 'Wilayah ini memiliki lahan subur yang mendukung kegiatan pertanian dan peternakan masyarakat setempat.',
            'Perikanan dan Kelautan' => 'Potensi besar terdapat pada sektor perikanan tangkap dan budidaya laut yang menjadi mata pencaharian utama.',
            'UMKM dan Industri Rumah Tangga' => 'Banyak warga yang aktif memproduksi barang rumah tangga seperti makanan ringan, batik, dan kerajinan tangan.',
            'Ekowisata dan Wisata Budaya' => 'Kelurahan ini memiliki air terjun dan situs budaya lokal yang sering dikunjungi wisatawan.',
            'Energi Terbarukan dan Lingkungan' => 'Inisiatif panel surya dan kebun energi mulai dikembangkan oleh masyarakat dan pemerintah kelurahan.',
            'Pendidikan dan Literasi Masyarakat' => 'Tersedia banyak program literasi digital dan baca-tulis untuk anak-anak dan orang dewasa.',
            'Kesehatan dan Layanan Sosial' => 'Pelayanan kesehatan difokuskan pada posyandu dan program lansia sehat.',
            'Infrastruktur dan Aksesibilitas' => 'Kelurahan ini memiliki jalan desa yang cukup baik dan program jembatan desa yang telah selesai dibangun.',
            'Digitalisasi dan Teknologi Informasi' => 'Tersedianya wifi publik dan pelatihan IT bagi warga mendorong kemajuan digitalisasi.',
            'Partisipasi dan Kelembagaan Komunitas' => 'Kegiatan karang taruna, PKK, dan gotong royong menjadi kekuatan komunitas ini.',
        ];

        return $deskripsiList[$kategori] ?? 'Deskripsi belum tersedia.';
    }
}
