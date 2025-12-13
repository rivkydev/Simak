<div class="p-6 space-y-6 text-[#0A142F]">
    <div class="flex items-center gap-x-2">
        <h2 class="text-xl font-semibold text-[#0A142F]">Struktur Organisasi</h2>
        <button
            type="button"
            onclick="document.getElementById('modalStruktur').classList.remove('hidden')"
            class="text-[#0A142F] hover:text-blue-900">
            <span class="material-symbols-outlined text-base align-middle">edit_square</span>
        </button>
    </div>

    @if ($struktur && $struktur->document_struktur)
        <div class="bg-white rounded-2xl shadow-md border border-green-200 overflow-hidden">
            <div class="w-full h-[500px]">
                <embed
                    src="{{ asset('storage/' . urlencode($struktur->document_struktur)) }}"
                    type="application/pdf"
                    class="w-full h-full" />
            </div>
            <div class="p-4 border-t text-center bg-white">
                <a href="{{ asset('storage/' . $struktur->document_struktur) }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-700 rounded-full hover:bg-green-800 transition">
                    📄 Lihat Versi Penuh / Unduh PDF
                </a>
            </div>
        </div>
    @else
        <p class="text-gray-500 italic">Dokumen struktur belum tersedia.</p>
    @endif
</div>

<div id="modalStruktur" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center hidden">
    <div class="bg-white w-full max-w-lg p-6 rounded-xl shadow-lg relative">
        <h3 class="text-lg font-semibold mb-4 text-[#0A142F]">Upload Struktur Organisasi Kelurahan {{ $kelurahan->nama }}</h3>

        <form action="{{ route('admin.profil.updateStruktur', $kelurahan->id_kelurahan) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-4">
            @csrf
            <input type="hidden" name="id_kelurahan" value="{{ $kelurahan->id_kelurahan }}">

            <div>
                <label class="block text-sm font-medium mb-1">Dokumen Struktur (PDF / Gambar)</label>
                <input type="file" name="document_struktur"
                    accept="application/pdf,image/jpeg,image/png" required
                    class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#0A142F] file:text-white hover:file:bg-[#061024]">
                <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG — Max 5MB</p>
            </div>

            <div class="flex justify-end gap-2">
                <button
                    type="button"
                    onclick="document.getElementById('modalStruktur').classList.add('hidden')"
                    class="px-4 py-2 text-sm border rounded text-gray-600 hover:bg-gray-100">
                    Batal
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 text-sm text-white bg-[#0A142F] rounded hover:bg-[#061024]">
                    Simpan
                </button>
            </div>
        </form>

        <button type="button"
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
            onclick="document.getElementById('modalStruktur').classList.add('hidden')">
            ✕
        </button>
    </div>
</div>