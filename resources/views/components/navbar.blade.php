<nav class="bg-white shadow-md w-full z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3">

        <div class="flex items-center space-x-3">
            <img src="{{ asset('assets/logo/parepare.png') }}" alt="Logo Parepare" class="h-10 w-auto">
            <img src="{{ asset('assets/logo/ith.png') }}" alt="Logo ITH" class="h-10 w-auto">
        </div>

        <div class="md:hidden">
            <button id="nav-toggle" class="text-gray-800 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div class="hidden md:flex items-center space-x-6 bg-[#0A142F] text-white text-sm font-medium px-6 py-2 rounded-full shadow-md">
            <a href="{{ route('home') }}" class="hover:text-gray-300">Beranda</a>
            <a href="{{ route('kelurahan.index') }}" class="hover:text-gray-300">Profil Kelurahan</a>
            <a href="{{ route('umkm.kelurahan') }}" class="hover:text-gray-300">Informasi UMKM</a>
            <a href="{{ route('pelayanan.index') }}" class="hover:text-gray-300">Pelayanan</a>
            <a href="{{ route('about') }}" class="hover:text-gray-300">Tentang</a>
        </div>

        <div class="hidden md:block">
            <a href="{{ route('login') }}" class="bg-[#0A142F] text-white px-5 py-2 rounded-full text-sm font-semibold shadow-md hover:bg-gray-800">
                Login
            </a>
        </div>
    </div>

    <div id="nav-menu" class="md:hidden hidden flex flex-col bg-[#0A142F] text-white text-sm font-medium px-6 pt-4 pb-6 space-y-3 animate-slide-down">
        <a href="{{ route('home') }}" class="block hover:text-gray-300">Beranda</a>
        <a href="{{ route('kelurahan.index') }}" class="block hover:text-gray-300">Profil Kelurahan</a>
        <a href="{{ route('umkm.kelurahan') }}" class="block hover:text-gray-300">Informasi UMKM</a>
        <a href="{{ route('pelayanan.index') }}" class="block hover:text-gray-300">Pelayanan</a>
        <a href="{{ route('about') }}" class="block hover:text-gray-300">Tentang</a>
        <a href="{{ route('login') }}" class="block text-center bg-white text-[#0A142F] font-semibold px-4 py-2 rounded-full shadow-md hover:bg-gray-200">
            Login
        </a>
    </div>
    <main>
        @yield('content')
    </main>
    <script>
        document.getElementById('nav-toggle').addEventListener('click', function() {
            const menu = document.getElementById('nav-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    <style>
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-down {
            animation: slideDown 0.3s ease-out;
        }
    </style>
</nav>