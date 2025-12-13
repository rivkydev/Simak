@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" id="lurah-dashboard">

    {{-- HEADER --}}
    <h1 class="text-3xl font-extrabold text-[#0A142F] drop-shadow-sm">
        <div class="font-bold">Hi! {{ $pegawai->nama }}</div>
    </h1>

    @php
        $jabatan = $pegawai->id_jabatan ?? null;
        $namaKelurahan = $pegawai->kelurahan->nama ?? '-';
    @endphp

    <p class="text-lg text-gray-600 mb-8">
        Selamat datang di Dashboard 
        @if($jabatan == 2)
            <span class="font-bold text-blue-600">Sekretaris Lurah</span>
        @elseif($jabatan == 3)
            <span class="font-bold text-blue-600">Lurah</span>
        @else
            <span class="font-bold text-blue-600">Pegawai</span>
        @endif
        <span class="font-semibold text-[#0A142F]"> {{ $namaKelurahan }}</span>
    </p>

    {{-- KARTU STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach($statistik as $item)
            <div class="flex h-full items-center bg-white rounded-xl shadow-sm border border-gray-300 p-4 hover:shadow-md transition">
                <div class="flex-shrink-0">
                    <img src="{{ asset('assets/'.$item['icon']) }}" alt="{{ $item['label'] }}" class="w-12 h-12 object-contain">
                </div>
                <div class="ml-4 flex flex-col justify-center">
                    <p class="text-sm font-medium text-gray-600">{{ $item['label'] }}</p>
                    <p class="text-2xl font-bold text-center text-[#0A142F]">{{ $item['value'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- GRAFIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-4 rounded-xl shadow-md min-h-[200px]">
            <h2 class="font-semibold text-lg mb-2">Status Permohonan Surat</h2>
            <canvas id="statusPieChart" height="200"></canvas>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-md min-h-[200px]">
            <h2 class="font-semibold text-lg mb-2">Tren Surat Masuk</h2>
            <canvas id="suratLineChart" height="200"></canvas>
        </div>
    </div>

    {{-- FILTER OTOMATIS --}}
    <div class="bg-white p-5 rounded-xl shadow mb-6 border-l-4 border-[#0A142F]">
        <div class="flex flex-col md:flex-row justify-between items-center mb-2">
            <h3 class="text-md font-bold text-gray-800">Daftar Prioritas Surat (WSM)</h3>
            <span class="text-xs text-gray-500 italic">*Data diurutkan otomatis berdasarkan tingkat urgensi</span>
        </div>
        
        {{-- Form Filter tanpa Tombol Submit --}}
        <form id="filterForm" action="{{ url()->current() }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            {{-- Search Input (Live Typing) --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase">Cari Pemohon</label>
                <div class="relative">
                    <input type="text" name="search" id="searchInput" value="{{ $currentSearch ?? '' }}" 
                        placeholder="Ketik nama pemohon..." 
                        class="w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm px-3 py-2 pl-10">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-gray-400 text-lg">search</span>
                    </div>
                </div>
            </div>

            {{-- Filter Jenis Surat (Auto Change) --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase">Filter Jenis Surat</label>
                <select name="jenis_surat" id="jenisSuratInput" class="w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm px-3 py-2 cursor-pointer">
                    <option value="">Semua Jenis Surat</option>
                    <option value="Surat Keterangan Domisili Usaha" {{ ($currentJenis ?? '') == 'Surat Keterangan Domisili Usaha' ? 'selected' : '' }}>Domisili Usaha</option>
                    <option value="Surat Keterangan Belum Menikah" {{ ($currentJenis ?? '') == 'Surat Keterangan Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                    <option value="Surat Keterangan Domisili" {{ ($currentJenis ?? '') == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Domisili</option>
                    <option value="Surat Keterangan Tempat Tinggal" {{ ($currentJenis ?? '') == 'Surat Keterangan Tempat Tinggal' ? 'selected' : '' }}>Tempat Tinggal</option>
                    <option value="Surat Keterangan Penghasilan Orang Tua" {{ ($currentJenis ?? '') == 'Surat Keterangan Penghasilan Orang Tua' ? 'selected' : '' }}>Penghasilan Ortu</option>
                </select>
            </div>
        </form>
    </div>

    {{-- TABEL DATA --}}
    <div id="tableContainer" class="overflow-x-auto rounded-xl shadow border border-gray-200 bg-white min-h-[300px]">
        <table class="min-w-full text-sm text-center">
            <thead class="bg-[#0A142F] text-white">
                <tr>
                    <th class="py-3 px-4 w-12">NO</th>
                    <th class="py-3 px-4 text-left">NAMA PEMOHON</th>
                    <th class="py-3 px-4 text-left">JENIS SURAT</th>
                    <th class="py-3 px-4">TANGGAL MASUK</th>
                    {{-- Kolom Skor WSM ditampilkan default sebagai indikator prioritas --}}
                    <th class="py-3 px-4 bg-blue-900 border-l border-blue-800" title="Skor Weighted Scoring Model">
                        SKOR PRIORITAS
                    </th>
                    <th class="py-3 px-4">STATUS</th>
                    <th class="py-3 px-4">AKSI</th>
                </tr>
            </thead>
            <tbody id="tableBody" class="text-gray-800 divide-y divide-gray-100">
                @forelse ($suratMasuk as $index => $row)
                    <tr class="hover:bg-blue-50 transition duration-150 ease-in-out">
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4 text-left font-bold text-gray-700">{{ $row->nama_pemohon }}</td>
                        <td class="py-3 px-4 text-left text-xs">{{ $row->jenis_surat }}</td>
                        <td class="py-3 px-4">
                            {{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('d M Y') }}
                            <div class="text-[10px] text-gray-400">
                                {{ \Carbon\Carbon::parse($row->created_at)->diffForHumans() }}
                            </div>
                        </td>
                        
                        {{-- Tampilan Skor WSM --}}
                        <td class="py-3 px-4 bg-blue-50 font-bold text-blue-900 border-l border-gray-200 text-base">
                            {{ number_format($row->wsm_score, 2) }}
                        </td>

                        <td class="py-3 px-4">
                            @if ($row->status_verifikasi === null)
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold shadow-sm animate-pulse">Menunggu</span>
                            @elseif ($row->status_verifikasi === 'diterima')
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold shadow-sm">Disetujui</span>
                            @elseif ($row->status_verifikasi === 'ditolak')
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold shadow-sm">Ditolak</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 flex justify-center items-center space-x-1">
                            @if($row->status_verifikasi === null)
                            <button class="bg-green-500 text-white px-2 py-1 rounded text-xs hover:bg-green-600 shadow-sm transition transform hover:scale-105">Terima</button>
                            <button class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600 shadow-sm transition transform hover:scale-105">Tolak</button>
                            @endif
                            <button class="text-gray-600 hover:text-[#0A142F] p-1 transition">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-10 text-center text-gray-500">
                            <img src="{{ asset('assets/bingung.png') }}" class="w-16 h-16 mx-auto mb-2 opacity-50 grayscale">
                            <p>Data surat tidak ditemukan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- SCRIPT: Charts & Live Search --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // --- 1. Konfigurasi Grafik (Chart.js) ---
    function renderCharts() {
        const pieCtx = document.getElementById('statusPieChart');
        const lineCtx = document.getElementById('suratLineChart');
        
        // Data dari Controller (Blade variable to JS)
        const statusData = @json($statusData);
        const chartData = @json($chartData);

        if(pieCtx) {
            if (window.pieChart) window.pieChart.destroy();
            window.pieChart = new Chart(pieCtx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(statusData),
                    datasets: [{
                        data: Object.values(statusData),
                        backgroundColor: ['#FACC15', '#22C55E', '#EF4444'],
                        borderWidth: 0
                    }]
                },
                options: { responsive: true, cutout: '70%' }
            });
        }

        if(lineCtx) {
            if (window.lineChart) window.lineChart.destroy();
            window.lineChart = new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Surat Masuk',
                        data: chartData.values,
                        borderColor: '#0A142F',
                        backgroundColor: 'rgba(10, 20, 47, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: { responsive: true, scales: { y: { beginAtZero: true } } }
            });
        }
    }

    // --- 2. Live Search & Auto Filter Logic ---
    document.addEventListener('DOMContentLoaded', function() {
        renderCharts(); // Render grafik saat load pertama

        const searchInput = document.getElementById('searchInput');
        const jenisSuratInput = document.getElementById('jenisSuratInput');
        const tableBody = document.getElementById('tableBody');
        let debounceTimer;

        // Fungsi untuk melakukan Fetch data tanpa reload page
        function fetchTableData() {
            const searchQuery = searchInput.value;
            const jenisQuery = jenisSuratInput.value;
            
            // Buat URL dengan query params
            const url = `${window.location.pathname}?search=${encodeURIComponent(searchQuery)}&jenis_surat=${encodeURIComponent(jenisQuery)}`;

            // Tampilkan loading state sederhana (opsional)
            tableBody.style.opacity = '0.5';

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    // Parse HTML string menjadi DOM
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    // Ambil isi tbody baru dari response
                    const newTableBody = doc.getElementById('tableBody').innerHTML;
                    
                    // Update tbody di halaman sekarang
                    tableBody.innerHTML = newTableBody;
                    tableBody.style.opacity = '1';
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    tableBody.style.opacity = '1';
                });
        }

        // Event Listener untuk Search (Typing) dengan Debounce
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            // Tunggu 300ms setelah user selesai mengetik baru fetch
            debounceTimer = setTimeout(fetchTableData, 300);
        });

        // Event Listener untuk Dropdown (Langsung fetch saat berubah)
        jenisSuratInput.addEventListener('change', function() {
            fetchTableData();
        });
    });
</script>
@endsection