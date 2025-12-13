<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiUmkm;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Kelurahan;
use App\Models\Profil;
use App\Models\Sejarah;
use App\Models\Potensi;
use App\Models\StrukturPemerintah;
use App\Models\InformasiKontak;
use App\Models\FotoKegiatan;
use App\Models\SosialMedia;


class AdminController extends Controller
{
    public function dashboard()
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

        return view('admin.dashboard', [
            'pegawai' => $pegawai,
            'statistik' => $statistik,
            'suratMasuk' => $suratMasuk,
            'statusData' => $statusData,
            'chartData' => $chartData,
        ]);
    }

    public function profil($id_kelurahan)
    {
        $kelurahan = Kelurahan::findOrFail($id_kelurahan);
        $profil = Profil::where('id_kelurahan', $id_kelurahan)->first();
        $sejarah = Sejarah::where('id_kelurahan', $id_kelurahan)->first();
        $potensi = Potensi::where('id_kelurahan', $id_kelurahan)->first();
        $struktur = StrukturPemerintah::where('id_kelurahan', $id_kelurahan)->first();
        $potensi = Potensi::where('id_kelurahan', operator: $id_kelurahan)->get();
        $kontak = DB::table('informasi_kontak')->where('id_kelurahan', $kelurahan->id_kelurahan)->get();
        $sosial = DB::table('sosial_media')->where('id_kelurahan', $kelurahan->id_kelurahan)->get();
        $fotoKegiatan = FotoKegiatan::where('id_profil', $profil->id_profil)->get();
        return view('admin.profil', compact(
            'kelurahan',
            'profil',
            'sejarah',
            'potensi',
            'struktur',
            'kontak',
            'sosial',
            'fotoKegiatan',
        ));
    }
    public function updateDeskripsi(Request $request, $id_kelurahan)
    {
        $request->validate(['deskripsi' => 'required']);

        $profil = Profil::where('id_kelurahan', $id_kelurahan)->first();

        if (!$profil) {
            return back()->with('error', 'Data profil tidak ditemukan.');
        }

        $profil->deskripsi = $request->deskripsi;
        $profil->save();

        return redirect()->back()->with('success', 'Deskripsi berhasil diperbarui.');
    }


    public function updateVisi(Request $request, $id_kelurahan)
    {
        $request->validate(['visi' => 'required']);

        $profil = Profil::where('id_kelurahan', $id_kelurahan)->first();

        if (!$profil) {
            return back()->with('error', 'Data profil tidak ditemukan.');
        }

        $profil->visi = $request->visi;
        $profil->save();

        return redirect()->back()->with('success', 'Visi berhasil diperbarui.');
    }

    public function updateMisi(Request $request, $id_kelurahan)
    {
        $profil = Profil::where('id_kelurahan', $id_kelurahan)->first();

        if (!$profil) {
            return back()->with('error', 'Data profil tidak ditemukan.');
        }

        $profil->misi = $request->misi;
        $profil->save();

        return back()->with('success', 'Misi berhasil diperbarui.');
    }

    public function updateFotoKegiatan(Request $request, $id_kelurahan)
    {
        // Validasi input
        $request->validate([
            'foto_kegiatan'   => 'required|array',
            'foto_kegiatan.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'nama_kegiatan'   => 'required|array',
            'nama_kegiatan.*' => 'required|string|max:255',
        ]);

        // Ambil data profil berdasarkan id_kelurahan
        $profil = Profil::where('id_kelurahan', $id_kelurahan)->first();

        if (!$profil) {
            return back()->with('error', 'Data profil tidak ditemukan.');
        }

        // Loop semua foto yang diupload
        foreach ($request->file('foto_kegiatan') as $index => $file) {
            // Simpan file ke storage
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_kegiatan', $filename);

            // Simpan ke tabel foto_kegiatan
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

        // Hapus file fisik
        \Storage::delete('public/' . $foto->foto);

        // Hapus dari DB
        $foto->delete();

        return back()->with('success', 'Foto berhasil dihapus');
    }

    public function updateSejarah(Request $request, $id_kelurahan)
    {
        $request->validate(['deskripsi' => 'required']);

        $sejarah = Sejarah::where('id_kelurahan', $id_kelurahan)->first();

        // Kalau belum ada, buat baru
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
        $request->validate([
            'deskripsi_umum' => 'required|string',
        ]);

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
            'document_struktur' => 'required|mimes:pdf,jpeg,png,jpg|max:5120', // 5MB
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
                    [
                        'id_kelurahan' => $id_kelurahan,
                        'jenis_kontak' => $jenis
                    ],
                    [
                        'informasi_kontak' => $informasi
                    ]
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
                    [
                        'id_kelurahan' => $id_kelurahan,
                        'jenis_sosial_media' => $jenis
                    ],
                    [
                        'link_sosial_media' => $link
                    ]
                );
            }
        }

        return back()->with('success', 'Sosial media berhasil disimpan.');
    }

    public function updateMaps(Request $request, Kelurahan $kelurahan)
    {
        $request->validate([
            'lokasi_maps' => 'nullable|string',
        ]);

        $kelurahan->update([
            'lokasi_maps' => $request->lokasi_maps
        ]);

        return back()->with('success', 'Lokasi maps berhasil diperbarui.');
    }

    public function updateFotoKelurahan(Request $request, $id)
    {
        $request->validate([
            'foto_kelurahan' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $kelurahan = Kelurahan::findOrFail($id);

        // hapus foto lama kalau ada
        if ($kelurahan->foto_kelurahan && \Storage::exists('public/' . $kelurahan->foto_kelurahan)) {
            \Storage::delete('public/' . $kelurahan->foto_kelurahan);
        }

        // simpan foto baru
        $path = $request->file('foto_kelurahan')->store('foto_kelurahan', 'public');
        $kelurahan->update(['foto_kelurahan' => $path]);

        return back()->with('success', 'Foto kelurahan berhasil diperbarui.');
    }

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
        // Konversi dari domisili_usaha → domisiliUsaha
        $bladeName = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $layanan))));

        return view("admin.pelayanan.$bladeName");
    }


    public function umkm()
    {

        $pegawai = auth()->user();


        $umkm = InformasiUMKM::where('id_kelurahan', $pegawai->id_kelurahan)->get();

        return view('admin.umkm', compact('umkm'));
    }

    public function create()
    {
        return view('admin.creatUmkm');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'tahun' => 'nullable|string|max:4',
            'deskripsi' => 'required|string',
            'nib' => 'nullable|string|max:255',
            'alamat' => 'required|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'grab' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'telp' => 'nullable|string|max:20',
            'jenis_usaha' => 'required|string|max:255',
            'foto_usaha' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Ambil id_kelurahan dari pegawai login
        $pegawai = Pegawai::where('id_kelurahan', Auth::id())->first();
        if (!$pegawai) {
            return back()
                ->withErrors(['pegawai' => 'Data pegawai tidak ditemukan.'])
                ->withInput();
        }

        $id_kelurahan = $pegawai->id_kelurahan;

        // Upload gambar jika ada
        $gambarPath = null;
        if ($request->hasFile('foto_usaha')) {
            try {
                $file = $request->file('foto_usaha');
                $filename = $request->nama . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/foto_usaha', $filename);
                $gambarPath = 'foto_usaha/' . $filename;
            } catch (\Exception $e) {
                return back()
                    ->withErrors(['foto_usaha' => 'Gagal mengunggah foto usaha.'])
                    ->withInput();
            }
        }

        // Simpan data
        InformasiUMKM::create([
            'id_kelurahan' => $id_kelurahan,
            'nib' => $request->nib,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'email' => $request->email,
            'telp' => $request->telp,
            'gambar' => $gambarPath,
            'instagram' => $request->instagram,
            'grab' => $request->grab,
            'facebook' => $request->facebook,
            'tiktok' => $request->tiktok,
            'jenis_usaha' => $request->jenis_usaha,
            'tahun' => $request->tahun_berdiri
        ]);

        return redirect()->route('umkm.create')
            ->with('success', 'Data UMKM berhasil ditambahkan.');
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

        // Update semua data
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


        // Update foto usaha jika ada
        if ($request->hasFile('foto_usaha')) {
            $path = $request->file('foto_usaha')->store('umkm', 'public');
            $umkm->foto_usaha = $path;
        }

        $umkm->save();

        return redirect()
            ->route('umkm.edit', ['id' => $umkm->id_umkm])
            ->with('success', 'Data UMKM berhasil diperbarui');
    }
    public function destroy($id)
    {
        $umkm = InformasiUMKM::findOrFail($id);

        // Hapus gambar jika ada
        if ($umkm->gambar && \Storage::exists('public/' . $umkm->gambar)) {
            \Storage::delete('public/' . $umkm->gambar);
        }

        $umkm->delete();

        return redirect()->route('admin.umkm')
            ->with('success', 'Data UMKM berhasil dihapus');
    }
}
