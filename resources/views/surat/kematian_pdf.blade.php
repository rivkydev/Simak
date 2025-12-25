<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan Kematian</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: white;
            line-height: 1.5;
        }

        .container {
            width: 21cm;
            min-height: 29.7cm;
            padding: 1.5cm 2cm;
            margin: auto;
            box-sizing: border-box;
        }

        /* --- KOP SURAT --- */
        .kop-surat {
            border-bottom: 4px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-surat table {
            width: 100%;
        }

        .kop-surat td.logo-cell {
            width: 15%;
            text-align: left;
            vertical-align: middle;
        }

        .kop-surat td.text-cell {
            width: 85%;
            text-align: center;
            vertical-align: middle;
            padding-right: 10%; /* Kompensasi agar teks tepat di tengah */
        }

        .kop-surat h3 { margin: 0; font-size: 16pt; font-weight: bold; text-transform: uppercase; }
        .kop-surat h4 { margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase; }
        .kop-surat p { margin: 2px 0; font-size: 10pt; }

        /* --- ISI --- */
        .judul-surat { text-align: center; margin-top: 25px; }
        .judul-surat h2 { text-decoration: underline; font-size: 14pt; font-weight: bold; text-transform: uppercase; margin: 0; }
        .nomor-surat { text-align: center; margin-bottom: 25px; font-size: 12pt; }

        .isi-surat table { margin-left: 30px; margin-bottom: 15px; width: 100%; }
        .isi-surat table td { padding: 2px 0; vertical-align: top; }
        .isi-surat table td:first-child { width: 180px; }
        .isi-surat table td:nth-child(2) { width: 15px; }

        /* --- TANDA TANGAN --- */
        .ttd-container {
            margin-top: 40px;
            float: right;
            width: 250px;
            text-align: center;
        }

        .ttd-space {
            height: 80px;
            position: relative;
        }

        .ttd-space img {
            width: 300px;       /* Atur lebar spesifik */
            height: auto;        /* Biarkan tinggi menyesuaikan agar tidak gepeng */
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: -70px;
}

        .nama-ttd { text-decoration: underline; font-weight: bold; text-transform: uppercase; }
        .clearfix { clear: both; }
    </style>
</head>
<body>
    <div class="container">
        {{-- PROSES BASE64 LOGO --}}
        @php
            $path = public_path('assets/logo/parepare.png');
            $base64 = '';
            if (file_exists($path)) {
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
        @endphp

        {{-- KOP SURAT --}}
        <div class="kop-surat">
            <table>
                <tr>
                    <td class="logo-cell">
                        @if($base64)
                            <img src="{{ $base64 }}" width="70">
                        @endif
                    </td>
                    <td class="text-cell">
                        <h3>Pemerintah Kota Parepare</h3>
                        <h4>Kecamatan {{ strtoupper($kelurahan->kecamatan) }}</h4>
                        <h4>Kelurahan {{ strtoupper($kelurahan->nama) }}</h4>
                        <p>{{ $alamat_kelurahan }} Kode Pos {{ $kelurahan->kode_pos }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="judul-surat">
            <h2>Surat Keterangan Kematian</h2>
        </div>
        <div class="nomor-surat">Nomor : {{ $nomor_surat }}</div>

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

            <p>Berdasarkan Surat Pengantar RT {{ $rt ?? '...' }} / RW {{ $rw ?? '...' }}, Kelurahan {{ $kelurahan->nama }} Kecamatan {{ $kelurahan->kecamatan }} Kota Parepare Nomor: {{ $nomor_pengantar ?? '..../..../2025' }} tanggal {{ $tanggal_pengantar ?? '.........' }}, dengan ini menerangkan bahwa:</p>

            <table>
                <tr><td>Nama</td><td>:</td><td><strong>{{ $nama }}</strong></td></tr>
                <tr><td>Tempat, Tanggal Lahir</td><td>:</td><td>{{ $ttl ?? '-' }}</td></tr>
                <tr><td>No. Kartu Keluarga</td><td>:</td><td>{{ $no_kk ?? '-' }}</td></tr>
                <tr><td>NIK</td><td>:</td><td>{{ $nik ?? '-' }}</td></tr>
                <tr><td>Pekerjaan</td><td>:</td><td>{{ $pekerjaan ?? '-' }}</td></tr>
                <tr><td>Alamat</td><td>:</td><td>{{ $alamat ?? '-' }}</td></tr>
            </table>

            <p>Telah meninggal dunia pada:</p>
            <table>
                <tr><td>Hari / Tanggal</td><td>:</td><td>{{ $hari_kematian ?? '-' }} / {{ $tanggal_kematian ?? '-' }}</td></tr>
                <tr><td>Jam</td><td>:</td><td>{{ $jam_kematian ?? '-' }}</td></tr>
                <tr><td>Tempat Meninggal</td><td>:</td><td>{{ $tempat_kematian ?? '-' }}</td></tr>
            </table>

            <p style="margin-top: 15px;">Demikian surat keterangan ini dibuat <strong>untuk keperluan pengurusan akta kematian</strong>.</p>
        </div>

        {{-- TANDA TANGAN --}}
        <div class="ttd-container">
            <p>Parepare, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>LURAH {{ strtoupper($kelurahan->nama) }}</p>
            
            <div class="ttd-space">
                {{-- Preview TTD jika ada --}}
                @if(request()->is('preview-pdf-template*'))
                    <img src="{{ asset('signatures/bahrul_signature.png') }}">
                @endif
            </div>

            <div class="nama-ttd">{{ strtoupper($nama_lurah) }}</div>
            <div class="nip">NIP. {{ $nip_lurah ?? '-' }}</div>
        </div>
        <div class="clearfix"></div>
    </div>
</body>
</html>