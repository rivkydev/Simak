<div class="p-6 space-y-6 text-[#0A142F]">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold">Foto Kelurahan</h2>
    </div>

    <p class="text-blue-600 hover:underline cursor-pointer" onclick="document.getElementById('modalFotoKelurahan').classList.remove('hidden')">
        Lihat Foto Kelurahan
    </p>

    <div class="flex items-center gap-x-2">
        <h2 class="text-xl font-semibold">Deskripsi</h2>
        <button onclick="document.getElementById('modalDeskripsi').classList.remove('hidden')" class="text-[#0A142F] hover:text-blue-900">
            <span class="material-symbols-outlined text-base align-middle">edit_square</span>
        </button>
    </div>
    <p class="text-gray-700 leading-relaxed">{{ $profil->deskripsi ?? 'Belum ada deskripsi.' }}</p>

    <div class="flex items-center gap-x-2 mt-6">
        <h2 class="text-xl font-semibold">VISI</h2>
        <button onclick="document.getElementById('modalVisi').classList.remove('hidden')" class="text-[#0A142F] hover:text-blue-900">
            <span class="material-symbols-outlined text-base align-middle">edit_square</span>
        </button>
    </div>
    <p class="text-gray-700">{{ $profil->visi ?? 'Belum ada visi.' }}</p>

    <div class="flex items-center gap-x-2 mt-6">
        <h2 class="text-xl font-semibold">MISI</h2>
        <button onclick="document.getElementById('modalMisi').classList.remove('hidden')" class="text-[#0A142F] hover:text-blue-900">
            <span class="material-symbols-outlined text-base align-middle">edit_square</span>
        </button>
    </div>
    @if ($profil->misi)
        <ol class="list-inside text-gray-700 space-y-1">
            @foreach (explode("\n", $profil->misi) as $misi)
                @if (trim($misi) !== '')
                    <li>{{ trim($misi) }}</li>
                @endif
            @endforeach
        </ol>
    @else
        <p class="text-gray-700">Belum ada misi.</p>
    @endif

    <div class="flex items-center gap-x-2 mt-6">
        <h2 class="text-xl font-semibold">Dokumentasi Kegiatan</h2>
        <button onclick="document.getElementById('modalFoto').classList.remove('hidden')" class="text-[#0A142F] hover:text-blue-900">
            <span class="material-symbols-outlined text-base align-middle">edit_square</span>
        </button>
    </div>

    <div class="flex items-center gap-4 mt-2">
        @if ($profil->fotoKegiatan->count() > 0)
            <button type="button" onclick="scrollFotos(-1)">
                <span class="material-symbols-outlined text-4xl hover:opacity-80" style="color: #0A142F;">arrow_circle_left</span>
            </button>
        @endif

        <div id="fotoContainer" class="flex gap-4 overflow-x-auto scroll-smooth scrollbar-hide">
            @forelse ($profil->fotoKegiatan as $foto)
                <div class="flex-shrink-0 w-60">
                    <img src="{{ asset('storage/' . $foto->foto) }}" alt="{{ $foto->nama_kegiatan }}" class="w-full h-40 object-cover rounded shadow">
                    <p class="mt-1 text-sm text-gray-600 text-center">{{ $foto->nama_kegiatan }}</p>
                </div>
            @empty
                <p class="text-gray-700">Belum ada dokumentasi kegiatan.</p>
            @endforelse
        </div>

        @if ($profil->fotoKegiatan->count() > 0)
            <button type="button" onclick="scrollFotos(1)">
                <span class="material-symbols-outlined text-4xl hover:opacity-80" style="color: #0A142F;">arrow_circle_right</span>
            </button>
        @endif
    </div>

