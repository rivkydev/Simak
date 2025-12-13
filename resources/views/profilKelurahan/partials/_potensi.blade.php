@php
$iconMap = [
'Pertanian, Perkebunan, dan Peternakan' => ['icon' => 'fa-tractor', 'color' => 'green'],
'Perikanan dan Kelautan' => ['icon' => 'fa-fish', 'color' => 'blue'],
'UMKM dan Industri Rumah Tangga' => ['icon' => 'fa-store', 'color' => 'pink'],
'Ekowisata dan Wisata Budaya' => ['icon' => 'fa-umbrella-beach', 'color' => 'yellow'],
'Energi Terbarukan dan Lingkungan' => ['icon' => 'fa-solar-panel', 'color' => 'teal'],
'Pendidikan dan Literasi Masyarakat' => ['icon' => 'fa-book-open', 'color' => 'red'],
'Kesehatan dan Layanan Sosial' => ['icon' => 'fa-heartbeat', 'color' => 'rose'],
'Infrastruktur dan Aksesibilitas' => ['icon' => 'fa-road', 'color' => 'indigo'],
'Digitalisasi dan Teknologi Informasi' => ['icon' => 'fa-microchip', 'color' => 'cyan'],
'Partisipasi dan Kelembagaan Komunitas' => ['icon' => 'fa-users', 'color' => 'purple'],
];
@endphp

<div class="px-4 md:px-8 py-10 max-w-7xl mx-auto text-[#0A142F]">
    <div class="space-y-4 md:space-y-6 mb-8">
        <h2 class="text-2xl md:text-3xl font-bold">Potensi Kelurahan {{ $kelurahan->nama }}</h2>
        <p class="text-sm md:text-base text-gray-600 leading-relaxed">
            {{ $profil->deskripsi_potensi ?? 'Belum ada deskripsi umum.' }}
        </p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($potensi as $item)
        @php
        $jenis = $item->jenis_potensi;
        $iconData = $iconMap[$jenis] ?? ['icon' => 'fa-leaf', 'color' => 'gray'];
        $iconClass = "fa " . $iconData['icon'];
        $bgColor = "bg-{$iconData['color']}-100";
        $textColor = "text-{$iconData['color']}-600";
        @endphp

        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition duration-300 ease-in-out">
            <div class="flex items-center gap-3 mb-4">
                <div class="{{ $bgColor }} {{ $textColor }} p-3 rounded-full">
                    <i class="{{ $iconClass }} text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold">{{ $jenis }}</h3>
            </div>
            <p class="text-sm text-justify text-gray-700 leading-relaxed">
                {{ $item->deskripsi_jenis_potensi }}
            </p>
        </div>
        @empty
        <p class="text-gray-500 italic">Data potensi belum tersedia.</p>
        @endforelse
    </div>
</div>
