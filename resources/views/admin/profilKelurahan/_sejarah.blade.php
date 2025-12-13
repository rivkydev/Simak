<div class="p-6 space-y-2">
    <div class="flex items-center gap-x-2">
        <h2 class="text-xl font-semibold text-[#0A142F]">Sejarah</h2>
        <button
            onclick="document.getElementById('modalSejarah').classList.remove('hidden')"
            class="text-[#0A142F] hover:text-blue-900">
            <span class="material-symbols-outlined text-base align-middle">edit_square</span>
        </button>
    </div>

    <p class="text-gray-700 leading-relaxed">
        {{ $sejarah->deskripsi ?? 'Belum ada sejarah.' }}
    </p>
</div>

<div id="modalSejarah" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center hidden">
    <div class="bg-white w-full max-w-xl p-6 rounded-xl shadow-lg relative">
     
        <h3 class="text-lg font-semibold mb-4 text-[#0A142F]">Edit Sejarah</h3>

        <form action="{{ route('admin.profil.updateSejarah', $profil->id_kelurahan) }}" method="POST">
            @csrf
            <textarea
                name="deskripsi"
                rows="5"
                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0A142F] resize-none">{{ old('deskripsi', $sejarah->deskripsi ?? '') }}</textarea>

            <div class="flex justify-end mt-4 gap-2">
                <button
                    type="button"
                    onclick="document.getElementById('modalSejarah').classList.add('hidden')"
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
    </div>
</div>