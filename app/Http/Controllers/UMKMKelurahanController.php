<?php

namespace App\Http\Controllers;

use App\Models\InformasiUMKM;
use App\Models\Kelurahan;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UMKMKelurahanController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $thisMonth = $now->format('Y-m');
        $lastMonth = $now->copy()->subMonth()->format('Y-m');

        $umkmPerKecamatan = DB::table('informasi_umkm')
            ->join('kelurahan', 'informasi_umkm.id_kelurahan', '=', 'kelurahan.id_kelurahan')
            ->select(
                'kelurahan.kecamatan',
                DB::raw("SUM(CASE WHEN DATE_FORMAT(informasi_umkm.created_at, '%Y-%m') = '$thisMonth' THEN 1 ELSE 0 END) as jumlah_bulan_ini"),
                DB::raw("SUM(CASE WHEN DATE_FORMAT(informasi_umkm.created_at, '%Y-%m') = '$lastMonth' THEN 1 ELSE 0 END) as jumlah_bulan_lalu")
            )
            ->groupBy('kelurahan.kecamatan')
            ->get();

        $kecamatanData = [];
        foreach ($umkmPerKecamatan as $item) {
            $jumlahIni = $item->jumlah_bulan_ini;
            $jumlahLalu = $item->jumlah_bulan_lalu;

            $pertumbuhan = $jumlahLalu == 0
                ? ($jumlahIni > 0 ? 100 : 0)
                : (($jumlahIni - $jumlahLalu) / $jumlahLalu) * 100;

            $kecamatanData[] = [
                'nama' => $item->kecamatan,
                'jumlah' => $jumlahIni,
                'pertumbuhan' => round($pertumbuhan, 2)
            ];
        }

        // Ambil daftar kelurahan (jika belum ada)
        $kelurahanList = DB::table('kelurahan')->select('nama', 'kecamatan')->get();

        // Ambil daftar UMKM untuk ditampilkan di bagian bawah
        $umkm = DB::table('informasi_umkm')
            ->join('kelurahan', 'informasi_umkm.id_kelurahan', '=', 'kelurahan.id_kelurahan')
            ->select(
                'informasi_umkm.nama',
                'kelurahan.nama as kelurahan_nama',
                'kelurahan.kecamatan'
            )
            ->get();

        return view('umkm', [
            'kecamatanData' => $kecamatanData,
            'kelurahanList' => $kelurahanList,
            'umkm' => $umkm
        ]);
    }


    public function show($slug)
    {
        // Ambil semua data dan cari nama yang slug-nya cocok
        $umkm = InformasiUMKM::with('kelurahan')->get()->first(function ($item) use ($slug) {
            return Str::slug($item->nama) === $slug;
        });

        if (!$umkm) {
            abort(404, 'UMKM tidak ditemukan.');
        }

        return view('umkm.show', ['umkm' => $umkm]);
    }
}
