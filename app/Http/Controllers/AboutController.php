<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $features = [
            ['🌍', 'Potensi Kelurahan', 'Menampilkan informasi sejarah, budaya, dan potensi ekonomi dari setiap kelurahan.'],
            ['📝', 'Layanan Surat Online', 'Permohonan surat secara daring tanpa harus datang langsung ke kantor kelurahan.'],
            ['📊', 'Data UMKM', 'Visualisasi data UMKM aktif, sektor usaha unggulan, dan persebarannya di wilayah kelurahan.'],
        ];

        return view('about', compact('features'));
    }
}
