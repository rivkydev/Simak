@extends('layouts.app')
@section('title', 'Surat Keterangan Kematian')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10 text-[#0A142F]">
    <a href="{{ route('admin.pelayanan') }}" class="flex items-center font-semibold hover:text-blue-600 mb-6">
        <span class="material-symbols-outlined mr-1">arrow_back</span> Kembali
    </a>

    <h1 class="text-2xl sm:text-3xl font-bold text-[#0A142F] mb-8 shadow-sm">Surat Keterangan Kematian</h1>

    <form action="#" method="POST" class="space-y-8 bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div>
            <label class="block font-semibold mb-1">Nomor Surat</label>
            <input type="text" name="nomor_surat" placeholder="Masukkan Nomor Urut Surat"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
        </div>

        <div>
            <h2 class="text-2xl font-semibold mb-4">Biodata</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold mb-1">Nama</label>
                    <input type="text" name="nama" placeholder="Masukkan Nama Lengkap"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>
                <div>
                    <label class="block font-semibold mb-1">Tempat/Tgl Lahir</label>
                    <input type="text" name="ttl" placeholder="Masukkan Tempat/Tgl Lahir"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>

                <div class="md:col-span-2">
                    <label class="block font-semibold mb-1">Jenis Kelamin</label>
                    <div class="flex items-center gap-8">
                        <label class="inline-flex items-center text-sm text-gray-800">
                            <input type="radio" name="jenis_kelamin" value="Laki-Laki" class="form-radio text-blue-600 mr-2" />
                            Laki-Laki
                        </label>
                        <label class="inline-flex items-center text-sm text-gray-800">
                            <input type="radio" name="jenis_kelamin" value="Perempuan" class="form-radio text-blue-600 mr-2" />
                            Perempuan
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Agama</label>
                    <select name="agama"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white">
                        <option value="">Pilih Agama</option>
                        <option>Islam</option>
                        <option>Kristen</option>
                        <option>Katolik</option>
                        <option>Hindu</option>
                        <option>Buddha</option>
                        <option>Konghucu</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Warga Negara</label>
                    <div class="flex items-center gap-6 mt-2 text-sm text-gray-800">
                        <label><input type="radio" name="warga_negara" value="WNI" class="mr-2" /> WNI</label>
                        <label><input type="radio" name="warga_negara" value="WNA" class="mr-2" /> WNA</label>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Pekerjaan</label>
                    <input type="text" name="pekerjaan" placeholder="Masukkan Pekerjaan"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>

                <div>
                    <label class="block font-semibold mb-1">Alamat</label>
                    <input type="text" name="alamat" placeholder="Masukkan Alamat Lengkap"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>

                <div class="flex gap-4">
                    <div>
                        <label class="block font-semibold mb-1">RT</label>
                        <input type="text" name="rt"
                            class="w-20 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">RW</label>
                        <input type="text" name="rw"
                            class="w-20 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-semibold mb-4">Telah Meninggal Dunia Pada</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold mb-1">Hari</label>
                    <select name="hari_kematian"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white">
                        <option value="">Pilih Hari</option>
                        <option>Senin</option>
                        <option>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jumat</option>
                        <option>Sabtu</option>
                        <option>Minggu</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Tanggal</label>
                    <input type="date" name="tanggal_kematian"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>
                <div class="md:col-span-2">
                    <label class="block font-semibold mb-1">Tempat</label>
                    <input type="text" name="tempat_kematian" placeholder="Masukkan Tempat Kematian"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-semibold mb-4">Yang Melapor</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold mb-1">Nama</label>
                    <input type="text" name="nama_pelapor" placeholder="Masukkan Nama Pelapor"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>
                <div>
                    <label class="block font-semibold mb-1">NIK</label>
                    <input type="text" name="nik_pelapor" placeholder="Masukkan NIK Pelapor"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>
                <div>
                    <label class="block font-semibold mb-1">Hubungan dengan yang Meninggal</label>
                    <input type="text" name="hubungan" placeholder="Masukkan Hubungan"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>
                <div>
                    <label class="block font-semibold mb-1">No. HP</label>
                    <input type="text" name="hp" placeholder="Masukkan No. HP Pelapor"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>
            </div>
        </div>

        <div class="pt-6 flex justify-end">
            <button type="submit"
                class="bg-[#0A142F] text-white px-6 py-2 rounded-lg hover:bg-[#1f2a48] transition text-sm">
                Buat Surat
            </button>
        </div>
    </form>
</div>
@endsection
