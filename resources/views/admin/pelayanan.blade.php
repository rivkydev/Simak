@extends('layouts.app')

@section('title', 'Pelayanan Administrasi Surat')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-6">Pelayanan Persuratan</h1>

    <div class="mb-6">
        <input type="text" id="searchInput" placeholder="Cari jenis surat..." 
               class="w-full border rounded-lg px-4 py-2" />
        <button id="clearSearch" class="mt-2 text-sm text-blue-600 hidden">Bersihkan Pencarian</button>
    </div>

    <div id="layananList" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
        @foreach ($layanan as $item)
            @php
                $slug = strtolower(str_replace(' ', '_', str_replace('Surat Keterangan ', '', $item)));
            @endphp

            <a href="{{ url('/admin/pelayanan/' . $slug) }}" 
               class="block group cursor-pointer border hover:shadow-lg rounded-xl p-5 text-center transition"
               data-nama="{{ strtolower($item) }}">

                <div class="text-sm bg-[#0A142F] text-white px-3 py-1 rounded-full w-fit ml-0 mb-2">
                    Surat Keterangan
                </div>

                <span class="material-symbols-outlined text-[#0A142F] mb-3" style="font-size: 60px;">
                    edit_document
                </span>

                <h2 class="text-base font-semibold text-gray-800 mb-1">{{ $item }}</h2>

                <span class="text-blue-600 text-sm underline">Buat Surat</span>
            </a>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const clearBtn = document.getElementById('clearSearch');
        const cards = document.querySelectorAll('#layananList a');

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const keyword = this.value.toLowerCase();
                const isFiltered = keyword !== '';

                cards.forEach(card => {
                    const nama = card.getAttribute('data-nama');
                    card.classList.toggle('hidden', !nama.includes(keyword));
                });

                clearBtn.classList.toggle('hidden', !isFiltered);
            });

            clearBtn.addEventListener('click', function () {
                searchInput.value = '';
                cards.forEach(card => card.classList.remove('hidden'));
                this.classList.add('hidden');
                searchInput.focus();
            });
        }
    });
</script>
@endsection
