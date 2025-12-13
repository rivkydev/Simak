@extends('layouts.app')

@section('title', 'Surat Keterangan Penghasilan Orang Tua')

@section('content')
<div class="bg-[#CBDCEB] w-full">
    <div class="px-4 md:px-8 py-10 max-w-4xl mx-auto text-[#0A142F] font-semibold">
        <a href="{{ route('pelayanan.index') }}" class="flex items-center text-bold hover:text-blue-600 mb-6">
            <span class="material-symbols-outlined mr-1">arrow_back</span> Kembali
        </a>

        <h1 class="text-3xl font-bold mb-2">Surat Keterangan Penghasilan Orang Tua</h1>
        <p class="font-semibold mb-6">Pengajuan surat ini diperlukan untuk keperluan administrasi pendidikan, beasiswa, atau kebutuhan lainnya.</p>

        <div class="mb-2">
            <h2 class="text-xl font-semibold mb-2">Deskripsi Surat</h2>
            <p class="font-semibold">
                Surat Keterangan Penghasilan Orang Tua adalah dokumen resmi yang menerangkan jumlah penghasilan orang tua/wali pemohon. Dokumen ini biasa digunakan untuk keperluan administratif seperti pendaftaran sekolah, beasiswa, atau pengajuan bantuan.
            </p>
        </div>
    </div>
</div>

<div class="px-4 md:px-8 py-6 max-w-4xl mx-auto text-[#0A142F]">
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-2">Kelengkapan Dokumen</h2>
        <ul class="font-semibold space-y-2">
            <li class="flex items-start gap-2">
                <span class="material-symbols-outlined text-orange-500">task_alt</span>
                Surat Pengantar RT/RW
            </li>
            <li class="flex items-start gap-2">
                <span class="material-symbols-outlined text-orange-500">task_alt</span>
                Fotokopi Kartu Keluarga (KK)
            </li>
            <li class="flex items-start gap-2">
                <span class="material-symbols-outlined text-orange-500">task_alt</span>
                Fotokopi KTP Orang Tua/Wali
            </li>
            <li class="flex items-start gap-2">
                <span class="material-symbols-outlined text-orange-500">task_alt</span>
                Slip Gaji atau Surat Pernyataan Penghasilan
            </li>
        </ul>
    </div>

    <div>
        <h2 class="text-xl font-semibold mb-2">Langkah-Langkah Pelayanan</h2>
        <ol class="font-semibold space-y-3">
            @php
                $steps = [
                    'Pemohon datang ke kantor kelurahan dengan membawa dokumen yang dipersyaratkan.',
                    'Mengisi formulir permohonan Surat Keterangan Penghasilan Orang Tua.',
                    'Petugas memeriksa kelengkapan dan keabsahan dokumen.',
                    'Surat diproses dan ditandatangani oleh pejabat kelurahan.',
                    'Pemohon menerima surat untuk digunakan sesuai keperluan.'
                ];
            @endphp
            @foreach ($steps as $i => $step)
            <li class="flex items-start gap-2">
                <span class="material-symbols-outlined text-blue-600">counter_{{ $i + 1 }}</span>
                {{ $step }}
            </li>
            @endforeach
        </ol>
    </div>
</div>
@endsection
