<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan Kematian</title>
    <style>
        @page {
            margin: 1.5cm 2cm 2cm 2cm;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt; /* Menyesuaikan kepadatan teks di gambar */
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

        .kop-surat h3 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .kop-surat h4 {
            margin: 0;
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .kop-surat p {
            margin: 1px 0;
            font-size: 9pt;
        }

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
            font-weight: bold;
            font-size: 11pt;
        }

        .isi-surat {
            text-align: justify;
        }

        /* TABEL IDENTITAS (EFEK TAB 1x/2x) */
        .isi-surat table {
            margin-left: 60px; /* Memberikan efek TAB */
            margin-top: 5px;
            margin-bottom: 10px;
            width: 90%;
        }

        .isi-surat table td {
            padding: 1px 0;
            vertical-align: top;
        }

        .isi-surat table td:first-child {
            width: 180px; /* Lebar kolom label */
        }

        .isi-surat table td:nth-child(2) {
            width: 15px;
            text-align: center;
        }

        .ttd {
            margin-top: 30px;
            margin-left: 60%;
        }

        .ttd .nama-ttd {
            margin-top: 60px;
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
        <h2>Surat Keterangan Kematian</h2>
    </div>
    <div class="nomor-surat">
        Nomor : {{ $nomor_surat }}
    </div>

    <div class="isi-surat">
        <p>Saya yang bertandatangan dibawah ini:</p>
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

        <p>Berdasarkan Surat Pengantar RT {{ $rt ?? '...' }} / RW {{ $rw ?? '...' }}, Kelurahan {{ $kelurahan->nama }} Kecamatan {{ $kelurahan->kecamatan }} Kota Parepare Nomor: {{ $nomor_pengantar ?? '..../..../2025' }} tanggal {{ $tanggal_pengantar ?? '.........' }}, dengan ini menerangkan bahwa :</p>

        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><strong>{{ $nama }}</strong></td>
            </tr>
            <tr>
                <td>Tempat dan tanggal lahir</td>
                <td>:</td>
                <td>{{ $ttl ?? '-' }}</td>
            </tr>
            <tr>
                <td>No. Kartu Keluarga</td>
                <td>:</td>
                <td>{{ $no_kk ?? '-' }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $nik ?? '-' }}</td>
            </tr>
            <tr>
                <td>Kebangsaan</td>
                <td>:</td>
                <td>{{ $warga_negara ?? 'Indonesia' }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $pekerjaan ?? '-' }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>{{ $agama ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $alamat ?? '-' }}</td>
            </tr>
        </table>

        <p>Telah meninggal dunia pada:</p>
        <table>
            <tr>
                <td>Hari</td>
                <td>:</td>
                <td>{{ $hari_kematian ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ $tanggal_kematian ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jam</td>
                <td>:</td>
                <td>{{ $jam_kematian ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tempat meninggal</td>
                <td>:</td>
                <td>{{ $tempat_kematian ?? '-' }}</td>
            </tr>
        </table>

        <p style="margin-top: 15px;">
            Demikian surat keterangan ini dibuat <strong>untuk keperluan pengurusan akta kematian</strong>.
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