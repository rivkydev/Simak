@extends('layouts.app')

@section('content')
<style>
    .tab-btn {
        transition: background-color 0.3s ease;
    }

    .tab-btn:hover {
        background-color: #083358;
    }

    .tab-content {
        margin-top: 20px;
    }
</style>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-[#0A142F]">

    <a href="{{ route('kelurahan.index') }}" class="inline-flex items-center px-3 py-1 rounded-md border border-gray-300 text-sm hover:bg-gray-100 mb-4">
        ← Kembali
    </a>

    <div class="flex flex-col md:flex-row items-center md:items-start mb-6 gap-4">
        <img src="{{ asset('assets/logo/parepare.png') }}" alt="Logo Kota Parepare" class="h-16 w-auto">
        <div class="text-center md:text-left">
            <h1 class="text-2xl sm:text-3xl font-bold leading-snug">
                Selamat Datang di Kelurahan {{ $kelurahan->nama }}
            </h1>
            <p class="text-sm mt-1 leading-tight">
                Kec. {{ $kelurahan->kecamatan }}<br>
                Kota Parepare<br>
                Kode Pos {{ $kelurahan->kode_pos }}
            </p>
        </div>
    </div>

    <img
        src="{{ $kelurahan->foto_kelurahan ? asset('storage/' . $kelurahan->foto_kelurahan) : asset('assets/bg/monumen.png') }}"
        alt="Gambar Kelurahan {{ $kelurahan->nama }}"
        class="rounded-xl shadow w-full aspect-[16/9] object-cover mb-6" />

    <div class="flex flex-wrap gap-2 mb-6 overflow-x-auto">
        @foreach (['profil' => 'Profil Kelurahan', 'sejarah' => 'Sejarah Kelurahan', 'potensi' => 'Potensi Kelurahan', 'struktur' => 'Struktur Pemerintahan', 'kontak' => 'Informasi Kontak'] as $key => $label)
        <button onclick="showTab('{{ $key }}')" id="tab-{{ $key }}"
            class="tab-btn {{ $key === 'profil' ? 'bg-green-600' : 'bg-[#0A142F]' }} text-white px-4 py-2 rounded-full text-sm whitespace-nowrap">
            {{ $label }}
        </button>
        @endforeach
    </div>

    <div id="tab-content">
        <div id="content-profil" class="tab-content">
            @if ($profil)
            @include('profilKelurahan.partials._profil', ['data' => $profil, 'kelurahan' => $kelurahan])
            @else
            <p class="text-gray-500 italic">Data profil belum tersedia.</p>
            @endif
        </div>
        <div id="content-sejarah" class="tab-content hidden">
            @if ($sejarah)
            @include('profilKelurahan.partials._sejarah', ['data' => $sejarah, 'kelurahan' => $kelurahan])
            @else
            <p class="text-gray-500 italic">Data sejarah belum tersedia.</p>
            @endif
        </div>
        <div id="content-potensi" class="tab-content hidden">
            @if ($potensi)
            @include('profilKelurahan.partials._potensi', ['data' => $potensi, 'kelurahan' => $kelurahan])
            @else
            <p class="text-gray-500 italic">Data potensi belum tersedia.</p>
            @endif
        </div>
        <div id="content-struktur" class="tab-content hidden">
            @if ($struktur)
            @include('profilKelurahan.partials._struktur', ['data' => $struktur, 'kelurahan' => $kelurahan])
            @else
            <p class="text-gray-500 italic">Struktur pemerintahan belum tersedia.</p>
            @endif
        </div>
        <div id="content-kontak" class="tab-content hidden">
            @if ($kontak)
            @include('profilKelurahan.partials._kontak', ['data' => $kontak, 'kelurahan' => $kelurahan])
            @else
            <p class="text-gray-500 italic">Informasi kontak belum tersedia.</p>
            @endif
        </div>
    </div>
</div>

<script>
    function showTab(tab) {
        const tabs = ['profil', 'sejarah', 'potensi', 'struktur', 'kontak'];
        tabs.forEach(t => {
            document.getElementById('content-' + t).classList.add('hidden');
            document.getElementById('tab-' + t).classList.remove('bg-green-600');
            document.getElementById('tab-' + t).classList.add('bg-[#0A142F]');
        });

        document.getElementById('content-' + tab).classList.remove('hidden');
        document.getElementById('tab-' + tab).classList.remove('bg-[#0A142F]');
        document.getElementById('tab-' + tab).classList.add('bg-green-600');
    }
</script>
@endsection