</div>
    <div id="modalDeskripsi" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-xl p-6 rounded-xl shadow-lg relative">
            <h3 class="text-lg font-semibold mb-4 text-[#0A142F]">Edit Deskripsi</h3>
            <form action="{{ route('admin.profil.updateDeskripsi', $profil->id_kelurahan) }}" method="POST">
                @csrf
                <textarea name="deskripsi" rows="5" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0A142F]">{{ old('deskripsi', $profil->deskripsi) }}</textarea>
                <div class="flex justify-end mt-4 gap-2">
                    <button type="button" onclick="document.getElementById('modalDeskripsi').classList.add('hidden')" class="px-4 py-2 text-sm border rounded text-gray-600 hover:bg-gray-100">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-[#0A142F] rounded hover:bg-[#061024]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalVisi" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-xl p-6 rounded-xl shadow-lg relative">
            <h3 class="text-lg font-semibold mb-4 text-[#0A142F]">Edit VISI</h3>
            <form action="{{ route('admin.profil.updateVisi', $profil->id_kelurahan) }}" method="POST">
                @csrf
                <textarea name="visi" rows="4" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0A142F]">{{ old('visi', $profil->visi) }}</textarea>
                <div class="flex justify-end mt-4 gap-2">
                    <button type="button" onclick="document.getElementById('modalVisi').classList.add('hidden')" class="px-4 py-2 text-sm border rounded text-gray-600 hover:bg-gray-100">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-[#0A142F] rounded hover:bg-[#061024]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalMisi" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-xl p-6 rounded-xl shadow-lg relative">
            <h3 class="text-lg font-semibold mb-4 text-[#0A142F]">Edit MISI</h3>
            <form action="{{ route('admin.profil.updateMisi', $profil->id_kelurahan) }}" method="POST">
                @csrf
                <textarea name="misi" rows="6" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0A142F]">{{ old('misi', $profil->misi) }}</textarea>
                <small class="text-gray-500 block mt-1">Gunakan enter untuk setiap poin misi.</small>
                <div class="flex justify-end mt-4 gap-2">
                    <button type="button" onclick="document.getElementById('modalMisi').classList.add('hidden')" class="px-4 py-2 text-sm border rounded text-gray-600 hover:bg-gray-100">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-[#0A142F] rounded hover:bg-[#061024]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalFoto" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-3xl p-6 rounded-xl shadow-lg relative">
            <h3 class="text-lg font-semibold mb-4 text-[#0A142F]">Kelola Foto Kegiatan</h3>
            @if($fotoKegiatan->count() > 0)
                <div class="mb-6">
                    <h4 class="text-sm font-semibold mb-2">Foto Saat Ini:</h4>
                    <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                        @foreach($fotoKegiatan as $foto)
                            <div class="relative group border rounded overflow-hidden">
                                <img src="{{ asset('storage/'.$foto->foto) }}" alt="Foto" class="w-full h-24 object-cover">
                                <div class="p-1 text-xs text-center bg-gray-50">
                                    {{ $foto->nama_kegiatan }}
                                </div>
                                <form action="{{ route('admin.profil.deleteFoto', $foto->id_foto) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')" class="absolute top-1 right-1 hidden group-hover:block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white rounded-full px-2 py-1 text-xs hover:bg-red-700">✕</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="text-sm text-gray-500 mb-6">Belum ada foto kegiatan yang tersimpan.</p>
            @endif
            <form action="{{ route('admin.profil.updateFoto', $profil->id_kelurahan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" id="fotoInput" name="foto_kegiatan[]" multiple accept="image/*" class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#0A142F] file:text-white hover:file:bg-[#061024]">
                <small class="text-gray-500 block mt-1 mb-3">Pilih beberapa foto sekaligus (jpg, png).</small>
                <div id="namaKegiatanWrapper" class="space-y-3"></div>
                <div class="flex justify-end mt-4 gap-2">
                    <button type="button" onclick="document.getElementById('modalFoto').classList.add('hidden')" class="px-4 py-2 text-sm border rounded text-gray-600 hover:bg-gray-100">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-[#0A142F] rounded hover:bg-[#061024]">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalFotoKelurahan" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center hidden">
    <div class="bg-white w-full max-w-2xl p-6 rounded-xl shadow-lg relative">
        <h3 class="text-lg font-semibold mb-4 text-[#0A142F]">Foto Kelurahan</h3>
        @if ($kelurahan->foto_kelurahan)
            <img src="{{ asset('storage/' . $kelurahan->foto_kelurahan) }}" alt="Foto Kelurahan" class="w-full h-64 object-cover rounded shadow mb-4">
        @else
            <p class="text-gray-500 mb-4">Belum ada foto kelurahan.</p>
        @endif
        <form action="{{ route('admin.profil.updateFotoKelurahan', $profil->id_kelurahan) }}" method="POST" enctype="multipart/form-data" class="mb-3">
            @csrf
            <input type="file" name="foto_kelurahan" accept="image/*" class="block w-full text-sm mb-2">
            <button type="submit" class="px-4 py-2 text-sm text-white bg-[#0A142F] rounded hover:bg-blue-950">Ganti Foto</button>
        </form>
        <div class="flex justify-end mt-4">
            <button type="button" onclick="document.getElementById('modalFotoKelurahan').classList.add('hidden')" class="px-4 py-2 text-sm border rounded text-gray-600 hover:bg-gray-100">Tutup</button>
        </div>
    </div>
</div>

<script>
    document.getElementById('fotoInput').addEventListener('change', function(e) {
        const wrapper = document.getElementById('namaKegiatanWrapper');
        wrapper.innerHTML = '';
        Array.from(e.target.files).forEach(file => {
            const div = document.createElement('div');
            div.classList.add('flex', 'items-center', 'gap-2');
            div.innerHTML = `<input type="text" name="nama_kegiatan[]" placeholder="Nama kegiatan untuk ${file.name}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-[#0A142F]" required>`;
            wrapper.appendChild(div);
        });
    });

    function scrollFotos(direction) {
        const container = document.getElementById('fotoContainer');
        const scrollAmount = 250;
        container.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
    }
</script>

<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>
