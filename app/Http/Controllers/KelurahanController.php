<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Profil;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    public function index()
    {
        $kelurahan = Kelurahan::all();

        $kecamatanList = $kelurahan->pluck('kecamatan')->unique()->values();

        return view('kelurahan', [
            'kelurahan' => $kelurahan,
            'kecamatanList' => $kecamatanList,
        ]);
    }

    public function show($nama)
    {
        $kelurahan = DB::table('kelurahan')->whereRaw('LOWER(nama) = ?', [strtolower($nama)])->first();

        if (!$kelurahan) {
            abort(404, 'Kelurahan tidak ditemukan');
        }
        
        $profil = DB::table('profil')->where('id_kelurahan', $kelurahan->id_kelurahan)->first();
        $sejarah = DB::table('sejarah')->where('id_kelurahan', $kelurahan->id_kelurahan)->first();
        $potensi = DB::table('potensi')->where('id_kelurahan', $kelurahan->id_kelurahan)->get();
        $struktur = DB::table('struktur_pemerintah')->where('id_kelurahan', $kelurahan->id_kelurahan)->first();
        $kontak = DB::table('informasi_kontak')->where('id_kelurahan', $kelurahan->id_kelurahan)->get();
        $sosial = DB::table('sosial_media')->where('id_kelurahan', $kelurahan->id_kelurahan)->get();

        $fotoKegiatan = DB::table('foto_kegiatan')
            ->where('id_profil', $profil->id_profil)
            ->get();

        return view('profilKelurahan.profil', [
            'kelurahan' => $kelurahan,
            'profil' => $profil,
            'sejarah' => $sejarah,
            'potensi' => $potensi,
            'struktur' => $struktur,
            'kontak' => $kontak,
            'sosial' => $sosial,
            'fotoKegiatan' => $fotoKegiatan,
        ]);
    }
}
