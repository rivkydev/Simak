@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" id="lurah-dashboard">

    {{-- HEADER (TIDAK BERUBAH) --}}
    <h1 class="text-3xl font-extrabold text-[#0A142F] drop-shadow-sm">
        <div class="font-bold">Hi! {{ $pegawai->nama }}</div>
    </h1>

    @php
        $jabatan = $pegawai->id_jabatan ?? null;
        $namaKelurahan = $pegawai->kelurahan->nama ?? '-';
    @endphp

    <p class="text-lg text-gray-600 mb-8">
        Selamat datang di Dashboard <span class="font-semibold text-[#0A142F]">{{ $namaKelurahan }}</span>
    </p>

    {{-- NOTIFIKASI SUKSES (Tambahan) --}}
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">Berhasil!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    {{-- KARTU STATISTIK (TIDAK BERUBAH) --}}
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

    {{-- GRAFIK (TIDAK BERUBAH - DATA DIHANDLE CONTROLLER) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-4 rounded-xl shadow-md min-h-[200px]">
            <h2 class="font-semibold text-lg mb-2">Status Permohonan Surat</h2>
            <canvas id="statusPieChart" height="200"></canvas>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-md min-h-[200px]">
            <h2 class="font-semibold text-lg mb-2">Tren Surat Masuk (Tahun {{ date('Y') }})</h2>
            <canvas id="suratLineChart" height="200"></canvas>
        </div>
    </div>

    {{-- FILTER & CONTROL --}}
    <div class="bg-white p-5 rounded-xl shadow mb-6 border-l-4 border-[#0A142F]">
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
            <h3 class="text-md font-bold text-gray-800 flex items-center gap-2">
                Daftar Surat Masuk
                @if(isset($gunakanWSM) && $gunakanWSM)
                    <span class="text-[10px] bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full border border-yellow-200">
                        Mode Prioritas Aktif
                    </span>
                @endif
            </h3>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('pegawai.pengaturanBobot') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 flex items-center gap-1 transition">
                    <span class="material-symbols-outlined text-sm">settings</span> Atur Bobot
                </a>

                {{-- CEKLIS WSM AJAX --}}
                <label class="inline-flex items-center cursor-pointer select-none bg-blue-50 px-3 py-2 rounded-lg border border-blue-200 hover:bg-blue-100 transition">
                    <input type="checkbox" 
                           id="wsmCheckbox" 
                           name="filter_wsm" 
                           value="1" 
                           class="form-checkbox h-4 w-4 text-blue-600 rounded focus:ring-blue-500"
                           {{ isset($gunakanWSM) && $gunakanWSM ? 'checked' : '' }}>
                    <span class="ml-2 text-sm font-bold text-blue-800">Aktifkan Prioritas (WSM)</span>
                </label>
            </div>
        </div>
        
        <form id="filterForm" onsubmit="return false;" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Search --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase">Cari Pemohon</label>
                <div class="relative">
                    <input type="text" id="searchInput" value="{{ $currentSearch ?? '' }}" 
                        placeholder="Ketik nama pemohon..." 
                        class="w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm px-3 py-2 pl-10">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-gray-400 text-lg">search</span>
                    </div>
                </div>
            </div>

            {{-- Filter Jenis --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase">Filter Jenis Surat</label>
                <select id="jenisSuratInput" class="w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm px-3 py-2 cursor-pointer">
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
    {{-- TABEL DATA --}}
    <div id="tableContainer" class="overflow-x-auto rounded-xl shadow border border-gray-200 bg-white min-h-[300px]">
        <table class="min-w-full text-sm text-center">
            <thead class="bg-[#0A142F] text-white">
                <tr>
                    <th class="py-3 px-4 w-12">NO</th>
                    <th class="py-3 px-4 text-left">NAMA PEMOHON</th>
                    <th class="py-3 px-4 text-left">JENIS SURAT</th>
                    <th class="py-3 px-4">TANGGAL MASUK</th>
                    <th class="py-3 px-4">STATUS</th>
                    <th class="py-3 px-4">AKSI</th>
                </tr>
            </thead>
            <tbody id="tableBody" class="text-gray-800 divide-y divide-gray-100">
    @forelse ($suratMasuk as $index => $row)
        @php
            $isSelesai = in_array($row->status_verifikasi, ['diterima', 'ditolak']);
            $isPriority = (isset($gunakanWSM) && $gunakanWSM && $loop->first && !$isSelesai);
        @endphp
        
        <tr class="hover:bg-blue-50 transition duration-150 ease-in-out 
            {{ $isPriority ? 'bg-yellow-50' : '' }} 
            {{ $isSelesai ? 'bg-gray-50/50 opacity-75' : '' }}">
            
            <td class="py-3 px-4 {{ $isSelesai ? 'text-gray-400' : '' }}">{{ $loop->iteration }}</td>
           
            <td class="py-3 px-4 text-left font-bold {{ $isSelesai ? 'text-gray-500' : 'text-gray-700' }}">
                {{ $row->nama_pemohon }}
                @if($isPriority)
                    <span class="ml-2 text-[10px] bg-red-600 text-white px-2 py-0.5 rounded-full shadow-sm blink-animation">PRIORITAS #1</span>
                @endif
            </td>
            
            <td class="py-3 px-4 text-left text-xs {{ $isSelesai ? 'text-gray-400' : '' }}">{{ $row->jenis_surat }}</td>
           
            <td class="py-3 px-4 {{ $isSelesai ? 'text-gray-400' : '' }}">
                {{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('d M Y') }}
                <div class="text-[10px] text-gray-400">
                    {{ \Carbon\Carbon::parse($row->created_at)->diffForHumans() }}
                </div>
            </td>

            <td class="py-3 px-4">
                @if ($row->status_verifikasi === null || $row->status_verifikasi === 'menunggu')
                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold shadow-sm animate-pulse">Menunggu</span>
                @elseif ($row->status_verifikasi === 'diterima')
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold shadow-sm">Disetujui</span>
                @elseif ($row->status_verifikasi === 'ditolak')
                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold shadow-sm">Ditolak</span>
                @endif
            </td>

            <td class="py-3 px-4 flex justify-center items-center space-x-2">
                {{-- Tombol PDF Selalu Aktif jika file ada --}}
                @if($row->file_surat)
                    <a href="{{ asset('storage/' . $row->file_surat) }}" target="_blank" class="bg-blue-500 text-white px-3 py-1.5 rounded text-xs hover:bg-blue-600 shadow-sm transition font-bold">
                        PDF
                    </a>
                @endif

                @if(!$isSelesai)
                    {{-- Form Terima --}}
                    <form action="{{ route('pegawai.verifikasiSurat', $row->id_surat) }}" method="POST" onsubmit="return confirm('Terima surat ini?');">
                        @csrf
                        <input type="hidden" name="status" value="diterima">
                        <button type="submit" class="bg-green-500 text-white px-3 py-1.5 rounded text-xs hover:bg-green-600 shadow-sm font-bold">Terima</button>
                    </form>
                    {{-- Form Tolak --}}
                    <form action="{{ route('pegawai.verifikasiSurat', $row->id_surat) }}" method="POST" onsubmit="return confirm('Tolak surat ini?');">
                        @csrf
                        <input type="hidden" name="status" value="ditolak">
                        <button type="submit" class="bg-red-500 text-white px-3 py-1.5 rounded text-xs hover:bg-red-600 shadow-sm font-bold">Tolak</button>
                    </form>
                @else
                    <span class="text-gray-400 text-xs italic bg-gray-100 px-2 py-1 rounded border border-gray-200">Sudah Diproses</span>
                @endif
            </td>
        </tr>
    @empty
        {{-- Row Empty Tetap Sama --}}
    @endforelse
</tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function renderCharts() {
        const pieCtx = document.getElementById('statusPieChart');
        const lineCtx = document.getElementById('suratLineChart');
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
                        label: 'Jumlah Surat Masuk',
                        data: chartData.values,
                        borderColor: '#0A142F',
                        backgroundColor: 'rgba(10, 20, 47, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: { responsive: true, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        renderCharts();

        const searchInput = document.getElementById('searchInput');
        const jenisSuratInput = document.getElementById('jenisSuratInput');
        const wsmCheckbox = document.getElementById('wsmCheckbox');
        const tableBody = document.getElementById('tableBody');
        const headerTitle = document.querySelector('h3.text-md');
        let debounceTimer;

        function fetchTableData() {
            const searchQuery = searchInput.value;
            const jenisQuery = jenisSuratInput.value;
            const isWsmActive = wsmCheckbox.checked ? '1' : '';

            const params = new URLSearchParams();
            if(searchQuery) params.append('search', searchQuery);
            if(jenisQuery) params.append('jenis_surat', jenisQuery);
            if(isWsmActive) params.append('filter_wsm', '1');

            const url = `${window.location.pathname}?${params.toString()}`;
            window.history.pushState({}, '', url);

            tableBody.style.opacity = '0.5';

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newTableBody = doc.getElementById('tableBody').innerHTML;
                    tableBody.innerHTML = newTableBody;

                    const newHeader = doc.querySelector('h3.text-md').innerHTML;
                    if(headerTitle) headerTitle.innerHTML = newHeader;

                    tableBody.style.opacity = '1';
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    tableBody.style.opacity = '1';
                });
        }

        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(fetchTableData, 300);
        });

        jenisSuratInput.addEventListener('change', fetchTableData);
        wsmCheckbox.addEventListener('change', fetchTableData);
    });
</script>
@endsection