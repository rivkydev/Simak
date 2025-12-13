@php
    $iconMap = [
        'Pertanian, Perkebunan, dan Peternakan' => ['icon' => 'fa-tractor', 'color' => 'green'],
        'Perikanan dan Kelautan'               => ['icon' => 'fa-fish', 'color' => 'blue'],
        'UMKM dan Industri Rumah Tangga'       => ['icon' => 'fa-store', 'color' => 'pink'],
        'Ekowisata dan Wisata Budaya'          => ['icon' => 'fa-umbrella-beach', 'color' => 'yellow'],
        'Energi Terbarukan dan Lingkungan'     => ['icon' => 'fa-solar-panel', 'color' => 'teal'],
        'Pendidikan dan Literasi Masyarakat'   => ['icon' => 'fa-book-open', 'color' => 'red'],
        'Kesehatan dan Layanan Sosial'         => ['icon' => 'fa-heartbeat', 'color' => 'rose'],
        'Infrastruktur dan Aksesibilitas'      => ['icon' => 'fa-road', 'color' => 'indigo'],
        'Digitalisasi dan Teknologi Informasi' => ['icon' => 'fa-microchip', 'color' => 'cyan'],
        'Partisipasi dan Kelembagaan Komunitas'=> ['icon' => 'fa-users', 'color' => 'purple'],
    ];
@endphp

<div class="p-6 space-y-6">
    <div class="flex items-center gap-x-2">
        <h2 class="text-[#0A142F] text-xl font-semibold text-[#0A142F]">Deskripsi Umum</h2>
        <button
            type="button"
            onclick="document.getElementById('modalDeskripsiUmum').classList.remove('hidden')"
            class="text-[#0A142F] hover:text-blue-900"
        >
            <span class="material-symbols-outlined text-base align-middle">edit_square</span>
        </button>
    </div>

    <p class="text-gray-700 leading-relaxed">
        {{ $profil->deskripsi_potensi ?? 'Belum ada deskripsi umum.' }}
    </p>
</div>

<div id="modalDeskripsiUmum" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center hidden">
    <div class="bg-white w-full max-w-xl p-6 rounded-xl shadow-lg relative">
        <h3 class="text-lg font-semibold mb-4 text-[#0A142F]">Edit Deskripsi Umum</h3>

        <form action="{{ route('admin.potensi.updateDeskripsi', $profil->id_kelurahan) }}" method="POST">
            @csrf
            <textarea
                name="deskripsi_umum"
                rows="5"
                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0A142F] resize-none"
            >{{ old('deskripsi_umum', $potensiUmum->deskripsi_umum ?? '') }}</textarea>

            <div class="flex justify-end mt-4 gap-2">
                <button
                    type="button"
                    onclick="document.getElementById('modalDeskripsiUmum').classList.add('hidden')"
                    class="px-4 py-2 text-sm border rounded text-gray-600 hover:bg-gray-100"
                >
                    Batal
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 text-sm text-white bg-[#0A142F] rounded hover:bg-[#061024]"
                >
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<div class="p-6 mb-8">
    <h3 class="text-lg font-semibold mb-4 text-[#0A142F]">Tambah Jenis Potensi</h3>

    <form action="{{ route('admin.potensi.tambahJenis', $kelurahan->id_kelurahan) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium">Jenis Potensi</label>
            <select name="jenis_potensi" class="w-full border rounded-lg p-3" required>
                <option value="">-- Pilih Jenis Potensi --</option>
                @foreach($iconMap as $jenis => $data)
                    <option value="{{ $jenis }}">{{ $jenis }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Deskripsi</label>
            <textarea
                name="deskripsi_jenis_potensi"
                rows="3"
                class="w-full border rounded-lg p-3"
                required
            ></textarea>
        </div>

        <button
            type="submit"
            class="bg-[#0A142F] text-white px-5 py-2 rounded-lg hover:bg-blue-950"
        >
            Tambah Potensi
        </button>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($potensi as $item)
        @php
            $icon  = $iconMap[$item->jenis_potensi]['icon']  ?? 'fa-leaf';
            $color = $iconMap[$item->jenis_potensi]['color'] ?? 'gray';
        @endphp

        <div class="bg-white rounded-2xl shadow-md p-6 border-t-4 border-{{ $color }}-500">

            <div class="flex items-center mb-3">
                <i class="fas {{ $icon }} text-{{ $color }}-500 text-2xl mr-3"></i>
                <h4 class="text-lg font-semibold">{{ $item->jenis_potensi }}</h4>
            </div>

            <p class="text-sm text-gray-700 mb-4">{{ $item->deskripsi_jenis_potensi }}</p>

            <form action="{{ route('admin.potensi.updateJenis', $item->id_potensi) }}" method="POST" class="mb-2">
                @csrf
                <select name="jenis_potensi" class="w-full border rounded-lg p-2 mb-2" required>
                    @foreach($iconMap as $jenis => $data)
                        <option value="{{ $jenis }}" {{ $jenis == $item->jenis_potensi ? 'selected' : '' }}>
                            {{ $jenis }}
                        </option>
                    @endforeach
                </select>

                <textarea
                    name="deskripsi_jenis_potensi"
                    rows="2"
                    class="w-full border rounded-lg p-2 mb-2"
                >{{ $item->deskripsi_jenis_potensi }}</textarea>

                <button
                    type="submit"
                    class="bg-yellow-500 text-white px-4 py-1 rounded-lg hover:bg-yellow-600 w-full"
                >
                    Update
                </button>
            </form>

            <form action="{{ route('admin.potensi.hapusJenis', $item->id_potensi) }}" method="POST">
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    onclick="return confirm('Yakin ingin menghapus potensi ini?')"
                    class="bg-red-600 text-white px-4 py-1 rounded-lg hover:bg-red-700 w-full"
                >
                    Hapus
                </button>
            </form>
        </div>
    @empty
        <p class="text-gray-500 italic col-span-full">Belum ada potensi yang terdaftar.</p>
    @endforelse
</div>
