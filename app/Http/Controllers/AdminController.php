<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiUmkm;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Kelurahan;
use App\Models\Profil;
use App\Models\Sejarah;
use App\Models\Potensi;
use App\Models\StrukturPemerintah;
use App\Models\InformasiKontak;
use App\Models\FotoKegiatan;
use App\Models\SosialMedia;
use App\Models\Surat; 
use Carbon\Carbon; // Tambahkan ini untuk pengelolaan tanggal

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Ambil Data Pegawai (Admin) yang Login & ID Kelurahannya
        $pegawai = Auth::guard('pegawai')->user();
        
        // Pastikan relasi kelurahan ter-load jika dibutuhkan di view
        if (!$pegawai->relationLoaded('kelurahan')) {
            $pegawai->load('kelurahan');
        }
        $idKelurahan = $pegawai->id_kelurahan;

        // 2. Query Statistik (Real Count dari Database)
        // Hitung surat disetujui
        $jumlahDisetujui = Surat::where('id_kelurahan', $idKelurahan)
                            ->where('status_verifikasi', 'diterima') // Sesuaikan value di DB (diterima/1)
                            ->count();

        // Hitung surat menunggu (status null atau 'menunggu')
        $jumlahMenunggu = Surat::where('id_kelurahan', $idKelurahan)
                            ->where(function($q) {
                                $q->whereNull('status_verifikasi')
                                  ->orWhere('status_verifikasi', 'menunggu');
                            })->count();

        // Hitung jumlah UMKM
        $jumlahUMKM = InformasiUmkm::where('id_kelurahan', $idKelurahan)->count();
        
        // Hitung surat ditolak (untuk grafik donat)
        $jumlahDitolak = Surat::where('id_kelurahan', $idKelurahan)
                            ->where('status_verifikasi', 'ditolak')
                            ->count();

        // Susun Array Statistik
        $statistik = [
            ['label' => 'Surat Disetujui', 'value' => $jumlahDisetujui, 'icon'  => 'suratDisetujui.png'],
            ['label' => 'Surat Menunggu', 'value' => $jumlahMenunggu, 'icon'  => 'suratMenunggu.png'],
            ['label' => 'Jumlah UMKM', 'value' => $jumlahUMKM, 'icon'  => 'UMKM.png'],
        ];

        // 3. Query Tabel Surat Masuk (Ambil 5 Terbaru)
        $suratMasuk = Surat::where('id_kelurahan', $idKelurahan)
                        // ->latest() // Urutkan dari yang terbaru
                        // ->take(5)  // Batasi 5 data saja untuk dashboard
                        ->get();

        // 4. Data untuk Grafik Status (Donat/Pie Chart)
        $statusData = [
            'Menunggu'  => $jumlahMenunggu, 
            'Disetujui' => $jumlahDisetujui, 
            'Ditolak'   => $jumlahDitolak
        ];

        // 5. Data untuk Grafik Tren Bulanan (Tahun Ini)
        $dataPerBulan = array_fill(1, 12, 0); // Siapkan array bulan 1-12 isi 0
        
        $suratPerBulan = Surat::where('id_kelurahan', $idKelurahan)
            ->whereYear('created_at', date('Y')) // Filter tahun sekarang
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan'); // Ambil hasil sebagai array [bulan => total]

        // Masukkan data DB ke array bulan (agar bulan kosong tetap ada nilainya 0)
        foreach ($suratPerBulan as $bulan => $total) {
            $dataPerBulan[$bulan] = $total;
        }

        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'values' => array_values($dataPerBulan), 
        ];

        // Kirim semua data ke View
        return view('admin.dashboard', compact('statistik', 'suratMasuk', 'statusData', 'chartData', 'pegawai'));
    }

    public function profil($id_kelurahan)
    {
        $kelurahan = Kelurahan::findOrFail($id_kelurahan);
        $profil = Profil::where('id_kelurahan', $id_kelurahan)->first();
        $sejarah = Sejarah::where('id_kelurahan', $id_kelurahan)->first();
        $potensiList = Potensi::where('id_kelurahan', $id_kelurahan)->get();
        $struktur = StrukturPemerintah::where('id_kelurahan', $id_kelurahan)->first();
        $kontak = DB::table('informasi_kontak')->where('id_kelurahan', $kelurahan->id_kelurahan)->get();
        $sosial = DB::table('sosial_media')->where('id_kelurahan', $kelurahan->id_kelurahan)->get();
        $fotoKegiatan = FotoKegiatan::where('id_profil', $profil->id_profil)->get();
        
        return view('admin.profil', compact(
            'kelurahan',
            'profil',
            'sejarah',
            'struktur',
            'kontak',
            'sosial',
            'fotoKegiatan',
        ))->with('potensi', $potensiList);
    }

    public function updateDeskripsi(Request $request, $id_kelurahan)
    {
        $request->validate(['deskripsi' => 'required']);
        $profil = Profil::where('id_kelurahan', $id_kelurahan)->first();
        if (!$profil) return back()->with('error', 'Data profil tidak ditemukan.');
        $profil->deskripsi = $request->deskripsi;
        $profil->save();
        return redirect()->back()->with('success', 'Deskripsi berhasil diperbarui.');
    }

    public function updateVisi(Request $request, $id_kelurahan)
    {
        $request->validate(['visi' => 'required']);
        $profil = Profil::where('id_kelurahan', $id_kelurahan)->first();
        if (!$profil) return back()->with('error', 'Data profil tidak ditemukan.');
        $profil->visi = $request->visi;
        $profil->save();
        return redirect()->back()->with('success', 'Visi berhasil diperbarui.');
    }

    public function updateMisi(Request $request, $id_kelurahan)
    {
        $profil = Profil::where('id_kelurahan', $id_kelurahan)->first();
        if (!$profil) return back()->with('error', 'Data profil tidak ditemukan.');
        $profil->misi = $request->misi;
        $profil->save();
        return back()->with('success', 'Misi berhasil diperbarui.');
    }

    public function updateFotoKegiatan(Request $request, $id_kelurahan)
    {
        $request->validate([
            'foto_kegiatan'   => 'required|array',
            'foto_kegiatan.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'nama_kegiatan'   => 'required|array',
            'nama_kegiatan.*' => 'required|string|max:255',
        ]);

        $profil = Profil::where('id_kelurahan', $id_kelurahan)->first();
        if (!$profil) return back()->with('error', 'Data profil tidak ditemukan.');

        foreach ($request->file('foto_kegiatan') as $index => $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_kegiatan', $filename);

            FotoKegiatan::create([
                'id_profil'     => $profil->id_profil,
                'nama_kegiatan' => $request->nama_kegiatan[$index],
                'foto'          => 'foto_kegiatan/' . $filename,
            ]);
        }
        return redirect()->back()->with('success', 'Foto kegiatan berhasil ditambahkan.');
    }

    public function deleteFoto($id_foto)
    {
        $foto = FotoKegiatan::findOrFail($id_foto);
        \Storage::delete('public/' . $foto->foto);
        $foto->delete();
        return back()->with('success', 'Foto berhasil dihapus');
    }

    public function updateSejarah(Request $request, $id_kelurahan)
    {
        $request->validate(['deskripsi' => 'required']);
        $sejarah = Sejarah::where('id_kelurahan', $id_kelurahan)->first();
        if (!$sejarah) {
            $sejarah = new Sejarah();
            $sejarah->id_kelurahan = $id_kelurahan;
        }
        $sejarah->deskripsi = $request->deskripsi;
        $sejarah->save();
        return redirect()->back()->with('success', 'Sejarah berhasil diperbarui.');
    }

    public function updatePotensiDeskripsi(Request $request, $id_kelurahan)
    {
        $request->validate(['deskripsi_umum' => 'required|string']);
        Profil::updateOrCreate(
            ['id_kelurahan' => $id_kelurahan],
            ['deskripsi_potensi' => $request->deskripsi_umum]
        );
        return back()->with('success', 'Deskripsi umum potensi berhasil diperbarui.');
    }

    public function tambahPotensiJenis(Request $request, $id_kelurahan)
    {
        $request->validate([
            'jenis_potensi' => 'required|string|max:255',
            'deskripsi_jenis_potensi' => 'required|string',
        ]);
        Potensi::create([
            'id_kelurahan' => $id_kelurahan,
            'jenis_potensi' => $request->jenis_potensi,
            'deskripsi_jenis_potensi' => $request->deskripsi_jenis_potensi,
        ]);
        return back()->with('success', 'Jenis potensi baru berhasil ditambahkan.');
    }

    public function updatePotensiJenis(Request $request, $id_potensi)
    {
        $request->validate([
            'jenis_potensi' => 'required|string|max:255',
            'deskripsi_jenis_potensi' => 'required|string',
        ]);
        $potensi = Potensi::findOrFail($id_potensi);
        $potensi->update([
            'jenis_potensi' => $request->jenis_potensi,
            'deskripsi_jenis_potensi' => $request->deskripsi_jenis_potensi,
        ]);
        return back()->with('success', 'Jenis potensi berhasil diperbarui.');
    }

    public function hapusPotensiJenis($id_potensi)
    {
        $potensi = Potensi::findOrFail($id_potensi);
        $potensi->delete();
        return back()->with('success', 'Jenis potensi berhasil dihapus.');
    }

    public function updatestruktur(Request $request)
    {
        $request->validate([
            'id_kelurahan' => 'required|exists:kelurahan,id_kelurahan',
            'document_struktur' => 'required|mimes:pdf,jpeg,png,jpg|max:5120',
        ]);
        $path = $request->file('document_struktur')->store('struktur', 'public');
        StrukturPemerintah::updateOrCreate(
            ['id_kelurahan' => $request->id_kelurahan],
            ['document_struktur' => $path]
        );
        return back()->with('success', 'Dokumen Struktur berhasil disimpan!');
    }

    public function storeKontak(Request $request, $id_kelurahan)
    {
        $request->validate([
            'kontak' => 'required|array',
            'kontak.*' => 'nullable|string|max:255',
        ]);
        foreach ($request->kontak as $jenis => $informasi) {
            if (!empty($informasi)) {
                InformasiKontak::updateOrCreate(
                    ['id_kelurahan' => $id_kelurahan, 'jenis_kontak' => $jenis],
                    ['informasi_kontak' => $informasi]
                );
            }
        }
        return back()->with('success', 'Informasi kontak berhasil disimpan.');
    }

    public function storeSosial(Request $request, $id_kelurahan)
    {
        $request->validate([
            'sosial' => 'required|array',
            'sosial.*' => 'nullable|url|max:255',
        ]);
        foreach ($request->sosial as $jenis => $link) {
            if (!empty($link)) {
                SosialMedia::updateOrCreate(
                    ['id_kelurahan' => $id_kelurahan, 'jenis_sosial_media' => $jenis],
                    ['link_sosial_media' => $link]
                );
            }
        }
        return back()->with('success', 'Sosial media berhasil disimpan.');
    }

    public function updateMaps(Request $request, Kelurahan $kelurahan)
    {
        $request->validate(['lokasi_maps' => 'nullable|string']);
        $kelurahan->update(['lokasi_maps' => $request->lokasi_maps]);
        return back()->with('success', 'Lokasi maps berhasil diperbarui.');
    }

    public function updateFotoKelurahan(Request $request, $id)
    {
        $request->validate(['foto_kelurahan' => 'required|image|mimes:jpg,jpeg,png|max:2048']);
        $kelurahan = Kelurahan::findOrFail($id);
        if ($kelurahan->foto_kelurahan && \Storage::exists('public/' . $kelurahan->foto_kelurahan)) {
            \Storage::delete('public/' . $kelurahan->foto_kelurahan);
        }
        $path = $request->file('foto_kelurahan')->store('foto_kelurahan', 'public');
        $kelurahan->update(['foto_kelurahan' => $path]);
        return back()->with('success', 'Foto kelurahan berhasil diperbarui.');
    }

    // --- BAGIAN PELAYANAN SURAT ---

    public function pelayanan()
    {
        $layanan = [
            'Surat Keterangan Domisili Usaha',
            'Surat Keterangan Kematian',
            'Surat Keterangan Belum Menikah',
            'Surat Keterangan Tempat Tinggal',
            'Surat Keterangan Ahli Waris',
            'Surat Keterangan Penghasilan Orang Tua',
        ];
        return view('admin.pelayanan', compact('layanan'));
    }

    public function detail($layanan)
    {
        $bladeName = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $layanan))));
        return view("admin.pelayanan.$bladeName");
    }

    // [METODE BARU] MENANGANI SEMUA JENIS SURAT
    public function cetakSurat(Request $request, $layanan)
{
    // 1. Validasi Input Dasar
    $request->validate([
        'nomor_surat' => 'required|string|max:255',
    ]);

    $pegawai = Auth::guard('pegawai')->user();
    $kelurahan = $pegawai->kelurahan;

    // 2. Format Nama Surat
    $judulSurat = 'Surat Keterangan ' . ucwords(str_replace(['_', '-'], ' ', $layanan));

    // 3. Data Dasar untuk PDF
    $dataPDF = [
        'kelurahan' => $kelurahan,
        'nomor_surat' => $request->nomor_surat,
        'judul_surat' => $judulSurat,
        'tanggal' => now()->locale('id')->translatedFormat('d F Y'),
        'alamat_kelurahan' => $this->getAlamatKelurahan($kelurahan->id_kelurahan),
        'nama_lurah' => $this->getNamaLurah($kelurahan->id_kelurahan),
        'nip_lurah' => $this->getNIPLurah($kelurahan->id_kelurahan),
    ];

    $namaPemohon = '';
    $template = 'surat.template_pdf'; // Default template

    // 4. Validasi & Data Spesifik Per Jenis Surat
    switch ($layanan) {
        case 'domisili-usaha':
        case 'domisili_usaha':
            $request->validate([
                'nama_perusahaan' => 'required|string|max:255',
                'penanggung_jawab' => 'required|string|max:255',
                'alamat_perusahaan' => 'required|string',
            ]);
            
            $dataPDF = array_merge($dataPDF, [
                'nama_perusahaan' => $request->nama_perusahaan,
                'penanggung_jawab' => $request->penanggung_jawab,
                'alamat_perusahaan' => $request->alamat_perusahaan,
            ]);
            
            $namaPemohon = $request->penanggung_jawab;
            $template = 'surat.domisili_usaha_pdf'; // Template khusus
            break;

        case 'belum-menikah':
        case 'belum_menikah':
            $request->validate([
                'nama' => 'required|string|max:255',
            ]);
            
            $dataPDF = array_merge($dataPDF, $request->except(['_token', 'nomor_surat']));
            $namaPemohon = $request->nama;
            break;

        case 'tempat-tinggal':
        case 'tempat_tinggal':
            $request->validate([
                'nama' => 'required|string|max:255',
            ]);
            
            $dataPDF = array_merge($dataPDF, $request->except(['_token', 'nomor_surat']));
            $namaPemohon = $request->nama;
            break;

        case 'kematian':
            $request->validate([
                'nama' => 'required|string|max:255',
                'nama_pelapor' => 'required|string|max:255',
            ]);
            
            $dataPDF = array_merge($dataPDF, $request->except(['_token', 'nomor_surat']));
            $namaPemohon = $request->nama_pelapor;
            break;

        case 'ahli-waris':
        case 'ahli_waris':
            $request->validate([
                'nama' => 'required|string|max:255',
            ]);
            
            $dataPDF = array_merge($dataPDF, $request->except(['_token', 'nomor_surat']));
            $namaPemohon = $request->nama;
            break;

        case 'penghasilan-orang-tua':
        case 'penghasilan_orang_tua':
            $request->validate([
                'nama' => 'required|string|max:255',
            ]);
            
            $dataPDF = array_merge($dataPDF, $request->except(['_token', 'nomor_surat']));
            $namaPemohon = $request->nama;
            break;

        default:
            return back()->withErrors(['error' => 'Jenis surat tidak dikenali: ' . $layanan]);
    }

    try {
        // 5. Generate PDF
        $pdf = PDF::loadView($template, $dataPDF);
        $pdf->setPaper('A4', 'portrait');

        // 6. Simpan PDF ke Storage
        $namaFile = 'surat_' . str_replace([' ', '-'], '_', strtolower($layanan)) . '_' . time() . '.pdf';
        $pathFile = 'surat/' . $namaFile;
        Storage::put('public/' . $pathFile, $pdf->output());

        // 7. Simpan ke Database
        $dataSurat = json_encode($request->except(['_token', 'nomor_surat']));
        
        Surat::create([
            'id_kelurahan' => $kelurahan->id_kelurahan,
            'nama_pemohon' => $namaPemohon,
            'nama_surat' => $judulSurat,
            'jenis_surat' => $judulSurat,
            'status_verifikasi' => null,
            'file_surat' => $pathFile,
            'data_surat' => $dataSurat,
        ]);

        // 8. Download PDF
        return $pdf->download($namaFile);

    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Gagal membuat PDF: ' . $e->getMessage()]);
    }
}

