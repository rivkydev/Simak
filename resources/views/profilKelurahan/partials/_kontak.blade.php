<div class="text-[#0A142F] py-10 px-4 sm:px-8 lg:px-16 space-y-10">
    <h2 class="text-3xl md:text-4xl font-bold text-center md:text-left">Kontak & Media Sosial</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div class="bg-white p-6 rounded-2xl shadow-lg border space-y-6">
            {{-- Bagian Kontak --}}
            <div>
                <h3 class="text-xl font-semibold mb-3">Hubungi Kami</h3>
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
                        <a href="mailto:{{ $item->informasi_kontak }}" class="hover:underline">
                            {{ $item->informasi_kontak }}
                        </a>
                        @break
                        @case('telepon')
                        <a href="tel:{{ $item->informasi_kontak }}" class="hover:underline">
                            {{ $item->informasi_kontak }}
                        </a>
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
                <h3 class="text-lg font-semibold mb-3">Ikuti Media Sosial Kami</h3>
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
                    <a href="{{ $item->link_sosial_media }}" target="_blank"
                        class="flex items-center gap-2 hover:text-[{{ $color }}] transition-all">
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

        <div class="rounded-2xl overflow-hidden shadow-lg border h-[350px]">
            <iframe
                src="{{ $kelurahan->lokasi_maps }}"
                width="100%" height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>