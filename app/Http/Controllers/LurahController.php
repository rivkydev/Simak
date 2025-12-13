<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LurahController extends Controller
{

    public function index()
    {
        $statistik = [
            [
                'label' => 'Surat Disetujui',
                'value' => 6,
                'icon'  => 'suratDisetujui.png'
            ],
            [
                'label' => 'Surat Menunggu',
                'value' => 3,
                'icon'  => 'suratMenunggu.png'
            ],
            [
                'label' => 'Jumlah UMKM',
                'value' => 15,
                'icon'  => 'UMKM.png'
            ],
        ];

        $suratMasuk = [
            [
                'nama' => 'Ahmad Syarif',
                'tanggal' => '2025-08-01',
                'status' => 'Menunggu',
            ],
            [
                'nama' => 'Nur Aini',
                'tanggal' => '2025-08-03',
                'status' => 'Disetujui',
            ],
            [
                'nama' => 'Rizky Maulana',
                'tanggal' => '2025-08-05',
                'status' => 'Ditolak',
            ],
        ];

        $statusData = [
            'Menunggu' => 3,
            'Disetujui' => 6,
            'Ditolak' => 1,
        ];

        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'values' => [2, 4, 3, 5, 6, 3, 4, 5, 2, 4, 3, 5],
        ];

        $pegawai = Auth::guard('pegawai')->user()->load('kelurahan');

        return view('lurah.dashboard', [
            'pegawai' => $pegawai,
            'statistik' => $statistik,
            'suratMasuk' => $suratMasuk,
            'statusData' => $statusData,
            'chartData' => $chartData,
        ]);
    }


    public function umkm()
    {   
        return view('lurah.umkm');
    }
}
