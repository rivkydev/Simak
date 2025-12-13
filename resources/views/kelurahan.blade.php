@extends('layouts.app')

@section('title', 'Sistem Informasi Profil Kelurahan')

@section('content')

<div class="px-4 md:px-8 py-10 max-w-7xl mx-auto text-[#0A142F]">
    <a href="{{ route('home') }}" class="inline-flex items-center px-3 py-1 rounded-md border border-gray-300 text-sm hover:bg-gray-100 mb-4">
        ← Kembali
    </a>
    <h1 class="text-2xl md:text-3xl font-bold mb-6">Sistem Informasi Profil Kelurahan</h1>

    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-8">
        <select id="filterKecamatan" class="border rounded-md px-4 py-2 w-full md:w-48">
            <option value="">Kecamatan</option>
            @foreach($kecamatanList as $kec)
              <option value="{{ $kec }}">{{ $kec }}</option>
          @endforeach
        </select>

        <div class="relative w-full md:w-1/2">
            <input type="text" id="searchInput" placeholder="Cari Kelurahan"
                class="w-full border rounded-md px-4 py-2 pr-10">
            <span class="material-symbols-outlined absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 cursor-pointer" onclick="document.getElementById('searchInput').value = ''; filterKelurahan();">
                close
            </span>
        </div>
    </div>

    <div id="kelurahanList" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        @foreach($kelurahan as $item)
        <div class="card cursor-pointer border hover:shadow-lg rounded-xl p-5 text-center transition"
            data-nama="{{ strtolower($item['nama']) }}"
            data-kecamatan="{{ strtolower($item['kecamatan']) }}">
            <div class="text-sm bg-[#0A142F] text-white px-2 py-1 rounded-full w-fit text-left mb-2">
                {{ $item['kecamatan'] }}
            </div>
            <span class="material-symbols-outlined text-6xl text-[#0A142F] mb-3">cottage</span>
            <h3 class="text-sm font-medium mb-1">{{ $item['nama'] }}</h3>
            <a class="text-blue-600 text-sm underline">Lihat Profil Kelurahan</a>
        </div>
        @endforeach
    </div>

</div>

<script>
    function filterKelurahan() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const kecamatan = document.getElementById('filterKecamatan').value.toLowerCase();
        const cards = document.querySelectorAll('#kelurahanList .card');

        cards.forEach(card => {
            const nama = card.getAttribute('data-nama');
            const kec = card.getAttribute('data-kecamatan');

            const matchNama = nama.includes(search);
            const matchKec = kecamatan === '' || kec === kecamatan;

            if (matchNama && matchKec) {
                card.classList.remove('hidden');
            } else {
                card.classList.add('hidden');
            }
        });
    }

    document.getElementById('searchInput').addEventListener('input', filterKelurahan);
    document.getElementById('filterKecamatan').addEventListener('change', filterKelurahan);

    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('click', () => {
            const nama = card.getAttribute('data-nama');
            window.location.href = `/kelurahan/${nama}`;
        });
    });

</script>
@endsection
