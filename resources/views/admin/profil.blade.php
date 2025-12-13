@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">{{ $kelurahan->nama }}</h2>
    <hr class="border-t-4 border-[#0A142F] shadow-md mb-2 rounded-sm">

    <div class="flex flex-wrap gap-2 mb-2 overflow-x-auto">
        @foreach ([
            'profil' => 'Profil Kelurahan',
            'sejarah' => 'Sejarah Kelurahan',
            'potensi' => 'Potensi Kelurahan',
            'struktur' => 'Struktur Pemerintahan',
            'kontak' => 'Informasi Kontak'
        ] as $key => $label)
            <button onclick="showTab('{{ $key }}')" id="tab-{{ $key }}"
                class="tab-btn px-4 py-2 rounded-xl font-semibold whitespace-nowrap border transition-all duration-300
                    {{ $key === 'profil' ? 'border-[#0A142F] text-[#0A142F]' : 'border-gray-300 text-gray-700' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    <div id="content-profil" class="tab-content">@include('admin.profilKelurahan._profil')</div>
    <div id="content-sejarah" class="tab-content hidden">@include('admin.profilKelurahan._sejarah')</div>
    <div id="content-potensi" class="tab-content hidden">@include('admin.profilKelurahan._potensi')</div>
    <div id="content-struktur" class="tab-content hidden">@include('admin.profilKelurahan._struktur')</div>
    <div id="content-kontak" class="tab-content hidden">@include('admin.profilKelurahan._kontak')</div>

</div>
<script>
    function showTab(tabKey) {
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('border-[#0A142F]', 'text-[#0A142F]');
            btn.classList.add('border-gray-300', 'text-gray-700');
        });

        const activeBtn = document.getElementById(`tab-${tabKey}`);
        activeBtn.classList.remove('border-gray-300', 'text-gray-700');
        activeBtn.classList.add('border-[#0A142F]', 'text-[#0A142F]');

        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        const targetContent = document.getElementById(`content-${tabKey}`);
        if (targetContent) {
            targetContent.classList.remove('hidden');
        }
    }
</script>


@endsection
