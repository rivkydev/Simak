<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan Ahli Waris</title>
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

        .ahli-waris-list {
            margin-left: 70px;
            margin-top: 10px;
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
        <h2>Surat Keterangan Ahli Waris</h2>
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

        <p style="margin-left: 50px; margin-top: 15px; margin-bottom: 10px;">
            <strong>Yang Meninggal Dunia:</strong>
        </p>

        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><strong>{{ $nama_pewaris }}</strong></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $nik_pewaris ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $ttl_pewaris ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal Meninggal</td>
                <td>:</td>
                <td>{{ $tanggal_meninggal ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat Terakhir</td>
                <td>:</td>
                <td>{{ $alamat_pewaris ?? '-' }}</td>
            </tr>
        </table>

        <p style="text-indent: 50px; margin-top: 20px;">
            Meninggalkan ahli waris yang sah menurut hukum, yaitu:
        </p>

        <div class="ahli-waris-list">
            @php
                $daftar_ahli_waris = $daftar_ahli_waris ?? [];
                if (!is_array($daftar_ahli_waris) && is_string($daftar_ahli_waris)) {
                    $daftar_ahli_waris = json_decode($daftar_ahli_waris, true) ?? [];
                }
            @endphp
            
            @if(count($daftar_ahli_waris) > 0)
                @foreach($daftar_ahli_waris as $index => $ahli)
                    <p style="margin-bottom: 15px;">
                        <strong>{{ $index + 1 }}. {{ $ahli['nama'] ?? '-' }}</strong><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;NIK: {{ $ahli['nik'] ?? '-' }}<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Hubungan: {{ $ahli['hubungan'] ?? '-' }}<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Tempat/Tgl Lahir: {{ $ahli['ttl'] ?? '-' }}<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Alamat: {{ $ahli['alamat'] ?? '-' }}
                    </p>
                @endforeach
            @else
                <p><em>Data ahli waris belum tersedia</em></p>
            @endif
        </div>

        <p style="text-indent: 50px; margin-top: 20px;">
            Demikian surat keterangan ini dibuat dengan sebenarnya berdasarkan keterangan yang dapat dipertanggungjawabkan, 
            untuk dapat dipergunakan sebagaimana mestinya.
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