// Helper Methods
private function getAlamatKelurahan($id_kelurahan)
{
    $kontak = DB::table('informasi_kontak')
        ->where('id_kelurahan', $id_kelurahan)
        ->where('jenis_kontak', 'Alamat')
        ->first();
    
    return $kontak ? $kontak->informasi_kontak : 'Jl. Bau Massepe No.151, Bacukiki Barat, Parepare';
}

private function getNamaLurah($id_kelurahan)
{
    $lurah = DB::table('pegawai')
        ->where('id_kelurahan', $id_kelurahan)
        ->where('id_jabatan', 3) // ID Jabatan Lurah
        ->first();
    
    return $lurah ? $lurah->nama : '[Nama Lurah]';
}

private function getNIPLurah($id_kelurahan)
{
    $lurah = DB::table('pegawai')
        ->where('id_kelurahan', $id_kelurahan)
        ->where('id_jabatan', 3)
        ->first();
    
    return $lurah ? $lurah->nip : '-';
}

    public function edit($id)
    {
        $umkm = InformasiUmkm::findOrFail($id);
        return view('admin.umkmedit', compact('umkm'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tahun' => 'nullable|string|max:4',
            'deskripsi' => 'required|string',
            'nib' => 'nullable|string|max:255',
            'alamat' => 'required|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'telp' => 'nullable|string|max:20',
            'grab' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'foto_usaha' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $umkm = InformasiUmkm::findOrFail($id);
        $umkm->nama = $request->nama;
        $umkm->tahun_berdiri = $request->tahun;
        $umkm->deskripsi = $request->deskripsi;
        $umkm->nib = $request->nib;
        $umkm->alamat = $request->alamat;
        $umkm->instagram = $request->instagram;
        $umkm->telp = $request->telp;
        $umkm->jenis_usaha = $request->jenis_usaha;
        $umkm->grab = $request->grab;
        $umkm->facebook = $request->facebook;
        $umkm->tiktok = $request->tiktok;

        if ($request->hasFile('foto_usaha')) {
            $path = $request->file('foto_usaha')->store('umkm', 'public');
            $umkm->foto_usaha = $path;
        }

        $umkm->save();
        return redirect()->route('umkm.edit', ['id' => $umkm->id_umkm])->with('success', 'Data UMKM berhasil diperbarui');
    }

    public function destroy($id)
    {
        $umkm = InformasiUMKM::findOrFail($id);
        if ($umkm->gambar && \Storage::exists('public/' . $umkm->gambar)) {
            \Storage::delete('public/' . $umkm->gambar);
        }
        $umkm->delete();
        return redirect()->route('admin.umkm')->with('success', 'Data UMKM berhasil dihapus');
    }


}