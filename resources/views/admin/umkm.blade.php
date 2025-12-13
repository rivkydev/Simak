@extends('layouts.app')
@section('title', 'Kelola UMKM')
@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-6 bg-white text-[#0A142F] rounded-t-lg shadow">
    <h1 class="text-2xl font-bold">Data UMKM</h1>
    <a href="{{ route('umkm.create') }}"
        class="flex items-center justify-center gap-2 bg-[#0A142F] text-white px-4 py-2 rounded-lg hover:bg-[#1a2240] w-full sm:w-auto">
        <span class="material-symbols-outlined text-white">add_business</span>
        <span class="font-semibold">Tambah UMKM</span>
    </a>
</div>

{{-- List UMKM --}}
<div class="rounded-b-lg shadow divide-y divide-gray-200">
    @if(session('success'))
    <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-100" role="alert">
        <span class="material-symbols-outlined mr-2">done_outline</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif
    @forelse($umkm as $item)
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-6 py-3 bg-white text-[#0A142F] gap-3">

        {{-- Info UMKM --}}
        <div class="flex items-center gap-2 min-w-0">
            <span class="material-symbols-outlined text-[#0A142F]">storefront</span>
            <span class="font-semibold truncate">{{ $item->nama }}</span>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex items-center gap-3">
            {{-- Tombol Edit --}}
            <a href="{{ route('umkm.edit', $item->id_umkm) }}" class="hover:text-gray-600">
                <span class="material-symbols-outlined">edit_square</span>
            </a>
            <div x-data="{ open: false }">
                <!-- Tombol Hapus -->
                <button type="button" @click="open = true" class="hover:text-gray-600">
                    <span class="material-symbols-outlined">delete_forever</span>
                </button>

                <!-- Modal Konfirmasi -->
                <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                    x-transition>
                    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
                        <div class="flex items-center gap-2 text-red-600 text-lg font-semibold">
                            <span class="material-symbols-outlined">warning</span>
                            Konfirmasi Hapus
                        </div>
                        <p class="mt-3 text-gray-700">
                            Apakah Anda yakin ingin menghapus <strong>{{ $item->nama }}</strong>?
                        </p>
                        <div class="mt-5 flex justify-end gap-3">
                            <button @click="open = false"
                                class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">
                                Batal
                            </button>
                            <form action="{{ route('umkm.destroy', $item->id_umkm) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="px-6 py-4 text-gray-500 bg-white text-center">
        Belum ada data UMKM.
    </div>
    @endforelse
</div>

@endsection