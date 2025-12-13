<style>
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

<div class="space-y-6 text-[#0A142F]">
    <div>
        <h2 class="text-3xl font-bold">Lebih Mengenal Kelurahan {{ $kelurahan->nama }}</h2>
        <p class="text-gray-700 text-justify mt-2">
            {{ $profil->deskripsi ?? 'Deskripsi belum tersedia.' }}
        </p>
    </div>

    <div>
        <h3 class="text-3xl font-bold mb-1">Visi</h3>
        <p class="text-gray-700 italic">
            {{ $profil->visi ?? 'Visi belum tersedia.' }}
        </p>
    </div>

    <div>
        <h3 class="text-3xl font-bold mb-3 text-[#0A142F]">Misi</h3>

        @php
        $misiList = preg_split("/\r\n|\r|\n/", $profil->misi ?? '');
        @endphp

        @if($profil && count($misiList) > 0 && trim($misiList[0]) != '')
        <ul class="space-y-3 text-gray-700 list-none pl-0">
            @foreach($misiList as $item)
            <li class="flex items-start gap-2">
                <span class="material-symbols-outlined text-green-600 mt-1">task_alt</span>
                <span>{{ trim($item) }}</span>
            </li>
            @endforeach
        </ul>
        @else
        <p class="text-gray-700 italic">Misi belum tersedia.</p>
        @endif
    </div>

    {{-- Dokumentasi Kegiatan --}}
    <div class="flex items-center gap-x-2 mt-6">
        <h2 class="text-xl font-semibold">Dokumentasi Kegiatan</h2>
    </div>

    {{-- Navigasi dan Foto --}}
    <div class="flex items-center gap-4 mt-2">
        {{-- Tombol kiri --}}
        <button type="button" onclick="scrollFotos(-1)">
            <span class="material-symbols-outlined text-4xl hover:opacity-80" style="color: #0A142F;">
                arrow_circle_left
            </span>
        </button>

        {{-- Container foto --}}
        <div id="fotoContainer" class="flex gap-4 overflow-x-auto scroll-smooth scrollbar-hide">
            @forelse ($fotoKegiatan as $foto)
            <div class="flex-shrink-0 w-60">
                <img src="{{ asset('storage/' . $foto->foto) }}"
                    alt="{{ $foto->nama_kegiatan ?? 'Dokumentasi' }}"
                    class="w-full h-40 object-cover rounded shadow">
                <p class="mt-1 text-sm text-gray-600 text-center">
                    {{ $foto->nama_kegiatan ?? 'Tanpa nama' }}
                </p>
            </div>
            @empty
            <p class="text-gray-700">Belum ada dokumentasi kegiatan.</p>
            @endforelse
        </div>

        {{-- Tombol kanan --}}
        <button type="button" onclick="scrollFotos(1)">
            <span class="material-symbols-outlined text-4xl hover:opacity-80" style="color: #0A142F;">
                arrow_circle_right
            </span>
        </button>
    </div>
</div>
{{-- CSS untuk sembunyikan scrollbar --}}
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
<script>
    function scrollFotos(direction) {
        const container = document.getElementById('fotoContainer');
        container.scrollBy({
            left: direction * 200,
            behavior: 'smooth'
        });
    }
</script>