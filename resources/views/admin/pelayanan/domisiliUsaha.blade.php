@extends('layouts.app')

@section('title', 'Surat Keterangan Domisili Usaha')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <a href="{{ route('admin.pelayanan') }}" class="flex items-center text-bold hover:text-blue-600 mb-6">
            <span class="material-symbols-outlined mr-1">arrow_back</span> Kembali
        </a>
    <h1 class="text-2xl sm:text-3xl font-bold text-[#0A142F] mb-8 shadow-sm">Surat Keterangan Domisili Usaha</h1>

    <form action="" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
            <label for="nomor_surat" class="font-semibold text-[#0A142F]">Nomor Surat</label>
            <input type="text" name="nomor_surat" id="nomor_surat"
                class="sm:col-span-2 w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Masukkan Nomor Urut Surat">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
            <label for="nama_perusahaan" class="font-semibold text-[#0A142F]">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" id="nama_perusahaan"
                class="sm:col-span-2 w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Masukkan Nama Perusahaan yang Bermohon">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
            <label for="penanggung_jawab" class="font-semibold text-[#0A142F]">Nama Penanggung Jawab Usaha</label>
            <input type="text" name="penanggung_jawab" id="penanggung_jawab"
                class="sm:col-span-2 w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Masukkan Nama Penanggung Jawab Usaha">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
            <label for="alamat_perusahaan" class="font-semibold text-[#0A142F]">Alamat Perusahaan</label>
            <input type="text" name="alamat_perusahaan" id="alamat_perusahaan"
                class="sm:col-span-2 w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Masukkan Alamat Perusahaan">
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit"
                class="bg-[#0A142F] text-white px-6 py-2 rounded-md hover:bg-blue-900 transition">
                Buat Surat
            </button>
        </div>
    </form>
</div>
@endsection
