<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InformasiUMKM;

class InformasiUmkmSeeder extends Seeder
{
    public function run()
    {
        $umkmList = [
            [
                'id_kelurahan' => 1,
                'nib' => 'Belum Tersedia',
                'nama' => 'HERLINA RUNTUWENE',
                'alamat' => 'JL.PIPIT INO. 35 BOK D RT 01/RW 02',
                'deskripsi' => 'JUAL GAS 3 KG',
                'email' => 'Belum Tersedia',
                'telp' => 'Belum Tersedia',
                'gambar' => 'foto_usaha/HERLINA RUNTUWENE.jpg',
                'instagram' => 'https://instagram.com/dnarpati',
            ],
            [
                'id_kelurahan' => 1,
                'nib' => 'Belum Tersedia',
                'nama' => 'RAVITRA SUHERVI',
                'alamat' => 'JL. PIPIT I NO. 36 BLOK D RT 01/RW 02',
                'deskripsi' => 'JUAL GAS 3 KG',
                'email' => 'Belum Tersedia',
                'telp' => 'Belum Tersedia',
                'gambar' => 'foto_usaha/RAVITRA SUHERVI.jpg',
            ],
            [
                'id_kelurahan' => 2,
                'nib' => 'Belum Tersedia',
                'nama' => 'Abang Varen Cell',
                'alamat' => 'RT 01 RW 02',
                'deskripsi' => 'Menjual Campuran',
                'email' => 'Belum Tersedia',
                'telp' => 'Belum Tersedia',
                'gambar' => 'foto_usaha/Abang Varen Cell.jpg',
            ],
            [
                'id_kelurahan' => 4,
                'nib' => 'Belum Tersedia',
                'nama' => 'SUBAEDAH',
                'alamat' => 'JL. JEND. MUH. YUSUF, RT.01/RW.06 CEDDIE',
                'deskripsi' => 'PENGGILINGAN',
                'email' => 'Belum Tersedia',
                'telp' => 'Belum Tersedia',
                'gambar' => 'foto_usaha/PENGGILINGAN.jpg',
            ],
            [
                'id_kelurahan' => 5,
                'nib' => 'Belum Tersedia',
                'nama' => 'Agribisnis (Tanaman Hias)',
                'alamat' => 'Jl. Bambu Runcing',
                'deskripsi' => 'Usaha tanaman hias dan bibit hasil budidaya sendiri, serta membuat pot untuk penggunaan pribadi.',
                'email' => 'Belum Tersedia',
                'telp' => 'Belum Tersedia',
            ],
            [
                'id_kelurahan' => 6,
                'nib' => 'Belum Tersedia',
                'nama' => 'Kiose Merindu',
                'alamat' => 'Jl. Materotasi',
                'deskripsi' => 'Menjual Berbagai Makanan ',
                'email' => 'Belum Tersedia',
                'telp' => 'Belum Tersedia',
                'gambar' => 'foto_usaha/kiose merindu.jpg',
            ],
            [
                'id_kelurahan' => 8,
                'nib' => 'Belum Tersedia',
                'nama' => 'KASMA',
                'alamat' => 'LUMPUE RT.001/RW.006',
                'deskripsi' => 'JUAL TABUNG GAS 3Kg',
                'email' => 'Belum Tersedia',
                'telp' => 'Belum Tersedia',
            ],
            [
                'id_kelurahan' => 12,
                'nib' => 'Belum Tersedia',
                'nama' => 'SINAR ABADI',
                'alamat' => 'JEND. A. YANI. 157',
                'deskripsi' => 'PENJUAL BARANG SEMEN & KAPUR',
                'email' => 'Belum Tersedia',
                'telp' => 'Belum Tersedia',
            ],
            [
                'id_kelurahan' => 13,
                'nib' => 'Belum Tersedia',
                'nama' => 'Toko Baru',
                'alamat' => 'Jln. Lasinrang No.188-190 Kota Parepare',
                'deskripsi' => 'Toko Peralatan Rumah Tangga',
                'email' => 'Belum Tersedia',
                'telp' => 'Belum Tersedia',
                'gambar' => 'foto_usaha/Toko Baru.jpg',
            ],

        ];

        foreach ($umkmList as $data) {
            InformasiUmkm::create($data);
        }
    }
}
