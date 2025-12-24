@extends('layouts.app')

@section('title', 'Surat Keterangan Tidak Memiliki Rumah')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10 text-[#0A142F]">
    <a href="{{ route('admin.pelayanan') }}" class="flex items-center font-semibold hover:text-blue-600 mb-6">
        <span class="material-symbols-outlined mr-1">arrow_back</span> Kembali
    </a>

    <h1 class="text-2xl sm:text-3xl font-bold mb-8 shadow-sm">Surat Keterangan Tidak Memiliki Rumah</h1>

    <form action="{{ route('admin.pelayanan.cetak', 'tidak-memiliki-rumah') }}" method="POST" class="space-y-5 bg-white p-6 rounded-lg shadow-md">
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

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Nomor Surat <span class="text-red-500">*</span></label>
            <input type="text" name="nomor_surat" placeholder="Masukkan Nomor Urut Surat" required
                value="{{ old('nomor_surat') }}"
                class="w-full md:w-2/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required
                value="{{ old('nama') }}"
                class="w-full md:w-2/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
        </div>
        
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">NIK</label>
            <input type="text" name="nik" placeholder="Masukkan NIK"
                value="{{ old('nik') }}"
                class="w-full md:w-2/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Tempat/Tgl Lahir</label>
            <input type="text" name="ttl" placeholder="Masukkan Tempat/Tgl Lahir"
                value="{{ old('ttl') }}"
                class="w-full md:w-2/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Jenis Kelamin</label>
            <div class="flex gap-6 text-sm text-gray-800 w-full md:w-2/3">
                <label class="inline-flex items-center">
                    <input type="radio" name="jenis_kelamin" value="Laki-Laki" class="mr-2" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'checked' : '' }}>Laki-Laki
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="jenis_kelamin" value="Perempuan" class="mr-2" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>Perempuan
                </label>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Agama</label>
            <select name="agama"
                class="w-full md:w-2/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800">
                <option value="">Pilih Agama</option>
                @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                    <option value="{{ $agama }}" {{ old('agama') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Warga Negara</label>
            <div class="flex gap-6 text-sm text-gray-800 w-full md:w-2/3">
                <label><input type="radio" name="warga_negara" value="WNI" class="mr-2" {{ old('warga_negara') == 'WNI' ? 'checked' : '' }}> WNI</label>
                <label><input type="radio" name="warga_negara" value="WNA" class="mr-2" {{ old('warga_negara') == 'WNA' ? 'checked' : '' }}> WNA</label>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Pekerjaan</label>
            <input type="text" name="pekerjaan" placeholder="Masukkan Pekerjaan"
                value="{{ old('pekerjaan') }}"
                class="w-full md:w-2/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Alamat Saat Ini</label>
            <input type="text" name="alamat" placeholder="Masukkan Alamat Lengkap"
                value="{{ old('alamat') }}"
                class="w-full md:w-2/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">RT / RW</label>
            <div class="flex gap-4 w-full md:w-2/3 items-center">
                <input type="text" name="rt" placeholder="RT"
                    value="{{ old('rt') }}"
                    class="w-20 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
                <span class="text-gray-500">/</span>
                <input type="text" name="rw" placeholder="RW"
                    value="{{ old('rw') }}"
                    class="w-20 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
            </div>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mt-6">
            <div class="flex items-start gap-2">
                <span class="material-symbols-outlined text-yellow-600">info</span>
                <div class="text-sm text-yellow-800">
                    <p class="font-semibold mb-1">Catatan Penting:</p>
                    <p>Surat ini menyatakan bahwa pemohon <strong>TIDAK MEMILIKI RUMAH/TEMPAT TINGGAL</strong> sendiri baik di wilayah kelurahan setempat maupun di wilayah lainnya.</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6">
            <button type="submit"
                class="bg-[#0A142F] text-white px-6 py-2 rounded-lg hover:bg-[#1f2a48] transition text-sm flex items-center gap-2">
                <span class="material-symbols-outlined">picture_as_pdf</span>
                Generate & Download PDF
            </button>
        </div>
    </form>
</div>
@endsection