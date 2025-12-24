@extends('layouts.app')
@section('title', 'Surat Keterangan Kematian')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10 text-[#0A142F]">
    <a href="{{ route('admin.pelayanan') }}" class="flex items-center font-semibold hover:text-blue-600 mb-6">
        <span class="material-symbols-outlined mr-1">arrow_back</span> Kembali
    </a>

    <h1 class="text-2xl sm:text-3xl font-bold text-[#0A142F] mb-8 shadow-sm">Surat Keterangan Kematian</h1>

    <form action="{{ route('admin.pelayanan.cetak', 'kematian') }}" method="POST" class="space-y-8 bg-white p-6 rounded-lg shadow-md">
        @csrf

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label class="block font-semibold mb-1">Nomor Surat <span class="text-red-500">*</span></label>
            <input type="text" name="nomor_surat" placeholder="Masukkan Nomor Urut Surat" required
                value="{{ old('nomor_surat') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
        </div>

        <div>
            <h2 class="text-2xl font-semibold mb-4">Data Almarhum/Almarhumah</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required
                        value="{{ old('nama') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>
                
                <div>
                    <label class="block font-semibold mb-1">NIK</label>
                    <input type="text" name="nik" placeholder="Masukkan NIK"
                        value="{{ old('nik') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>

                <div>
                    <label class="block font-semibold mb-1">Tempat/Tgl Lahir</label>
                    <input type="text" name="ttl" placeholder="Contoh: Parepare, 15 Agustus 1970"
                        value="{{ old('ttl') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>

                <div>
                    <label class="block font-semibold mb-1">Jenis Kelamin</label>
                    <div class="flex items-center gap-8 mt-2">
                        <label class="inline-flex items-center text-sm text-gray-800">
                            <input type="radio" name="jenis_kelamin" value="Laki-Laki" class="form-radio text-blue-600 mr-2" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'checked' : '' }} />
                            Laki-Laki
                        </label>
                        <label class="inline-flex items-center text-sm text-gray-800">
                            <input type="radio" name="jenis_kelamin" value="Perempuan" class="form-radio text-blue-600 mr-2" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} />
                            Perempuan
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Agama</label>
                    <select name="agama"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white">
                        <option value="">Pilih Agama</option>
                        @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                            <option value="{{ $agama }}" {{ old('agama') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Pekerjaan</label>
                    <input type="text" name="pekerjaan" placeholder="Masukkan Pekerjaan"
                        value="{{ old('pekerjaan') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>

                <div class="md:col-span-2">
                    <label class="block font-semibold mb-1">Alamat</label>
                    <input type="text" name="alamat" placeholder="Masukkan Alamat Lengkap"
                        value="{{ old('alamat') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-semibold mb-4">Data Kematian</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold mb-1">Hari Meninggal</label>
                    <select name="hari_kematian"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white">
                        <option value="">Pilih Hari</option>
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                            <option value="{{ $hari }}" {{ old('hari_kematian') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block font-semibold mb-1">Tanggal Meninggal</label>
                    <input type="date" name="tanggal_kematian"
                        value="{{ old('tanggal_kematian') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>

                <div class="md:col-span-2">
                    <label class="block font-semibold mb-1">Tempat Meninggal</label>
                    <input type="text" name="tempat_kematian" placeholder="Contoh: RSUD Andi Makkasau"
                        value="{{ old('tempat_kematian') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>

                <div class="md:col-span-2">
                    <label class="block font-semibold mb-1">Penyebab Kematian (Opsional)</label>
                    <input type="text" name="penyebab_kematian" placeholder="Contoh: Sakit"
                        value="{{ old('penyebab_kematian') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-semibold mb-4">Data Pelapor</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold mb-1">Nama Pelapor <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_pelapor" placeholder="Masukkan Nama Pelapor" required
                        value="{{ old('nama_pelapor') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>
                
                <div>
                    <label class="block font-semibold mb-1">NIK Pelapor</label>
                    <input type="text" name="nik_pelapor" placeholder="Masukkan NIK Pelapor"
                        value="{{ old('nik_pelapor') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>

                <div>
                    <label class="block font-semibold mb-1">Hubungan dengan Almarhum/ah</label>
                    <input type="text" name="hubungan" placeholder="Contoh: Anak Kandung"
                        value="{{ old('hubungan') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>
            </div>
        </div>

        <div class="pt-6 flex justify-end">
            <button type="submit"
                class="bg-[#0A142F] text-white px-6 py-2 rounded-lg hover:bg-[#1f2a48] transition text-sm flex items-center gap-2">
                <span class="material-symbols-outlined">picture_as_pdf</span>
                Generate & Download PDF
            </button>
        </div>
    </form>
</div>
@endsection