@extends('layouts.app')

@section('title', 'Surat Keterangan Penghasilan Orang Tua')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10 text-[#0A142F]">
    <a href="{{ route('admin.pelayanan') }}" class="flex items-center font-semibold hover:text-blue-600 mb-6">
        <span class="material-symbols-outlined mr-1">arrow_back</span> Kembali
    </a>

    <h1 class="text-2xl sm:text-3xl font-bold text-[#0A142F] mb-8">Surat Keterangan Penghasilan Orang Tua</h1>

    <form action="#" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        {{-- Nomor Surat --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <label class="font-semibold self-center">Nomor Surat</label>
            <input type="text" name="nomor_surat" placeholder="Masukkan Nomor Urut Surat"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        {{-- Yang Bertanda Tangan --}}
        <h2 class="text-lg font-semibold mb-4 mt-8">Yang Bertanda Tangan:</h2>
        <div class="space-y-4 mb-6">
            @foreach ([
                ['label' => 'Nama', 'name' => 'nama_yt'],
                ['label' => 'NIP', 'name' => 'nip'],
                ['label' => 'Jabatan', 'name' => 'jabatan'],
            ] as $field)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="font-semibold self-center">{{ $field['label'] }}</label>
                    <input type="text" name="{{ $field['name'] }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan {{ $field['label'] }}" />
                </div>
            @endforeach
        </div>

        {{-- Menerangkan Bahwa --}}
        <h2 class="text-lg font-semibold mb-4 mt-8">Menerangkan Bahwa:</h2>
        <div class="space-y-4 mb-6">
            @foreach ([
                ['label' => 'Nama', 'name' => 'nama'],
                ['label' => 'NIK', 'name' => 'nik'],
                ['label' => 'Tempat/Tgl Lahir', 'name' => 'ttl'],
                ['label' => 'Pekerjaan', 'name' => 'pekerjaan'],
                ['label' => 'Alamat', 'name' => 'alamat'],
            ] as $field)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="font-semibold self-center">{{ $field['label'] }}</label>
                    <input type="text" name="{{ $field['name'] }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan {{ $field['label'] }}" />
                </div>
            @endforeach

            {{-- Agama --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <label class="font-semibold self-center">Agama</label>
                <select name="agama" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Agama</option>
                    @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                        <option>{{ $agama }}</option>
                    @endforeach
                </select>
            </div>

            {{-- RT/RW --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <label class="font-semibold self-center">RT/RW</label>
                <div class="flex gap-4">
                    <input type="text" name="rt" placeholder="RT"
                        class="w-20 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <input type="text" name="rw" placeholder="RW"
                        class="w-20 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
            </div>

            {{-- Besar Penghasilan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <label class="font-semibold self-center">Besar Penghasilan</label>
                <input type="text" name="penghasilan" placeholder="Masukkan Besar Nilai Penghasilan/Bulan"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
        </div>

        {{-- Mempunyai Tanggungan --}}
        <h2 class="text-lg font-semibold mb-4 mt-8">Mempunyai Tanggungan:</h2>
        <div class="space-y-4 mb-6">
            @foreach ([
                ['label' => 'Nama', 'name' => 'nama_tanggungan'],
                ['label' => 'NIK', 'name' => 'nik_tanggungan'],
                ['label' => 'Tempat/Tgl Lahir', 'name' => 'ttl_tanggungan'],
                ['label' => 'Alamat', 'name' => 'alamat_tanggungan'],
                ['label' => 'Keterangan', 'name' => 'keterangan_tanggungan'],
            ] as $field)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="font-semibold self-center">{{ $field['label'] }}</label>
                    <input type="text" name="{{ $field['name'] }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan {{ $field['label'] }}" />
                </div>
            @endforeach
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end mt-8">
            <button type="submit"
                class="bg-[#0A142F] text-white px-6 py-2 rounded-lg hover:bg-[#1f2a48] transition text-sm">
                Buat Surat
            </button>
        </div>
    </form>
</div>
@endsection
