<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelayananController extends Controller
{
    public function index()
    {
        $layanan = [
            'Surat Keterangan Domisili Usaha',      // a
            'Surat Keterangan Belum Menikah',       // b
            'Surat Keterangan Tempat Tinggal',      // c
            'Surat Keterangan Domisili',            // d
            'Surat Keterangan Penghasilan Orang Tua', // e
        ];

        return view('pelayanan', compact('layanan'));
    }

    public function detail($layanan)
    {
        $bladeName = str_replace('-', '', lcfirst(ucwords($layanan, '-')));

        return view("pelayanan.$bladeName");
    }
}
