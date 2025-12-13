@extends('layouts.app')

@section('title', 'Sistem Informasi UMKM')

@section('content')
<div class="px-4 md:px-8 py-10 max-w-7xl mx-auto text-[#0A142F]">
    <a href="{{ route('home') }}" class="inline-flex items-center px-3 py-1 rounded-md border border-gray-300 text-sm hover:bg-gray-100 mb-4">
        ← Kembali
    </a>
    <h1 class="text-3xl font-bold mb-1">Usaha Mikro Kecil Menengah</h1>
    <p class="text-gray-600 mb-4">Daftar UMKM yang ada di Kota Parepare</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
        @foreach ($kecamatanData as $item)
        <div class="bg-white rounded-xl shadow p-4 transition hover:shadow-md">
            <div class="flex items-center space-x-4">
                <span class="material-symbols-outlined text-6xl text-[#0A142F]">storefront</span>
                <div>
                    <h3 class="text-sm font-semibold text-[#0A142F]">{{ $item['nama'] }}</h3>
                    <p class="text-2xl font-bold text-[#0A142F]">{{ $item['jumlah'] }}</p>
                </div>
            </div>
            <div class="mt-3 flex items-center text-sm text-green-600 gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h3V6a1 1 0 112 0v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                </svg>
                <span>{{ $item['pertumbuhan'] }}% dari bulan lalu</span>
            </div>
        </div>
        @endforeach
    </div>


    <h2 class="text-2xl font-bold mb-1">Informasi UMKM</h2>
    <div class="flex flex-col md:flex-row gap-4 mb-6">
        <div class="w-full md:w-1/4">
            <select id="kecamatanFilter" class="w-full rounded-lg border border-gray-300 px-4 py-2">
                <option value="">Semua Kecamatan</option>
                @foreach($kelurahanList->pluck('kecamatan')->unique() as $kec)
                <option value="{{ strtolower($kec) }}">{{ $kec }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-full md:w-1/4">
            <select id="kelurahanFilter" class="w-full rounded-lg border border-gray-300 px-4 py-2">
                <option value="">Semua Kelurahan</option>

                @foreach($kelurahanList as $kel)
                <option value="{{ strtolower($kel->nama) }}" data-kecamatan="{{ strtolower($kel->kecamatan) }}">
                    {{ $kel->nama }}
                </option>
                @endforeach

            </select>
        </div>

        <div class="relative w-full md:w-1/2">
            <input type="text" id="searchInput" placeholder="Cari UMKM"
                class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300" />
            <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400">search</span>
        </div>
    </div>

    <div id="umkmList" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        @foreach($umkm as $item)
        <a href="{{ route('umkm.show', ['slug' => Str::slug($item->nama)]) }}"
            class="umkm-card block border rounded-xl p-5 text-center hover:shadow-lg transition cursor-pointer"
            data-nama="{{ strtolower($item->nama) }}"
            data-kelurahan="{{ strtolower($item->kelurahan_nama) }}"
            data-kecamatan="{{ strtolower($item->kecamatan) }}">

            <div class="bg-[#0A142F] text-white text-sm px-3 py-1 rounded-full w-fit mx-auto mb-2">
                {{ $item->kelurahan_nama }} - {{ $item->kecamatan }}
            </div>
            <span class="material-symbols-outlined text-6xl text-[#0A142F] mb-3">storefront</span>
            <h3 class="text-sm font-medium mb-1">{{ $item->nama }}</h3>
            <p class="text-blue-600 text-sm underline">Lihat Detail UMKM</p>
        </a>
        @endforeach
    </div>



</div>

<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const kecamatanFilter = document.getElementById('kecamatanFilter');
        const kelurahanFilter = document.getElementById('kelurahanFilter');
        const searchInput = document.getElementById('searchInput');
        const cards = document.querySelectorAll('.umkm-card');

        const filterUMKM = () => {
            const kec = kecamatanFilter.value.toLowerCase();
            const kel = kelurahanFilter.value.toLowerCase();
            const search = searchInput.value.toLowerCase();

            cards.forEach(card => {
                const cardKel = card.dataset.kelurahan;
                const cardKec = card.dataset.kecamatan;
                const cardNama = card.dataset.nama;

                const isVisible =
                    (!kec || cardKec === kec) &&
                    (!kel || cardKel === kel) &&
                    (!search || cardNama.includes(search));

                card.style.display = isVisible ? 'block' : 'none';
            });
        };

        const updateKelurahanOptions = () => {
            const selectedKec = kecamatanFilter.value.toLowerCase();

            Array.from(kelurahanFilter.options).forEach(option => {
                if (option.value === '') return option.style.display = 'block';
                option.style.display = (!selectedKec || option.dataset.kecamatan === selectedKec) ? 'block' : 'none';
            });

            kelurahanFilter.value = '';
            filterUMKM();
        };

        kecamatanFilter.addEventListener('change', updateKelurahanOptions);
        kelurahanFilter.addEventListener('change', filterUMKM);
        searchInput.addEventListener('input', filterUMKM);

        updateKelurahanOptions(); // Inisialisasi awal
    });
</script>
@endsection