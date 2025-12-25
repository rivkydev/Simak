<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\UMKMKelurahanController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LurahController;

// --- PUBLIC ROUTES (Akses Tanpa Login) ---
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/forgot-password', [LoginController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('password.update');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Kelurahan & UMKM Public
Route::get('/kelurahan', [KelurahanController::class, 'index'])->name('kelurahan.index');
Route::get('/kelurahan/{nama}', [KelurahanController::class, 'show'])->name('kelurahan.show');
Route::get('/umkm', [UMKMKelurahanController::class, 'index'])->name('umkm.kelurahan');
Route::get('/umkm/{slug}', [UMKMKelurahanController::class, 'show'])->name('umkm.show');

// Halaman Pelayanan Public
Route::get('/pelayanan', [PelayananController::class, 'index'])->name('pelayanan.index');
Route::get('/pelayanan/{layanan}', [PelayananController::class, 'detail']);


// =================================================================
// GROUP 1: ADMIN / OPERATOR (ROLE: 1)
// =================================================================
Route::middleware(['auth:pegawai', 'role:1'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Profil Kelurahan
    Route::get('/admin/profil/{id_kelurahan}', [AdminController::class, 'profil'])->name('admin.profil');
    Route::post('admin/profil/{id_kelurahan}/update-deskripsi', [AdminController::class, 'updateDeskripsi'])->name('admin.profil.updateDeskripsi');
    Route::post('admin/profil/{id_kelurahan}/update-visi', [AdminController::class, 'updateVisi'])->name('admin.profil.updateVisi');
    Route::post('admin/profil/{id_kelurahan}/update-misi', [AdminController::class, 'updateMisi'])->name('admin.profil.updateMisi');
    Route::post('admin/profil/{id_kelurahan}/update-foto', [AdminController::class, 'updateFotoKegiatan'])->name('admin.profil.updateFoto');
    Route::post('/admin/profil/{id_kelurahan}/update-sejarah', [AdminController::class, 'updateSejarah'])->name('admin.profil.updateSejarah');
    Route::post('/admin/profil/{id_kelurahan}/update-struktur', [AdminController::class, 'updatestruktur'])->name('admin.profil.updateStruktur');
    Route::post('/admin/profil/{id_kelurahan}/kontak/store', [AdminController::class, 'storeKontak'])->name('admin.profil.storeKontak');
    Route::post('/admin/profil/{id_kelurahan}/sosial/store', [AdminController::class, 'storeSosial'])->name('admin.profil.storeSosial');
    Route::post('/profil/{id}/update-foto-kelurahan', [AdminController::class, 'updateFotoKelurahan'])->name('admin.profil.updateFotoKelurahan');
    Route::delete('/admin/profil/foto/{id_foto}', [AdminController::class, 'deleteFoto'])->name('admin.profil.deleteFoto');
    Route::post('/admin/profil/maps/{kelurahan}', [AdminController::class, 'updateMaps'])->name('admin.profil.updateMaps');
    
    // Potensi
    Route::post('/admin/profil/{id_kelurahan}/update-deskripsi-potensi', [AdminController::class, 'updatePotensiDeskripsi'])->name('admin.potensi.updateDeskripsi');
    Route::post('/admin/profil/{id_kelurahan}/tambah-jenis', [AdminController::class, 'tambahPotensiJenis'])->name('admin.potensi.tambahJenis');
    Route::post('/admin/profil/{id_potensi}/update-jenis', [AdminController::class, 'updatePotensiJenis'])->name('admin.potensi.updateJenis');
    Route::delete('/admin/profil/{id_potensi}/hapus-jenis', [AdminController::class, 'hapusPotensiJenis'])->name('admin.potensi.hapusJenis');

    // Pelayanan Surat (Sisi Admin)
    Route::get('/admin/pelayanan', [AdminController::class, 'pelayanan'])->name('admin.pelayanan');
    Route::get('/admin/pelayanan/{layanan}', [AdminController::class, 'detail'])->name('admin.pelayanan.detail');
    Route::post('/admin/pelayanan/{layanan}', [AdminController::class, 'cetakSurat'])->name('admin.pelayanan.cetak');

    // Manajemen UMKM (Sisi Admin)
    Route::get('/admin/umkm', [AdminController::class, 'umkm'])->name('admin.umkm');
    Route::get('/admin/tambahkanUmkm', [AdminController::class, 'create'])->name('umkm.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('umkm.store');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('umkm.edit');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('umkm.update');
    Route::delete('/umkm/{id_umkm}', [AdminController::class, 'destroy'])->name('umkm.destroy');
});


// =================================================================
// GROUP 2: LURAH (ROLE: 2) & SEKLUR (ROLE: 3)
// =================================================================
Route::middleware(['auth:pegawai', 'role:2,3'])->group(function () {
    Route::get('/pegawai/dashboard', [LurahController::class, 'index'])->name('pegawai.dashboard');
    
    // [FIX] Route Verifikasi dipindahkan ke sini agar Lurah & Seklur bisa akses
    Route::post('/pegawai/surat/{id}/verifikasi', [LurahController::class, 'verifikasiSurat'])->name('pegawai.verifikasiSurat');
    // Di dalam group middleware role:2,3
    Route::get('/pegawai/surat/{id}/preview', [LurahController::class, 'previewSurat'])->name('pegawai.surat.preview');
    // Pengaturan Bobot WSM
    Route::get('/pegawai/pengaturan-bobot', [LurahController::class, 'pengaturanBobot'])->name('pegawai.pengaturanBobot');
    Route::post('/pegawai/update-bobot', [LurahController::class, 'updateBobot'])->name('pegawai.updateBobot');
    
    Route::get('/pegawai/umkm', [LurahController::class, 'umkm'])->name('pegawai.umkm');
});

// Pastikan tidak ada karakter aneh sebelum baris ini
Route::get('/preview-pdf-template', function (\Illuminate\Http\Request $request) {
    // 1. Ambil tipe surat dari URL, default ke 'domisili'
    $type = $request->query('type', 'domisili');

    // 2. Data dummy dasar (Common data)
    $data = [
        'kelurahan' => (object)[
            'nama' => 'Tiro Sompe',
            'kecamatan' => 'Bacukiki Barat',
            'kode_pos' => '91125'
        ],
        'alamat_kelurahan' => 'Jl. Bau Massepe No. 151',
        'nomor_surat' => '400/001/KTS/XII/2025',
        'nama_lurah' => 'NAMA LURAH CONTOH, S.Sos',
        'nip_lurah' => '19800101 200501 1 001',
        'nama' => 'BUDI SANTOSO',
        'alamat' => 'Jl. Pelabuhan No. 10, Kel. Tiro Sompe',
    ];

    // 3. Logika penentuan View dan Data Spesifik
    switch ($type) {
        case 'domisili':
            $view = 'surat.domisili_usaha_pdf'; // Sesuaikan folder jika ada (misal: 'surat.domisili_usaha_pdf')
            $data['nama_perusahaan'] = 'UMKM SEJAHTERA BERSAMA';
            $data['penanggung_jawab'] = 'BUDI SANTOSO';
            $data['alamat_perusahaan'] = 'Jl. Pelabuhan No. 10, Kel. Tiro Sompe';
            break;
            
        case 'kematian':
            $view = 'surat.kematian_pdf';
            $data['jenkel'] = 'Laki-laki';
            $data['hari_kematian'] = 'Senin';
            $data['tanggal_kematian'] = '22 Desember 2025';
            $data['sebab_kematian'] = 'Sakit';
            break;
            
        case 'waris':
            $view = 'surat.ahli_waris_pdf';
            $data['nama_pewaris'] = 'ALMARHUM FULAN';
            $data['tanggal_meninggal'] = '01 Januari 2025';
            $data['daftar_ahli_waris'] = [
                ['nama' => 'SITI AMINAH', 'hubungan' => 'Istri'],
                ['nama' => 'AHMAD RIFAI', 'hubungan' => 'Anak Kandung'],
            ];
            break;
            
        case 'nikah':
            $view = 'surat.belum_menikah_pdf';
            $data['tempat_lahir'] = 'Parepare';
            $data['tanggal_lahir'] = '10 Mei 1995';
            break;

        case 'rumah':
            $view = 'surat.tidak_memiliki_rumah_pdf';
            $data['pekerjaan'] = 'Wiraswasta';
            break;

        default:
            return response("Tipe surat '$type' tidak ditemukan.", 404);
    }

    return view($view, $data);
});