<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Hitung jumlah UMKM dari tabel informasi_umkm
        $totalUMKM = DB::table('informasi_umkm')->count();

        // Kirim ke view home
        return view('home', compact('totalUMKM'));
    }
}
