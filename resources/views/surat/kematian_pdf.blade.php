<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan Kematian</title>
    <style>
        @page {
            margin: 2cm 2cm 2cm 2cm;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
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
            width: 100px;
            vertical-align: middle;
        }

        .kop-surat td.text {
            text-align: center;
            vertical-align: middle;
        }

        .kop-surat img {
            width: 80px;
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
            margin: 30px 0 20px 0;
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
            margin-bottom: 30px;
            font-size: 11pt;
        }

        .isi-surat {
            text-align: justify;
            margin-bottom: 30px;
        }

        .isi-surat table {
            margin-left: 50px;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .isi-surat table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .isi-surat table td:first-child {
            width: 200px;
        }

        .isi-surat table td:nth-child(2) {
            width: 20px;
            text-align: center;
        }

        .ttd {
            margin-top: 50px;
            margin-left: 60%;
        }

        .ttd .nama-ttd {
            margin-top: 80px;
            text-decoration: underline;
            font-weight: bold;
        }

        .ttd .nip {
            font-size: 10pt;
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
        <h2>Surat Keterangan Kematian</h2>
    </div>

    {{-- NOMOR SURAT --}}
    <div class="nomor-surat">
        Nomor: {{ $nomor_surat }}
    </div>

    {{-- ISI SURAT --}}
    <div class="isi-surat">
        <p style="text-indent: 50px;">
            Yang bertanda tangan di bawah ini Lurah {{ $kelurahan->nama }}, Kecamatan {{ $kelurahan->kecamatan }}, 
            Kota Parepare, dengan ini menerangkan bahwa:
        </p>

        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><strong>{{ $nama }}</strong></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $nik ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
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
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $alamat ?? '-' }}</td>
            </tr>
        </table>

        <p style="text-indent: 50px;">
            Telah meninggal dunia pada:
        </p>

        <table>
            <tr>
                <td>Hari/Tanggal</td>
                <td>:</td>
                <td><strong>{{ $hari_kematian ?? '-' }}, {{ $tanggal_kematian ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td>Tempat Meninggal</td>
                <td>:</td>
                <td>{{ $tempat_kematian ?? '-' }}</td>
            </tr>
            <tr>
                <td>Penyebab Kematian</td>
                <td>:</td>
                <td>{{ $penyebab_kematian ?? '-' }}</td>
            </tr>
        </table>

        <p style="text-indent: 50px;">
            Surat keterangan ini dibuat berdasarkan laporan dari:
        </p>

        <table>
            <tr>
                <td>Nama Pelapor</td>
                <td>:</td>
                <td><strong>{{ $nama_pelapor }}</strong></td>
            </tr>
            <tr>
                <td>NIK Pelapor</td>
                <td>:</td>
                <td>{{ $nik_pelapor ?? '-' }}</td>
            </tr>
            <tr>
                <td>Hubungan dengan Almarhum/ah</td>
                <td>:</td>
                <td>{{ $hubungan ?? '-' }}</td>
            </tr>
        </table>

        <p style="text-indent: 50px;">
            Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
        </p>
    </div>

    {{-- TANDA TANGAN --}}
    <div class="ttd">
        <p>Parepare, {{ $tanggal }}</p>
        <p>LURAH {{ strtoupper($kelurahan->nama) }}</p>
        <p class="nama-ttd">{{ $nama_lurah }}</p>
        <p class="nip">NIP. {{ $nip_lurah }}</p>
    </div>
</body>
</html>