@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" id="admin-dashboard">

    <h1 class="text-3xl font-extrabold text-[#0A142F] drop-shadow-sm">
        <div class="font-bold">Hi! Admin</div>
    </h1>

    @php
        // Menggunakan optional() untuk menghindari error jika relasi kosong
        $namaKelurahan = optional($pegawai->kelurahan)->nama ?? '-';
    @endphp

    <p class="text-lg text-gray-600 mb-8">Kelurahan
        <span class="font-semibold text-[#0A142F]"> {{ $namaKelurahan }}</span>
    </p>

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

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-4 rounded-xl shadow-md min-h-[200px]">
            <h2 class="font-semibold text-lg mb-2">Jumlah permohonan per status</h2>
            <canvas id="statusPieChart" height="200"></canvas>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-md min-h-[200px]">
            <h2 class="font-semibold text-lg mb-2">Grafik Perkembangan Surat Masuk</h2>
            <canvas id="suratLineChart" height="200"></canvas>
        </div>
    </div>

    <div class="overflow-x-auto rounded-xl shadow">
        <table class="min-w-full text-sm text-center">
            <thead class="bg-[#0A142F] text-white">
                <tr>
                    <th class="py-3 px-4 rounded-tl-xl">NO</th>
                    <th class="py-3 px-4">NAMA PEMOHON</th>
                    <th class="py-3 px-4">TANGGAL DIKIRIM</th>
                    <th class="py-3 px-4">STATUS</th>
                    <th class="py-3 px-4 rounded-tr-xl">AKSI</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @forelse ($suratMasuk as $index => $row)
                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        
                        <td class="py-3 px-4">{{ $row->nama_pemohon }}</td>
                        
                        <td class="py-3 px-4">{{ $row->created_at->format('d M Y') }}</td>
                        
                        <td class="py-3 px-4 font-medium">
                            @if ($row->status_verifikasi === 'menunggu' || $row->status_verifikasi === null)
                                <span class="text-yellow-500 font-bold">Menunggu</span>
                            @elseif ($row->status_verifikasi === 'diterima')
                                <span class="text-green-600 font-bold">Disetujui</span>
                            @elseif ($row->status_verifikasi === 'ditolak')
                                <span class="text-red-600 font-bold">Ditolak</span>
                            @endif
                        </td>
                        
                        <td class="py-3 px-4 space-x-2 flex justify-center items-center">
                            <button class="text-[#0A142F] hover:text-blue-900">
                                <span class="material-symbols-outlined">folder_eye</span>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">
                            Belum ada data surat masuk.
                        </td>
                    </tr>
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

        // Data dikirim dari Controller sebagai JSON
        const statusData = @json($statusData);
        const chartData = @json($chartData);

        const pieChartData = {
            labels: Object.keys(statusData),
            datasets: [{
                data: Object.values(statusData),
                backgroundColor: ['#FACC15', '#22C55E', '#EF4444'], // Kuning, Hijau, Merah
                borderWidth: 1
            }]
        };

        const lineChartData = {
            labels: chartData.labels,
            datasets: [{
                label: 'Surat Masuk',
                data: chartData.values,
                fill: false,
                borderColor: '#0A142F',
                tension: 0.4
            }]
        };

        if (window.pieChart) window.pieChart.destroy();
        if (window.lineChart) window.lineChart.destroy();

        window.pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: pieChartData,
        });

        window.lineChart = new Chart(lineCtx, {
            type: 'line',
            data: lineChartData,
        });
    }

    document.addEventListener('DOMContentLoaded', renderCharts);
    // Tambahan jika menggunakan library HTMX / Livewire agar chart reload
    document.body.addEventListener('htmx:afterSettle', renderCharts);
</script>
@endsection