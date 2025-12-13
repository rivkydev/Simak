<div class="text-[#0A142F] py-6 px-4 sm:px-8 lg:px-16 space-y-6">
    <h2 class="text-xl md:text-2xl font-semibold text-center md:text-left">Kontak, Media Sosial & Peta</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div class="bg-white p-6 rounded-2xl shadow-lg border space-y-6">
            <div>
                <div class="flex items-center gap-x-2 mt-6">
                    <h3 class="text-xl font-semibold">Hubungi Kami</h3>
                    <button onclick="document.getElementById('modalKontak').classList.remove('hidden')" class="text-[#0A142F] hover:text-blue-900">
                        <span class="material-symbols-outlined text-base align-middle">edit_square</span>
                    </button>
                </div>
                @if($kontak->count())
                    <ul class="text-sm space-y-4">
                        @foreach($kontak as $item)
                            @php
                                $jenis = strtolower($item->jenis_kontak ?? '');
                                $icon = match($jenis) {
                                    'alamat' => 'fas fa-map-marker-alt text-red-500',
                                    'email' => 'fas fa-envelope text-yellow-500',
                                    'telepon' => 'fas fa-phone-alt text-green-500',
                                    'wa' => 'fab fa-whatsapp text-green-500',
                                    'jam kerja' => 'fas fa-clock text-blue-500',
                                    default => 'fas fa-info-circle text-gray-400',
                                };
                            @endphp
                            <li class="flex items-start gap-3">
                                <i class="{{ $icon }} mt-1"></i>
                                @switch($jenis)
                                    @case('email')
                                        <a href="mailto:{{ $item->informasi_kontak }}" class="hover:underline">{{ $item->informasi_kontak }}</a>
                                        @break
                                    @case('telepon')
                                        <a href="tel:{{ $item->informasi_kontak }}" class="hover:underline">{{ $item->informasi_kontak }}</a>
                                        @break
                                    @default
                                        <span>{{ $item->informasi_kontak }}</span>
                                @endswitch
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">Belum ada informasi kontak yang tersedia.</p>
                @endif
            </div>
            <div>
                <div class="flex items-center gap-x-2 mt-6">
                    <h3 class="text-lg font-semibold">Ikuti Media Sosial Kami</h3>
                    <button onclick="document.getElementById('modalSosial').classList.remove('hidden')" class="text-[#0A142F] hover:text-blue-900">
                        <span class="material-symbols-outlined text-base align-middle">edit_square</span>
                    </button>
                </div>
                @if($sosial->count())
                    <div class="flex flex-col space-y-3 text-sm">
                        @foreach($sosial as $item)
                            @php
                                $platform = strtolower($item->jenis_sosial_media ?? '');
                                $icons = [
                                    'instagram' => ['fab fa-instagram', '#E1306C'],
                                    'facebook' => ['fab fa-facebook', '#1877F2'],
                                    'twitter' => ['fab fa-twitter', '#1DA1F2'],
                                    'website' => ['fas fa-globe', '#16A34A'],
                                    'youtube' => ['fab fa-youtube', '#FF0000'],
                                    'tiktok' => ['fab fa-tiktok', '#000000'],
                                ];
                                [$iconClass, $color] = $icons[$platform] ?? ['fas fa-hashtag', '#9CA3AF'];
                            @endphp
                            <a href="{{ $item->link_sosial_media }}" target="_blank" class="flex items-center gap-2 hover:text-[{{ $color }}] transition-all">
                                <i class="{{ $iconClass }} text-[{{ $color }}]"></i>
                                {{ $item->jenis_sosial_media }}
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">Belum ada akun media sosial yang tersedia.</p>
                @endif
            </div>
        </div>
        <div class="rounded-2xl overflow-hidden shadow-lg border h-[350px] relative">
            <iframe src="{{ $kelurahan->lokasi_maps }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <button onclick="document.getElementById('modalMaps').classList.remove('hidden')" class="absolute top-2 right-2 bg-white p-2 rounded-full shadow hover:bg-gray-200">
                <span class="material-symbols-outlined text-base">edit_square</span>
            </button>
        </div>
    </div>
</div>

<div id="modalKontak" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg w-full max-w-lg p-6 relative">
        <button type="button"
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
            onclick="document.getElementById('modalKontak').classList.add('hidden')">
            ✕
        </button>
        <form method="POST" action="{{ route('admin.profil.storeKontak', $kelurahan->id_kelurahan) }}">
            @csrf
            @php $jenisKontakList = ['Alamat', 'Email', 'Telepon', 'wa', 'jam kerja']; @endphp
            @foreach($jenisKontakList as $jenis)
                @php $data = $kontak->firstWhere('jenis_kontak', $jenis); @endphp
                <div class="mb-4">
                    <label class="block font-medium capitalize mb-1">{{ $jenis }}</label>
                    <input type="text" name="kontak[{{ $jenis }}]" value="{{ $data->informasi_kontak ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                </div>
            @endforeach
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" 
                    onclick="document.getElementById('modalKontak').classList.add('hidden')"
                    class="px-4 py-2 text-sm border rounded text-gray-600 hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-[#0A142F] rounded hover:bg-[#061024]">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalSosial" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg w-full max-w-lg p-6 relative">
        <button type="button"
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
            onclick="document.getElementById('modalSosial').classList.add('hidden')">
            ✕
        </button>
        <form method="POST" action="{{ route('admin.profil.storeSosial', $kelurahan->id_kelurahan) }}">
            @csrf
            @php $jenisSosialList = ['Instagram', 'Facebook', 'Twitter', 'Website', 'Youtube', 'Tiktok']; @endphp
            @foreach($jenisSosialList as $jenis)
                @php $data = $sosial->firstWhere('jenis_sosial_media', $jenis); @endphp
                <div class="mb-4">
                    <label class="block font-medium capitalize mb-1">{{ $jenis }} (URL)</label>
                    <input type="url" name="sosial[{{ $jenis }}]" value="{{ $data->link_sosial_media ?? '' }}" placeholder="https://..." class="w-full border border-gray-300 rounded-lg px-3 py-2">
                </div>
            @endforeach
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" 
                    onclick="document.getElementById('modalSosial').classList.add('hidden')"
                    class="px-4 py-2 text-sm border rounded text-gray-600 hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-[#0A142F] rounded hover:bg-[#061024]">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalMaps" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg w-full max-w-lg p-6 relative">
        <button type="button"
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
            onclick="document.getElementById('modalMaps').classList.add('hidden')">
            ✕
        </button>

        <h2 class="text-xl font-semibold mb-4">Edit Lokasi Maps</h2>
        <form method="POST" action="{{ route('admin.profil.updateMaps', $kelurahan->id_kelurahan) }}">
            @csrf
            <textarea name="lokasi_maps" class="w-full border rounded-lg p-2 text-sm">{{ $kelurahan->lokasi_maps }}</textarea>
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" 
                    onclick="document.getElementById('modalMaps').classList.add('hidden')"
                    class="px-4 py-2 text-sm border rounded text-gray-600 hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-[#0A142F] rounded hover:bg-[#061024]">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>