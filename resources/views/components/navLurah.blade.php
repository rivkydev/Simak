<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
<script src="https://unpkg.com/htmx.org@1.9.10"></script>
<script src="//unpkg.com/alpinejs" defer></script>

<style>
    .material-symbols-outlined {
        font-variation-settings:
            'FILL' 1,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24;
    }
</style>

@php
    $menus = [
        ['icon' => 'monitoring', 'label' => 'Dashboard', 'route' => route('pegawai.dashboard'), 'active' => Route::is('pegawai.dashboard')],
        ['icon' => 'store', 'label' => 'Data UMKM', 'route' => route('pegawai.umkm'), 'active' => Route::is('pegawai.umkm')],
    ];
@endphp

<div 
    x-data="{ 
        open: JSON.parse(localStorage.getItem('sidebarOpen')) ?? (window.innerWidth >= 768) 
    }"
    x-init="
        window.addEventListener('resize', () => { open = window.innerWidth >= 768 });
        $watch('open', value => localStorage.setItem('sidebarOpen', JSON.stringify(value)));
    "
    class="flex h-screen overflow-hidden"
>

    <aside 
        :class="open ? 'w-64' : 'w-20'" 
        class="text-[#0A142F] bg-[#F9FAFB] border-r shadow-sm flex flex-col transition-all duration-300 ease-in-out fixed h-full z-20"
    >
        <button 
            @click="open = !open"
            class="absolute -right-3 top-[3.75rem] w-7 h-7 bg-white text-[#0c3252] rounded-full flex items-center justify-center shadow hover:scale-105 transition z-10"
        >
            <span class="material-symbols-outlined text-sm transform transition-transform duration-300"
                  :class="open ? 'rotate-0' : 'rotate-180'">
                arrow_back_2
            </span>
        </button>

        <div class="flex items-center justify-center px-6 py-6 transition-all duration-300 space-x-2">
            <img src="{{ asset('assets/logo/parepare.png') }}" alt="Logo 1" class="h-8">
            <img src="{{ asset('assets/logo/ith.png') }}" alt="Logo 2" class="h-8">
            <span class="text-lg font-bold ml-2 whitespace-nowrap" x-show="open" x-transition>SIMAK</span>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 space-y-1" x-data>
            @foreach ($menus as $menu)
                <a href="{{ $menu['route'] }}"
                hx-get="{{ $menu['route'] }}"
                hx-target="#main-content"
                hx-select="#main-content"
                hx-swap="innerHTML"
                hx-push-url="true"
                @click="
                    document.querySelectorAll('nav a').forEach(a => {
                        a.classList.remove('bg-white', 'shadow', 'font-semibold');
                        a.classList.add('hover:bg-white', 'hover:shadow');
                    });
                    $el.classList.add('bg-white', 'shadow', 'font-semibold');
                    $el.classList.remove('hover:bg-white', 'hover:shadow');
                "
                class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all
                        {{ $menu['active'] 
                            ? 'bg-white shadow font-semibold' 
                            : 'hover:bg-white hover:shadow' }} text-[#0A142F]">
                    <span class="material-symbols-outlined w-6 text-center">{{ $menu['icon'] }}</span>
                    <span x-show="open" x-transition.opacity class="whitespace-nowrap overflow-hidden">
                        {{ $menu['label'] }}
                    </span>
                </a>
            @endforeach
        </nav>

        <div class="p-4 border-t">
            @php
                $pegawai = Auth::guard('pegawai')->user();
            @endphp

            <div class="text-sm mb-2" x-show="open" x-transition>
                <div class="font-semibold">{{ $pegawai->nama }}</div>
                <div class="text-gray-500">
                    @if($pegawai->id_jabatan == 2)
                        Sekretaris Kelurahan
                    @elseif($pegawai->id_jabatan == 3)
                        Lurah
                    @endif
                    {{ $pegawai->kelurahan->nama ?? '' }}
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="flex items-center gap-2 text-sm px-4 text-white py-2 border rounded-lg hover:bg-blue-950 bg-[#0A142F] transition w-full">
                    <span class="material-symbols-outlined">logout</span>
                    <span x-show="open" x-transition>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <div 
        class="flex-1 transition-all duration-300 overflow-y-auto h-screen"
        :class="open ? 'ml-64' : 'ml-20'"
    >
        <main id="main-content" class="p-6">
            @yield('content')
        </main>
    </div>
</div><script>
document.addEventListener('alpine:init', () => {
    // Event klik langsung highlight menu
    document.querySelectorAll('nav a').forEach(a => {
        a.addEventListener('click', function () {
            document.querySelectorAll('nav a').forEach(x => {
                x.classList.remove('bg-white', 'shadow', 'font-semibold');
                x.classList.add('hover:bg-white', 'hover:shadow');
            });
            this.classList.add('bg-white', 'shadow', 'font-semibold');
            this.classList.remove('hover:bg-white', 'hover:shadow');
        });
    });
});

// Event setelah HTMX load konten, sinkronkan warna
document.body.addEventListener('htmx:afterOnLoad', function() {
    const currentPath = window.location.pathname;
    document.querySelectorAll('nav a').forEach(a => {
        const linkPath = new URL(a.href).pathname;
        if (linkPath === currentPath) {
            a.classList.add('bg-white', 'shadow', 'font-semibold');
            a.classList.remove('hover:bg-white', 'hover:shadow');
        } else {
            a.classList.remove('bg-white', 'shadow', 'font-semibold');
            a.classList.add('hover:bg-white', 'hover:shadow');
        }
    });
});
</script>
