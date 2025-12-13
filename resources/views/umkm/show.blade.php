@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <a href="{{ route('umkm.kelurahan') }}" class="inline-flex items-center px-3 py-1 rounded-md border border-gray-300 text-sm hover:bg-gray-100 mb-4">
        ← Kembali
    </a>

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">

        <div class="h-64 md:h-auto flex items-center justify-center bg-gray-100">
            @if (!empty($umkm['gambar']) && file_exists(public_path('storage/' . $umkm['gambar'])))
            <img src="{{ asset('storage/' . $umkm['gambar']) }}" alt="{{ $umkm['nama'] }}"
                class="w-full h-full object-cover md:rounded-l-3xl">
            @else
            <div class="flex flex-col items-center justify-center text-[#0A142F]">
                <span class="material-symbols-outlined text-6xl mb-2">broken_image</span>
                <p class="text-sm font-semibold">Gambar Tidak Tersedia</p>
            </div>
            @endif
        </div>

        <div class="p-8 flex flex-col justify-between">
            <div class="space-y-5">
                <div class="flex justify-end">
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $umkm->kelurahan->nama ?? 'Kelurahan tidak ditemukan' }}
                    </span>
                </div>

                <h1 class="text-3xl font-extrabold text-[#0A142F] leading-tight">
                    {{ $umkm->nama }}
                </h1>

                <div>
                    <h2 class="text-lg font-semibold text-[#0A142F] mb-1">Deskripsi</h2>
                    <p class="text-[#0A142F] leading-relaxed text-sm">{{ $umkm->deskripsi }}</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm text-[#0A142F]">
                    <div class="flex items-start space-x-2">
                        <span class="material-symbols-outlined text-[#0A142F]">calendar_month</span>
                        <div>
                            <p>Tahun Berdiri</p>
                            <p class="font-semibold">{{ $umkm->tahun_berdiri ?? 'Belum Tersedia' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-2">
                        <span class="material-symbols-outlined text-[#0A142F]">storefront</span>
                        <div>
                            <p>Jenis Usaha</p>
                            <p class="font-semibold">{{ $umkm->jenis_usaha ?? 'Belum Tersedia' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-2">
                        <span class="material-symbols-outlined text-[#0A142F]">badge</span>
                        <div>
                            <p>NIB</p>
                            <p class="font-semibold">{{ $umkm->nib ?? 'Belum Tersedia' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-2">
                        <span class="material-symbols-outlined text-[#0A142F]">call</span>
                        <div>
                            <p>Telepon</p>
                            <p class="font-semibold">{{ $umkm->telp ?? 'Belum Tersedia' }}</p>
                        </div>
                    </div>

                    @if (!empty($umkm->instagram))
                    <div class="flex items-center space-x-2">
                        <span class="fab fa-instagram text-2xl text-[#0A142F]"></span>
                        <div>
                            <a href="https://instagram.com/{{ ltrim($umkm->instagram, '@') }}"
                                target="_blank"
                                class="text-[#0A142F] font-semibold hover:underline">
                                Instagram
                            </a>
                        </div>
                    </div>
                    @endif

                    @if (!empty($umkm->grab))
                    <div class="flex items-center space-x-2">
                        <span class="material-symbols-outlined text-[#0A142F]">delivery_dining</span>
                        <div>
                            <a href="https://food.grab.com/id/id/restaurant/{{ $umkm->grab }}"
                                target="_blank"
                                class="text-[#0A142F] font-semibold hover:underline">
                                GrabFood
                            </a>
                        </div>
                    </div>
                    @endif

                    @if (!empty($umkm->tiktok))
                    <div class="flex items-center space-x-2">
                        <span class="fab fa-tiktok text-2xl text-[#0A142F]"></span>
                        <div>
                            <a href="{{ 'https://www.tiktok.com/@' . ltrim($umkm->tiktok, '@') }}"
                                target="_blank"
                                class="text-[#0A142F] font-semibold hover:underline">
                                TikTok
                            </a>

                        </div>
                    </div>
                    @endif

                    @if (!empty($umkm->facebook))
                    <div class="flex items-center space-x-2">
                        <span class="fab fa-facebook text-2xl text-[#0A142F]"></span>
                        <div>
                            <a href="https://facebook.com/{{ ltrim($umkm->facebook, '@') }}"
                                target="_blank"
                                class="text-[#0A142F] font-semibold hover:underline">
                                Facebook
                            </a>
                        </div>
                    </div>
                    @endif

                    <div class="flex items-start space-x-2 sm:col-span-2">
                        <span class="material-symbols-outlined text-[#0A142F]">location_on</span>
                        <div>
                            <p>Alamat</p>
                            <p class="font-semibold">{{ $umkm->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection