@extends('layouts.app')

@section('title', 'Pengaturan Prioritas')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-[#0A142F]">⚙️ Pengaturan Logika Prioritas (WSM)</h1>
        <a href="{{ route('pegawai.dashboard') }}" class="text-blue-600 hover:underline">← Kembali ke Dashboard</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-6 font-medium border border-green-200 shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pegawai.updateBobot') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- BAGIAN 1: BOBOT KRITERIA --}}
            <div class="bg-white rounded-xl shadow p-6 border border-gray-200 h-fit">
                <div class="mb-4 border-b pb-2">
                    <h3 class="font-bold text-[#0A142F] text-lg">1. Bobot Kriteria Utama</h3>
                    <p class="text-xs text-gray-500">Menentukan seberapa penting faktor waktu, jenis, dan status dalam penilaian.</p>
                </div>

                <div class="space-y-4">
                    @foreach($kriterias as $k)
                    <div class="flex items-center justify-between">
                        <div>
                            <label class="block font-semibold text-gray-800">{{ $k->nama_kriteria }}</label>
                            <span class="text-[10px] bg-gray-100 text-gray-500 px-2 py-0.5 rounded uppercase">{{ $k->jenis }}</span>
                        </div>
                        <div class="flex flex-col items-end">
                            <input type="number" step="0.01" min="0" max="1" 
                                   name="bobot[{{ $k->id }}]" 
                                   value="{{ $k->bobot }}" 
                                   class="w-20 text-center font-bold text-gray-700 border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                            <span class="text-[10px] text-gray-400 mt-1">Bobot (0.0 - 1.0)</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4 p-3 bg-yellow-50 text-yellow-800 text-xs rounded border border-yellow-100">
                    💡 Total bobot seluruh kriteria disarankan berjumlah <strong>1.0</strong>.
                </div>
            </div>

            {{-- BAGIAN 2: NILAI VARIABEL JENIS SURAT (YANG DIMINTA) --}}
            <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                <div class="mb-4 border-b pb-2">
                    <h3 class="font-bold text-[#0A142F] text-lg">2. Nilai Variabel (Jenis Surat)</h3>
                    <p class="text-xs text-gray-500">Tentukan nilai urgensi (0-100) untuk setiap jenis layanan surat.</p>
                </div>

                <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2">
                    @foreach($jenisSurat as $js)
                    <div class="flex items-center justify-between border-b border-gray-50 pb-2 last:border-0">
                        <label class="text-sm font-medium text-gray-700 w-2/3">{{ $js->jenis_surat }}</label>
                        <div class="w-1/3 flex justify-end items-center gap-2">
                            <input type="number" min="0" max="100" 
                                   name="nilai_surat[{{ $js->id }}]" 
                                   value="{{ $js->nilai }}" 
                                   class="w-16 text-center font-bold text-blue-700 border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                            <span class="text-xs text-gray-400">Poin</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- TOMBOL SIMPAN --}}
        <div class="mt-8 flex justify-end pt-6 border-t border-gray-200">
            <button type="submit" class="bg-[#0A142F] text-white px-8 py-3 rounded-lg hover:bg-blue-900 transition shadow-lg flex items-center gap-2 font-bold">
                <span class="material-symbols-outlined">save</span> Simpan Semua Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection