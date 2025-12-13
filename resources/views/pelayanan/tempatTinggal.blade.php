@extends('layouts.app')

@section('title', 'Surat Keterangan Tempat Tinggal')

@section('content')
<div class="bg-[#CBDCEB] w-full">
    <div class="px-4 md:px-8 py-10 max-w-4xl mx-auto text-[#0A142F] font-semibold">
        <a href="{{ route('pelayanan.index') }}" class="flex items-center text-bold hover:text-blue-600 mb-6">
            <span class="material-symbols-outlined mr-1">arrow_back</span> Kembali
        </a>

        <h1 class="text-3xl font-bold mb-2">Surat Keterangan Tempat Tinggal</h1>
        <p class="font-semibold mb-6">Pengajuan Surat Keterangan Tempat Tinggal di Kelurahan</p>

        <div class="mb-2">
            <h2 class="text-xl font-semibold mb-2">Deskripsi Surat</h2>
            <p class="font-semibold">
                Surat Keterangan Tempat Tinggal adalah dokumen resmi yang diberikan oleh kelurahan sebagai bukti bahwa seseorang benar-benar tinggal atau berdomisili di alamat tertentu dalam wilayah kelurahan tersebut.
            </p>
        </div>
    </div>
</div>

<div class="px-4 md:px-8 py-6 max-w-4xl mx-auto text-[#0A142F]">
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-2">Kelengkapan Dokumen</h2>
        <ul class="font-semibold space-y-2">
            <li class="flex items-start gap-2">
                <span class="material-symbols-outlined text-orange-500 min-w-[24px]">task_alt</span>
                Surat Pengantar RT/RW
            </li>
            <li class="flex items-start gap-2">
                <span class="material-symbols-outlined text-orange-500 min-w-[24px]">task_alt</span>
                Fotocopy Kartu Tanda Penduduk (KTP)
            </li>
            <li class="flex items-start gap-2">
                <span class="material-symbols-outlined text-orange-500 min-w-[24px]">task_alt</span>
                Fotocopy Kartu Keluarga (KK)
            </li>
            <li class="flex items-start gap-2">
                <span class="material-symbols-outlined text-orange-500 min-w-[24px]">task_alt</span>
                Bukti Pelunasan PBB Tahun Berjalan
            </li>
        </ul>
    </div>

    <div>
        <h2 class="text-xl font-semibold mb-2">Langkah-Langkah Pelayanan :</h2>
        <ol class="font-semibold space-y-3">
            @php
                $steps = [
                    'Pemohon datang ke kantor kelurahan untuk mengurus Surat Keterangan Tempat Tinggal',
                    'Menyerahkan dokumen kepada staf kelurahan.',
                    'Staf kelurahan melakukan verifikasi dokumen.',
                    'Jika semua dokumen lengkap, surat keterangan diproses.',
                    'Lurah atau pejabat berwenang menandatangani surat keterangan.',
                    'Surat diserahkan kepada pemohon sebagai bukti resmi tempat tinggal sementara atau tetap.'
                ];
            @endphp

            @foreach ($steps as $i => $step)
            <li class="flex items-start gap-2">
                <span class="material-symbols-outlined text-blue-600 min-w-[24px]">counter_{{ $i + 1 }}</span>
                {{ $step }}
            </li>
            @endforeach
        </ol>
    </div>
</div>
@endsection
