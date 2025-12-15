@extends('layouts.app')

@section('title', 'Surat Keterangan Domisili Usaha')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <a href="{{ route('admin.pelayanan') }}" class="flex items-center text-bold hover:text-blue-600 mb-6">
            <span class="material-symbols-outlined mr-1">arrow_back</span> Kembali
        </a>
    <h1 class="text-2xl sm:text-3xl font-bold text-[#0A142F] mb-8 shadow-sm">Surat Keterangan Domisili Usaha</h1>

    <form action="{{ route('admin.pelayanan.cetak', 'domisili-usaha') }}" method="POST" class="space-y-6">
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

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
        <label for="nomor_surat" class="font-semibold text-[#0A142F]">Nomor Surat <span class="text-red-500">*</span></label>
        <input type="text" name="nomor_surat" id="nomor_surat" required
            class="sm:col-span-2 w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Contoh: 480/001/SKDU/2025"
            value="{{ old('nomor_surat') }}">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
        <label for="nama_perusahaan" class="font-semibold text-[#0A142F]">Nama Perusahaan <span class="text-red-500">*</span></label>
        <input type="text" name="nama_perusahaan" id="nama_perusahaan" required
            class="sm:col-span-2 w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Masukkan Nama Perusahaan"
            value="{{ old('nama_perusahaan') }}">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
        <label for="penanggung_jawab" class="font-semibold text-[#0A142F]">Nama Penanggung Jawab <span class="text-red-500">*</span></label>
        <input type="text" name="penanggung_jawab" id="penanggung_jawab" required
            class="sm:col-span-2 w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Masukkan Nama Penanggung Jawab Usaha"
            value="{{ old('penanggung_jawab') }}">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
        <label for="alamat_perusahaan" class="font-semibold text-[#0A142F]">Alamat Usaha <span class="text-red-500">*</span></label>
        <textarea name="alamat_perusahaan" id="alamat_perusahaan" required rows="3"
            class="sm:col-span-2 w-full rounded-md border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Masukkan Alamat Lengkap Usaha">{{ old('alamat_perusahaan') }}</textarea>
    </div>

    <div class="flex justify-end pt-4">
        <button type="submit"
            class="bg-[#0A142F] text-white px-6 py-3 rounded-md hover:bg-blue-900 transition flex items-center gap-2">
            <span class="material-symbols-outlined">picture_as_pdf</span>
            Generate & Download PDF
        </button>
    </div>
</form>
</div>
@endsection
