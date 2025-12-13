@extends('layouts.app')

@section('title', 'Surat Belum Menikah')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10 text-[#0A142F]">
    <a href="{{ route('admin.pelayanan') }}" class="flex items-center font-semibold hover:text-blue-600 mb-6">
        <span class="material-symbols-outlined mr-1">arrow_back</span> Kembali
    </a>

    <h1 class="text-2xl sm:text-3xl font-bold mb-8 shadow-sm">Surat Belum Menikah</h1>

    <form action="#" method="POST" class="space-y-5 bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Nomor Surat</label>
            <input type="text" name="nomor_surat" placeholder="Masukkan Nomor Urut Surat"
                class="w-full md:w-2/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Nama</label>
            <input type="text" name="nama" placeholder="Masukkan Nama Lengkap"
                class="w-full md:w-2/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
        </div>
        
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">NIK</label>
            <input type="text" name="nik" placeholder="Masukkan NIK"
                class="w-full md:w-2/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Tempat/Tgl Lahir</label>
            <input type="text" name="ttl" placeholder="Masukkan Tempat/Tgl Lahir"
                class="w-full md:w-2/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Jenis Kelamin</label>
            <div class="flex gap-6 text-sm text-gray-800 w-full md:w-2/3">
                <label class="inline-flex items-center"><input type="radio" name="jenis_kelamin" value="Laki-Laki" class="mr-2">Laki-Laki</label>
                <label class="inline-flex items-center"><input type="radio" name="jenis_kelamin" value="Perempuan" class="mr-2">Perempuan</label>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Agama</label>
            <select name="agama"
                class="w-full md:w-2/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800">
                <option value="">Pilih Agama</option>
                @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                    <option>{{ $agama }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Warga Negara</label>
            <div class="flex gap-6 text-sm text-gray-800 w-full md:w-2/3">
                <label><input type="radio" name="warga_negara" value="WNI" class="mr-2"> WNI</label>
                <label><input type="radio" name="warga_negara" value="WNA" class="mr-2"> WNA</label>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Pekerjaan</label>
            <input type="text" name="pekerjaan" placeholder="Masukkan Pekerjaan"
                class="w-full md:w-2/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">Alamat</label>
            <input type="text" name="alamat" placeholder="Masukkan Alamat Lengkap"
                class="w-full md:w-2/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/3 text-sm font-medium">RT / RW</label>
            <div class="flex gap-4 w-full md:w-2/3 items-center">
                <input type="text" name="rt" placeholder="RT"
                    class="w-20 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
                <span class="text-gray-500">/</span>
                <input type="text" name="rw" placeholder="RW"
                    class="w-20 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800" />
            </div>
        </div>

        <div class="flex justify-end pt-6">
            <button type="submit"
                class="bg-[#0A142F] text-white px-6 py-2 rounded-lg hover:bg-[#1f2a48] transition text-sm">
                Buat Surat
            </button>
        </div>
    </form>
</div>
@endsection
