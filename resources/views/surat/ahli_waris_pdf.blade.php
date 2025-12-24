<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan Ahli Waris</title>
    <style>
        @page {
            margin: 1.5cm 2cm 2cm 2cm;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            line-height: 1.4;
        }

        .kop-surat {
            border-bottom: 3px solid #000;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .kop-surat table {
            width: 100%;
            border-collapse: collapse;
        }

        .kop-surat td.logo {
            width: 70px;
            vertical-align: middle;
        }

        .kop-surat td.text {
            text-align: center;
            vertical-align: middle;
        }

        .kop-surat h3 { margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase; }
        .kop-surat h4 { margin: 0; font-size: 12pt; font-weight: bold; text-transform: uppercase; }
        .kop-surat p { margin: 1px 0; font-size: 9pt; }

        .judul-surat {
            text-align: center;
            margin-top: 10px;
        }

        .judul-surat h2 {
            margin: 0;
            text-decoration: underline;
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .nomor-surat {
            text-align: center;
            margin-bottom: 20px;
            font-size: 11pt;
        }

        .isi-surat {
            text-align: justify;
        }

        .isi-surat table {
            margin-left: 40px;
            margin-top: 5px;
            margin-bottom: 10px;
            width: 90%;
        }

        .isi-surat table td {
            padding: 1px 0;
            vertical-align: top;
        }

        .isi-surat table td:first-child { width: 160px; }
        .isi-surat table td:nth-child(2) { width: 15px; text-align: center; }

        .ahli-waris-item {
            margin-bottom: 15px;
            padding-left: 20px;
        }

        .ttd {
            margin-top: 40px;
            margin-left: 60%;
            text-align: center;
        }

        .ttd .nama-ttd {
            margin-top: 70px;
            text-decoration: underline;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    {{-- KOP SURAT --}}
    <div class="kop-surat">
        <table>
            <tr>
                <td class="logo">
                    <img src="{{ public_path('assets/logo/parepare.png') }}" style="width: 60px;">
                </td>
                <td class="text">
                    <h3>Pemerintah Kota Parepare</h3>
                    <h4>Kecamatan {{ strtoupper($kelurahan->kecamatan) }}</h4>
                    <h4>Kelurahan {{ strtoupper($kelurahan->nama) }}</h4>
                    <p>{{ $alamat_kelurahan }} Kode Pos {{ $kelurahan->kode_pos }}</p>
                </td>
            </tr>
        </table>
    </div>

    {{-- JUDUL & NOMOR --}}
    <div class="judul-surat">
        <h2>Surat Keterangan Ahli Waris</h2>
    </div>
    <div class="nomor-surat">
        Nomor : {{ $nomor_surat }}
    </div>

    <div class="isi-surat">
        <p>Yang bertanda tangan di bawah ini :</p>
        <table>
            <tr>
                <td>N a m a</td>
                <td>:</td>
                <td><strong>{{ $nama_lurah }}</strong></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>Lurah {{ $kelurahan->nama }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $alamat_kelurahan }} Kota Parepare</td>
            </tr>
        </table>

        <p>Dengan ini Memberikan Keterangan Kepada Saudara (i) :</p>
        
        @php
            $daftar_ahli_waris = $daftar_ahli_waris ?? [];
            if (!is_array($daftar_ahli_waris) && is_string($daftar_ahli_waris)) {
                $daftar_ahli_waris = json_decode($daftar_ahli_waris, true) ?? [];
            }
            $ahli_utama = $daftar_ahli_waris[0] ?? null;
        @endphp

        @if($ahli_utama)
        <table>
            <tr>
                <td>N a m a</td>
                <td>:</td>
                <td><strong>{{ strtoupper($ahli_utama['nama']) }}</strong></td>
            </tr>
            <tr>
                <td>Tempat Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $ahli_utama['ttl'] ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $ahli_utama['alamat'] ?? '-' }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $ahli_utama['pekerjaan'] ?? '-' }}</td>
            </tr>
        </table>
        @endif

        <p style="text-indent: 40px; margin-top: 15px;">
            Adalah benar ahli Waris dari almarhum/almarhumah <strong>"{{ strtoupper($nama_pewaris) }}"</strong> yang 
            meninggal dunia hari {{ $hari_meninggal ?? '........' }} tanggal {{ $tanggal_meninggal ?? '-' }} karena sakit dan beralamat terakhir di {{ $alamat_pewaris ?? '-' }}.
        </p>

        @if(count($daftar_ahli_waris) > 1)
        <p style="margin-top: 10px;">Adapun ahli waris lainnya adalah sebagai berikut:</p>
        <div style="margin-left: 40px;">
            @foreach($daftar_ahli_waris as $index => $ahli)
                @if($index > 0)
                <p>{{ $index }}. {{ $ahli['nama'] }} ({{ $ahli['hubungan'] }})</p>
                @endif
            @endforeach
        </div>
        @endif

        <p style="text-indent: 40px; margin-top: 15px;">
            Demikian surat keterangan ahli waris ini dibuat dengan sebenar-benarnya untuk dapat dipergunakan sebagaimana mestinya.
        </p>
    </div>

    {{-- TANDA TANGAN --}}
    <div class="ttd">
        <p>Parepare, {{ $tanggal }}</p>
        <p>LURAH {{ strtoupper($kelurahan->nama) }}</p>
        <div class="nama-ttd">({{ $nama_lurah }})</div>
    </div>
</body>
</html>