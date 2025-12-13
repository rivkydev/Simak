@extends('layouts.app')

@section('title', 'Informasi Pelayanan Kelurahan')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <a href="{{ route('home') }}" class="inline-flex items-center px-3 py-1 rounded-md border border-gray-300 text-sm hover:bg-gray-100 mb-4">
        ← Kembali
    </a>
    <h1 class="text-3xl font-bold mb-6">Informasi Pelayanan Persuratan</h1>

    <div class="relative mb-8 max-w-md">
        <input type="text" id="searchInput" placeholder="Cari Pelayanan Surat"
            class="w-full pl-10 pr-10 py-3 rounded-full border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        <span class="material-symbols-outlined absolute left-3 top-3 text-gray-400">search</span>
        <button id="clearSearch" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 hidden">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    <div id="layananList" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
        @foreach ($layanan as $item)
            @php
                $slug = strtolower(str_replace(' ', '-', str_replace('Surat Keterangan ', '', $item)));
            @endphp
            <a href="{{ url('/pelayanan/' . $slug) }}"
            class="block group cursor-pointer border hover:shadow-lg rounded-xl p-5 text-center transition"
            data-nama="{{ strtolower($item) }}">

            <div class="text-sm bg-[#0A142F] text-white px-2 py-1 rounded-full w-fit text-left mb-2">
                Surat Keterangan
            </div>
            <span class="material-symbols-outlined text-6xl text-[#0A142F] mb-3">
                mark_email_read
            </span>
            <h2 class="text-sm font-medium mb-1">{{ $item }}</h2>
            <span class="text-blue-600 text-sm underline">Lihat Detail Syarat Pelayanan</span>
        </a>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const clearBtn = document.getElementById('clearSearch');
        const cards = document.querySelectorAll('#layananList a');

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            let isFiltered = keyword !== '';

            cards.forEach(card => {
                const nama = card.getAttribute('data-nama');
                if (nama.includes(keyword)) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });

            clearBtn.classList.toggle('hidden', !isFiltered);
        });

        clearBtn.addEventListener('click', function () {
            searchInput.value = '';
            cards.forEach(card => card.classList.remove('hidden'));
            this.classList.add('hidden');
            searchInput.focus();
        });
    });
</script>
@endsection
