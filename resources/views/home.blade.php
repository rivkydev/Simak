@extends('layouts.app')

@section('title', 'Beranda SIMAK')

@section('content')

<style>
    html {
        scroll-behavior: smooth;
    }
</style>

<section class="relative bg-cover min-h-[90vh] flex items-center" style="background-image: url('/assets/bg/monumen.png'); background-position: 80% 20%;">
    <div class="absolute inset-0 bg-gradient-to-b from-white/60 via-white/50 to-transparent z-0"></div>
    <img src="/assets/bg/patung_habibie.png" alt="Patung Habibie" class="absolute right-0 bottom-0 w-60 md:w-72 lg:w-96 z-10 hidden sm:block">

    <div class="text-left text-white z-20 px-4 max-w-xl lg:ml-24">
        <h1 class="text-3xl md:text-4xl font-bold text-orange-400 leading-tight">
            <span class="text-orange-400">Sistem Manajemen Kelurahan</span><br>
            Kota Parepare
        </h1>

        <a href="#layanan" class="mt-6 inline-block bg-[#0A142F] text-white hover:text-[#0A142F] hover:bg-white font-semibold px-6 py-2 rounded-md shadow transition duration-300">
            Lihat Layanan
        </a>
    </div>
</section>

<section class="relative z-30 -mt-16 px-4 -mb-16">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg grid grid-cols-3 overflow-hidden text-left">

        <div class="py-4 px-2 flex flex-col items-center justify-center gap-1">
            <p class="text-2xl md:text-4xl font-extrabold text-[#0A142F]">22</p>
            <p class="text-xs md:text-sm font-medium text-gray-600 text-center">Kelurahan</p>
        </div>

        <div class="py-4 px-2 flex flex-col items-center justify-center gap-1">
            <p class="text-2xl md:text-4xl font-extrabold text-[#0A142F]">{{ $totalUMKM }}</p>
            <p class="text-xs md:text-sm font-medium text-gray-600 text-center">UMKM</p>
        </div>

        <div class="py-4 px-2 flex flex-col items-center justify-center gap-1">
            <p class="text-2xl md:text-4xl font-extrabold text-[#0A142F]">571</p>
            <p class="text-xs md:text-sm font-medium text-gray-600 text-center">RT/RW</p>
        </div>
    </div>
</section>

<section class="bg-[#0c163b] text-white py-16 px-6 text-center">
    <div class="mt-14 max-w-6xl mx-auto">
        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 flex items-center justify-center gap-3">
            Apa itu SIMAK?
            <img src="{{ asset('assets/bingung.png') }}" alt="Icon Bingung" class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12">
        </h2>
        <p class="text-lg sm:text-xl lg:text-2xl font-light mt-4 max-w-4xl mx-auto">
            SIMAK adalah platform digital untuk layanan administrasi dan informasi di tingkat kelurahan, dengan fokus pada pengelolaan Profil Kelurahan, Informasi UMKM, dan layanan Persuratan.
        </p>
    </div>
</section>

<section id="layanan" class="py-10 px-4 bg-white text-[#0c163b]">
    <div class="max-w-6xl mx-auto space-y-10">

        <div class="text-left mb-6" data-aos="fade-up">
            <h2 class="text-3xl sm:text-4xl font-bold leading-tight">
                Sistem Manajemen Kelurahan<br>
                <span class="text-[#0c163b]">Kota Parepare</span>
            </h2>
        </div>

        <!-- Profil Kelurahan -->
        <div class="flex flex-col md:flex-row items-start md:items-center gap-6" data-aos="fade-up">
            <a href="{{ route('kelurahan.index') }}" class="w-full md:w-[250px] transition-transform hover:scale-105 duration-300 shrink-0">
                <div class="bg-white shadow-md rounded-xl border p-6 text-center hover:shadow-lg cursor-pointer">
                    <img src="{{ asset('assets/data_profil.png') }}" alt="Profil Kelurahan" class="w-14 h-14 mx-auto mb-3">
                    <h3 class="text-base font-semibold">Profil Kelurahan</h3>
                    <p class="text-[13px] text-gray-500 mt-1">Lihat kondisi Kelurahanmu disini!</p>
                </div>
            </a>
            <div class="flex-1 text-lg md:text-base text-gray-800 leading-relaxed text-justify">
                Profil Kelurahan di SIMAK menghadirkan informasi resmi kelurahan mulai dari nama, lokasi, sejarah, hingga potensi dan struktur pemerintahan dalam satu tampilan ringkas, informatif, dan selalu mutakhir, sehingga warga dapat mengenal wilayahnya tanpa harus datang ke kantor kelurahan.
            </div>
        </div>

        <!-- Informasi UMKM -->
        <div class="flex flex-col md:flex-row items-start md:items-center gap-6" data-aos="fade-up" data-aos-delay="100">
            <a href="{{ route('umkm.kelurahan') }}" class="w-full md:w-[250px] transition-transform hover:scale-105 duration-300 shrink-0">
                <div class="bg-white shadow-md rounded-xl border p-6 text-center hover:shadow-lg cursor-pointer">
                    <img src="{{ asset('assets/data_umkm.png') }}" alt="UMKM" class="w-14 h-14 mx-auto mb-3">
                    <h3 class="text-base font-semibold">Informasi UMKM</h3>
                    <p class="text-[13px] text-gray-500 mt-1">Kenali pelaku usaha sekitar!</p>
                </div>
            </a>
            <div class="flex-1 text-lg md:text-base text-gray-800 leading-relaxed text-justify">
                Informasi UMKM di SIMAK menyajikan informasi detail mengenai pelaku usaha, produk unggulan, lokasi, dan kontak yang terintegrasi dalam satu platform ringkas dan informatif. Mendukung warga untuk lebih mudah mengenal, mengakses, dan memberdayakan ekonomi lokal secara langsung.
            </div>
        </div>

        <!-- Layanan Persuratan -->
        <div class="flex flex-col md:flex-row items-start md:items-center gap-6" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('pelayanan.index') }}" class="w-full md:w-[250px] transition-transform hover:scale-105 duration-300 shrink-0">
                <div class="bg-white shadow-md rounded-xl border p-6 text-center hover:shadow-lg cursor-pointer">
                    <img src="{{ asset('assets/data_persuratan.png') }}" alt="Layanan Persuratan" class="w-14 h-14 mx-auto mb-3">
                    <h3 class="text-base font-semibold">Layanan Persuratan</h3>
                    <p class="text-[13px] text-gray-500 mt-1">Ajukan surat dengan mudah!</p>
                </div>
            </a>
            <div class="flex-1 text-lg md:text-base text-gray-800 leading-relaxed text-justify">
                Fitur Persuratan di SIMAK memudahkan pegawai kelurahan dalam membuat dan mengelola berbagai jenis surat secara digital. Semua proses dilakukan secara internal, sehingga lebih cepat, terorganisir, dan efisien tanpa perlu penanganan manual.
            </div>
        </div>

    </div>
</section>


@endsection