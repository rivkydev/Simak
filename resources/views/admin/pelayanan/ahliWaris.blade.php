@extends('layouts.app')
@section('title', 'Surat Keterangan Ahli Waris')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10 text-[#0A142F]">
    <a href="{{ route('admin.pelayanan') }}" class="flex items-center font-semibold hover:text-blue-600 mb-6">
        <span class="material-symbols-outlined mr-1">arrow_back</span> Kembali
    </a>

    <h1 class="text-2xl sm:text-3xl font-bold mb-8">Surat Keterangan Ahli Waris</h1>

    <form action="{{ route('admin.pelayanan.cetak', 'ahli-waris') }}" method="POST" class="space-y-8 bg-white p-6 rounded-lg shadow-md">
        @csrf

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label class="block font-semibold mb-1">Nomor Surat <span class="text-red-500">*</span></label>
            <input type="text" name="nomor_surat" placeholder="Masukkan Nomor Surat" required
                value="{{ old('nomor_surat') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
        </div>

        <div>
            <h2 class="text-2xl font-semibold mb-4">Data Pewaris (Yang Meninggal Dunia)</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold mb-1">Nama Pewaris <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_pewaris" placeholder="Nama lengkap pewaris" required
                        value="{{ old('nama_pewaris') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>

                <div>
                    <label class="block font-semibold mb-1">NIK Pewaris</label>
                    <input type="text" name="nik_pewaris" placeholder="NIK Pewaris"
                        value="{{ old('nik_pewaris') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>

                <div>
                    <label class="block font-semibold mb-1">Tempat/Tgl Lahir Pewaris</label>
                    <input type="text" name="ttl_pewaris" placeholder="Contoh: Parepare, 1 Januari 1950"
                        value="{{ old('ttl_pewaris') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>

                <div>
                    <label class="block font-semibold mb-1">Tanggal Meninggal</label>
                    <input type="date" name="tanggal_meninggal"
                        value="{{ old('tanggal_meninggal') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white" />
                </div>

                <div class="md:col-span-2">
                    <label class="block font-semibold mb-1">Alamat Terakhir Pewaris</label>
                    <textarea name="alamat_pewaris" rows="2" placeholder="Alamat lengkap pewaris"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-800 bg-white">{{ old('alamat_pewaris') }}</textarea>
                </div>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold">Daftar Ahli Waris</h2>
                <button type="button" onclick="tambahAhliWaris()" 
                    class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">add</span>
                    Tambah Ahli Waris
                </button>
            </div>

            <div id="ahli-waris-container" class="space-y-4">
                <!-- Ahli Waris 1 (Default) -->
                <div class="ahli-waris-item border border-gray-300 rounded-lg p-4 bg-gray-50">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-semibold">Ahli Waris #1</h3>
                        <button type="button" onclick="hapusAhliWaris(this)" 
                            class="text-red-600 hover:text-red-800 text-sm hidden">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                            <input type="text" name="ahli_waris_nama[]" placeholder="Nama ahli waris"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">NIK</label>
                            <input type="text" name="ahli_waris_nik[]" placeholder="NIK"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Hubungan</label>
                            <input type="text" name="ahli_waris_hubungan[]" placeholder="Contoh: Anak Kandung"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Tempat/Tgl Lahir</label>
                            <input type="text" name="ahli_waris_ttl[]" placeholder="Contoh: Parepare, 1 Jan 1980"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm" />
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1">Alamat</label>
                            <input type="text" name="ahli_waris_alamat[]" placeholder="Alamat lengkap"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 flex justify-end gap-3">
            <a href="{{ route('admin.pelayanan') }}" 
                class="px-6 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-100">
                Batal
            </a>
            <button type="submit"
                class="bg-[#0A142F] text-white px-6 py-2 rounded-lg hover:bg-[#1f2a48] transition text-sm flex items-center gap-2">
                <span class="material-symbols-outlined">picture_as_pdf</span>
                Generate & Download PDF
            </button>
        </div>
    </form>
</div>

<script>
let ahliWarisCount = 1;

function tambahAhliWaris() {
    ahliWarisCount++;
    const container = document.getElementById('ahli-waris-container');
    const newItem = document.createElement('div');
    newItem.className = 'ahli-waris-item border border-gray-300 rounded-lg p-4 bg-gray-50';
    newItem.innerHTML = `
        <div class="flex justify-between items-center mb-3">
            <h3 class="font-semibold">Ahli Waris #${ahliWarisCount}</h3>
            <button type="button" onclick="hapusAhliWaris(this)" 
                class="text-red-600 hover:text-red-800 text-sm">
                <span class="material-symbols-outlined">delete</span>
            </button>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="ahli_waris_nama[]" placeholder="Nama ahli waris"
                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm" />
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">NIK</label>
                <input type="text" name="ahli_waris_nik[]" placeholder="NIK"
                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm" />
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Hubungan</label>
                <input type="text" name="ahli_waris_hubungan[]" placeholder="Contoh: Anak Kandung"
                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm" />
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tempat/Tgl Lahir</label>
                <input type="text" name="ahli_waris_ttl[]" placeholder="Contoh: Parepare, 1 Jan 1980"
                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm" />
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Alamat</label>
                <input type="text" name="ahli_waris_alamat[]" placeholder="Alamat lengkap"
                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm" />
            </div>
        </div>
    `;
    container.appendChild(newItem);
}

function hapusAhliWaris(button) {
    if (confirm('Hapus ahli waris ini?')) {
        button.closest('.ahli-waris-item').remove();
        // Update nomor urut
        document.querySelectorAll('.ahli-waris-item').forEach((item, index) => {
            item.querySelector('h3').textContent = `Ahli Waris #${index + 1}`;
        });
        ahliWarisCount = document.querySelectorAll('.ahli-waris-item').length;
    }
}
</script>
@endsection