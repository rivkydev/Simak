@extends('layouts.app')

@section('title', 'Tentang Sistem Manajemen Kelurahan')

@section('content')
<div class="bg-white py-16 min-h-screen text-[#0A142F]">
    <div class="max-w-6xl mx-auto px-6">
        <a href="{{ route('home') }}" class="inline-flex items-center px-3 py-1 rounded-md border border-gray-300 text-sm hover:bg-gray-100 mb-4">
        ← Kembali
        </a>
        <h1 class="text-2xl md:text-3xl font-bold mb-6">
            Tentang Sistem Manajemen Kelurahan
        </h1>
        <div class="bg-white p-6 md:p-10 rounded-2xl shadow-xl mb-12">
            <p class="text-lg md:text-xl mb-4 leading-relaxed">
                <strong>Sistem Manajemen Kelurahan</strong> merupakan platform digital terpadu untuk mendukung transformasi digital kelurahan di Kota Parepare. Platform ini hadir sebagai solusi layanan publik yang <span class="font-semibold text-blue-700">mudah, cepat, dan inklusif</span>, sejalan dengan visi Smart City.
            </p>
            <div class="bg-blue-100 px-6 py-4 rounded-xl text-center italic text-blue-800 text-lg md:text-xl shadow-inner">
                “Digitalisasi Layanan Kelurahan, Menuju Masyarakat yang Lebih Adaptif dan Cerdas.”
            </div>
        </div>

        <div class="mb-16">
            <h2 class="text-2xl md:text-3xl font-bold mb-6">🎯 Tujuan Sistem</h2>
            <div class="grid md:grid-cols-2 gap-6 text-lg">
                <ul class="list-disc list-inside space-y-2">
                    <li>Meningkatkan kualitas pelayanan publik di tingkat kelurahan.</li>
                    <li>Mendorong partisipasi aktif masyarakat melalui sistem terbuka.</li>
                    <li>Menjadikan data kelurahan sebagai dasar pengambilan kebijakan yang tepat.</li>
                </ul>
                <ul class="list-disc list-inside space-y-2">
                    <li>Mewujudkan birokrasi modern dan efisien berbasis teknologi.</li>
                    <li>Mendukung pengembangan potensi lokal secara berkelanjutan.</li>
                </ul>
            </div>
        </div>

        <div class="mb-16">
            <h2 class="text-2xl md:text-3xl font-bold mb-6">🚀 Fitur Unggulan</h2>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($features as [$icon, $title, $desc])
                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                        <h3 class="text-xl font-semibold mb-2">{{ $icon }} {{ $title }}</h3>
                        <p class="text-gray-700">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-16">
            <h2 class="text-2xl md:text-3xl font-bold mb-6">👨‍💻 Tim Pengembang</h2>
            <div class="bg-white p-6 rounded-xl shadow-md text-gray-700 text-lg leading-relaxed">
                <p class="mb-4">
                    Aplikasi ini dikembangkan oleh tim mahasiswa <strong>Institut Teknologi BJ Habibie</strong> bekerja sama dengan Pemerintah Kota Parepare, dalam rangka percepatan implementasi layanan kelurahan berbasis digital.
                </p>
                <p>
                    Untuk informasi lebih lanjut, hubungi kami melalui email:
                    <a href="mailto:simak@ith.ac.id" class="text-blue-600 underline hover:text-blue-800">simak@ith.ac.id</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
