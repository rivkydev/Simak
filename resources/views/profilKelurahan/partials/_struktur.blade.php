<div class="space-y-6 text-[#0A142F]">
    <div>
        <h2 class="text-3xl font-bold">Struktur Organisasi Kelurahan {{ $kelurahan->nama }}</h2>
        <p class="text-sm text-gray-500 mt-1">
            Dokumen resmi susunan organisasi Kelurahan {{ $kelurahan->nama }}
        </p>
    </div>

    @if ($struktur && $struktur->document_struktur)
        <div class="bg-gradient-to-br from-green-50 to-white border border-green-200 rounded-2xl shadow-md overflow-hidden">
            <div class="w-full h-[500px]">
                <embed 
                src="{{ asset('storage/' . urlencode($struktur->document_struktur)) }}" 
                type="application/pdf" 
                class="w-full h-full"
            />
            </div>
            <div class="p-4 bg-white border-t text-center">
                <a href="{{ asset('storage/' . $struktur->document_struktur) }}" target="_blank" 
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-700 rounded-full hover:bg-green-800 transition">
                    📄 Lihat Versi Penuh / Unduh PDF
                </a>
            </div>
        </div>
    @else
        <div class="text-gray-500 italic">Dokumen struktur belum tersedia.</div>
    @endif
</div>