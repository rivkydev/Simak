<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelayananController extends Controller
{
    public function index()
    {
        $layanan = [
            'Surat Keterangan Domisili Usaha',
            'Surat Keterangan Kematian',
            'Surat Keterangan Belum Menikah',
            'Surat Keterangan Tempat Tinggal',
            'Surat Keterangan Ahli Waris',
            'Surat Keterangan Penghasilan Orang Tua',
        ];

        return view('pelayanan', compact('layanan'));
    }

    public function detail($layanan)
    {
        $bladeName = str_replace('-', '', lcfirst(ucwords($layanan, '-')));

        return view("pelayanan.$bladeName");
    }
}
