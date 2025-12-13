@extends('layouts.app')

@section('content')
<div class="p-4 md:p-6 bg-white rounded-lg shadow">
    {{-- Tombol Back --}}
    <div class="mb-4">
        <a href="{{ route('admin.umkm') }}"
            class="inline-flex items-center px-3 py-1 rounded-md border border-gray-300 text-sm hover:bg-gray-100 mb-4">
            ← Kembali
        </a>
    </div>

    <h1 class="text-xl md:text-2xl font-bold mb-6" style="color:#0A142F;">Edit Data UMKM</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    {{-- Notifikasi error umum --}}
    @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('umkm.update', $umkm->id_umkm) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Gunakan grid responsif --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Nama Usaha --}}
            <div>
                <label class="font-semibold">Nama Usaha</label>
                <input type="text" name="nama" value="{{ old('nama', $umkm->nama) }}" class="border rounded w-full p-2" placeholder="Masukkan Nama Usaha">
                @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tahun Berdiri --}}
            <div>
                <label class="font-semibold">Tahun Berdiri</label>
                <input type="text" name="tahun" value="{{ old('tahun_berdiri', $umkm->tahun_berdiri) }}" class="border rounded w-full p-2" placeholder="Tahun">
                @error('tahun')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="md:col-span-2">
                <label class="font-semibold">Deskripsi Usaha</label>
                <textarea name="deskripsi" class="border rounded w-full p-2" placeholder="Deskripsikan Usaha Tersebut">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                @error('deskripsi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- NIB --}}
            <div>
                <label class="font-semibold">NIB</label>
                <input type="text" name="nib" value="{{ old('nib', $umkm->nib) }}" class="border rounded w-full p-2" placeholder="Masukkan NIB Usaha, Jika Ada">
                @error('nib')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label class="font-semibold">Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat', $umkm->alamat) }}" class="border rounded w-full p-2" placeholder="Alamat Lengkap Usaha">
                @error('alamat')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Instagram --}}
            <div>
                <label class="font-semibold">Instagram</label>
                <input type="text" name="instagram" value="{{ old('instagram', $umkm->instagram) }}" class="border rounded w-full p-2" placeholder="Masukkan Instagram Usaha, Jika Ada">
                @error('instagram')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Facebook --}}
            <div>
                <label class="font-semibold">Facebook</label>
                <input type="text" name="facebook" value="{{ old('facebook', $umkm->facebook) }}" class="border rounded w-full p-2" placeholder="Masukkan Facebook Usaha, Jika Ada">
                @error('facebook')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- TikTok --}}
            <div>
                <label class="font-semibold">TikTok</label>
                <input type="text" name="tiktok" value="{{ old('tiktok', $umkm->tiktok) }}" class="border rounded w-full p-2" placeholder="Masukkan TikTok Usaha, Jika Ada">
                @error('tiktok')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Grab --}}
            <div>
                <label class="font-semibold">Grab</label>
                <input type="text" name="grab" value="{{ old('grab', $umkm->grab) }}" class="border rounded w-full p-2" placeholder="Masukkan Link GrabFood / GrabMart Usaha, Jika Ada">
                @error('grab')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jenis Usaha --}}
            <div>
                <label class="font-semibold">Jenis Usaha</label>
                <input type="text" name="jenis_usaha" value="{{ old('jenis_usaha', $umkm->jenis_usaha) }}" class="border rounded w-full p-2" placeholder="Masukkan Jenis Usaha">
                @error('jenis_usaha')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Telepon --}}
            <div>
                <label class="font-semibold">Telepon</label>
                <input type="text" name="telp" value="{{ old('telp', $umkm->telp) }}" class="border rounded w-full p-2" placeholder="Masukkan No. Telepon Aktif Usaha">
                @error('telp')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Foto Usaha --}}
            <div>
                <label class="font-semibold">Foto Usaha</label>
                <input
                    type="file"
                    name="gambar"
                    id="gambar"
                    class="border rounded w-full p-2"
                    accept="image/*">
                @error('gambar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                {{-- Preview Gambar --}}
                <img
                    id="preview_foto"
                    src="{{ $umkm->gambar ? asset('storage/'.$umkm->gambar) : '#' }}"
                    alt="Foto Usaha"
                    class="mt-3 w-40 h-40 object-cover rounded border {{ $umkm->gambar ? '' : 'hidden' }}">
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-6 flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.umkm') }}" class="px-4 py-2 bg-gray-200 text-black rounded w-full sm:w-auto text-center">Batal</a>
            <button type="submit" class="px-4 py-2 text-white rounded w-full sm:w-auto" style="background-color:#0A142F;">Simpan Perubahan</button>
        </div>
    </form>
</div>

{{-- Script Preview --}}
<script>
    document.getElementById('foto_usaha').addEventListener('change', function(e) {
        let file = e.target.files[0];
        let preview = document.getElementById('preview_foto');

        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                preview.src = event.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection