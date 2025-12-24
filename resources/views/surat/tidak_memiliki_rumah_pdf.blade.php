<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan Belum Memiliki Rumah</title>
    <style>
        @page {
            margin: 2cm 2cm 2cm 2cm;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        .kop-surat {
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-surat table {
            width: 100%;
            border-collapse: collapse;
        }

        .kop-surat td.logo {
            width: 80px;
            vertical-align: middle;
        }

        .kop-surat td.text {
            text-align: center;
            vertical-align: middle;
        }

        .kop-surat img {
            width: 70px;
            height: auto;
        }

        .kop-surat h3 {
            margin: 0;
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .kop-surat h4 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .kop-surat p {
            margin: 2px 0;
            font-size: 10pt;
        }

        .judul-surat {
            text-align: center;
            margin: 20px 0 5px 0;
        }

        .judul-surat h2 {
            margin: 0;
            text-decoration: underline;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .nomor-surat {
            text-align: center;
            margin-bottom: 25px;
            font-size: 11pt;
        }

        .isi-surat {
            text-align: justify;
        }

        .isi-surat table {
            margin-left: 50px;
            margin-top: 10px;
            margin-bottom: 15px;
            width: 100%;
        }

        .isi-surat table td {
            padding: 2px 0;
            vertical-align: top;
        }

        .isi-surat table td:first-child {
            width: 160px;
        }

        .isi-surat table td:nth-child(2) {
            width: 20px;
            text-align: center;
        }

        .ttd {
            margin-top: 40px;
            margin-left: 60%;
            text-align: left;
        }

        .ttd .nama-ttd {
            margin-top: 70px;
            text-decoration: underline;
            font-weight: bold;
            margin-bottom: 0;
        }

        .ttd .nip {
            margin-top: 0;
            font-size: 11pt;
        }

        .isi-surat table {
    /* Gunakan 60px untuk 1x Tab atau 100px-120px untuk 2x Tab */
    margin-left: 120px; 
    margin-top: 10px;
    margin-bottom: 15px;
    width: auto; /* Ubah ke auto agar tabel tidak melebar ke kanan secara paksa */
}

.isi-surat table td {
    padding: 2px 0;
    vertical-align: top;
}

/* Sesuaikan lebar kolom label agar titik dua (:) sejajar rapi */
.isi-surat table td:first-child {
    width: 140px; 
}
    </style>
</head>
<body>
    {{-- KOP SURAT --}}
    <div class="kop-surat">
        <table>
            <tr>
                <td class="logo">
                    <img src="{{ public_path('assets/logo/parepare.png') }}" alt="Logo">
                </td>
                <td class="text">
                    <h3>Pemerintah Kota Parepare</h3>
                    <h4>Kecamatan {{ strtoupper($kelurahan->kecamatan) }}</h4>
                    <h4>Kelurahan {{ strtoupper($kelurahan->nama) }}</h4>
                    <p>{{ $alamat_kelurahan }} Kota Parepare Kode Pos {{ $kelurahan->kode_pos }}</p>
                </td>
            </tr>
        </table>
    </div>

    {{-- JUDUL SURAT --}}
    <div class="judul-surat">
        <h2>Surat Keterangan Belum Memiliki Rumah</h2>
    </div>

    {{-- NOMOR SURAT --}}
    <div class="nomor-surat">
        Nomor: {{ $nomor_surat }}
    </div>

    {{-- ISI SURAT --}}
    {{-- ISI SURAT --}}
    <div class="isi-surat">
        <p style="text-indent: 50px; margin-bottom: 5px;">
            Yang bertanda tangan dibawah ini:
        </p>

        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><strong>{{ $nama_lurah }}</strong></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>Lurah {{ $kelurahan->nama }}</td>
            </tr>
        </table>

        <p style="text-indent: 50px; margin-bottom: 5px;">
            Dengan ini menerangkan bahwa :
        </p>

        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><strong>{{ $nama }}</strong></td>
            </tr>
            <tr>
                <td>Tempat/Tgl Lahir</td>
                <td>:</td>
                <td>{{ $ttl ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $jenis_kelamin ?? '-' }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>{{ $agama ?? '-' }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $pekerjaan ?? '-' }}</td>
            </tr>
            <tr>
                <td>Kewarganegaraan</td>
                <td>:</td>
                <td>{{ $warga_negara ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $alamat ?? '-' }}</td>
            </tr>
        </table>

        <p style="text-indent: 50px;">
            Berdasarkan Surat Pernyataan yang bersangkutan dengan melampirkan Surat Pengantar Ketua RT/RW, 
            Selanjutnya diterangkan bahwa yang bersangkutan benar belum memiliki rumah.
        </p>

        <p style="text-indent: 50px;">
            Demikian Surat Keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
        </p>
    </div>

    {{-- TANDA TANGAN --}}
    <div class="ttd">
        <p>Parepare, {{ $tanggal }}</p>
        <p>LURAH {{ strtoupper($kelurahan->nama) }}</p>
        <div class="nama-ttd">{{ $nama_lurah }}</div>
        <div class="nip">NIP. {{ $nip_lurah }}</div>
    </div>
</body>
</html>