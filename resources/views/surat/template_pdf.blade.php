<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $judul_surat }}</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 700px;
            margin: 40px auto;
            padding: 0 40px;
        }
        
        /* KOP SURAT */
        .kop-table {
            width: 100%;
            border-bottom: 3px double #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .logo-cell { width: 80px; text-align: left; vertical-align: middle; }
        .text-cell { text-align: center; vertical-align: middle; }
        .text-cell h3 { margin: 0; font-size: 16pt; text-transform: uppercase; }
        .text-cell h4 { margin: 0; font-size: 14pt; text-transform: uppercase; }
        .text-cell p { margin: 0; font-size: 10pt; }

        /* JUDUL */
        .judul-area { text-align: center; margin-bottom: 25px; }
        .judul-area h2 {
            text-decoration: underline; font-size: 14pt; margin: 0;
            text-transform: uppercase; font-weight: bold;
        }

        /* ISI */
        .isi-text { text-align: justify; line-height: 1.5; margin-bottom: 10px; }
        .data-table { width: 100%; margin: 10px 0 15px 40px; }
        .data-table td { vertical-align: top; padding: 2px 0; }

        /* --- TANDA TANGAN --- */
        .ttd-table {
            width: 100%;
            margin-top: 250px;
        }

        .ttd-cell {
            width: 60%; /* Kolom kosong sebelah kiri */
        }

        .sign-cell {
            width: 40%;
            text-align: center;
        }

        .space {
            height: 100px; /* Tambahkan sedikit ruang tinggi */
            position: relative;
            width: 100%;
        }

        .signature-img {
            /* 1. ATUR UKURAN DI SINI */
            width: 150px;      /* Ubah lebar gambar sesuai keinginan */
            height: auto;
            
            /* 2. ATUR POSISI */
            position: absolute;
            top: -10px;        /* Tarik ke atas agar sedikit menimpa teks jabatan */
            left: 50%;         /* Geser ke tengah kontainer */
            
            /* 3. TEKNIK CENTER MANUAL UNTUK PDF */
            /* Margin left harus bernilai NEGATIF SETENGAH dari Lebar Gambar (Width) */
            /* Jika width 150px, maka margin-left harus -75px */
            margin-left: -75px; 
            
            z-index: 10;
        }

        .nama-lurah {
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- KOP SURAT --}}
        <table class="kop-table">
            <tr>
                <td class="logo-cell">
                    <img src="{{ request()->is('preview-pdf-template*') ? asset('assets/logo/parepare.png') : public_path('assets/logo/parepare.png') }}" width="75">
                </td>
                <td class="text-cell">
                    <h3>Pemerintah Kota Parepare</h3>
                    <h4>Kecamatan {{ strtoupper($kelurahan->kecamatan) }}</h4>
                    <h4>Kelurahan {{ strtoupper($kelurahan->nama) }}</h4>
                    <p>{{ $alamat_kelurahan }} Kota Parepare Kode Pos {{ $kelurahan->kode_pos }}</p>
                </td>
            </tr>
        </table>

        {{-- JUDUL SURAT --}}
        <div class="judul-area">
            <h2>{{ strtoupper($judul_surat) }}</h2>
            <div style="margin-top: 5px;">Nomor: {{ $nomor_surat }}</div>
        </div>

        {{-- ISI SURAT --}}
        <div class="isi-text" style="text-indent: 45px;">
            Yang bertanda tangan di bawah ini Lurah {{ $kelurahan->nama }}, Kecamatan {{ $kelurahan->kecamatan }}, 
            Kota Parepare, dengan ini menerangkan bahwa:
        </div>

        <table class="data-table">
            @if(isset($nama))
            <tr>
                <td width="200">Nama</td>
                <td width="10">:</td>
                <td><strong>{{ $nama }}</strong></td>
            </tr>
            @endif
            
            @if(isset($nik))
            <tr><td>NIK</td><td>:</td><td>{{ $nik }}</td></tr>
            @endif
            
            @if(isset($ttl))
            <tr><td>Tempat/Tanggal Lahir</td><td>:</td><td>{{ $ttl }}</td></tr>
            @endif
            
            @if(isset($jenis_kelamin))
            <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $jenis_kelamin }}</td></tr>
            @endif
            
            @if(isset($agama))
            <tr><td>Agama</td><td>:</td><td>{{ $agama }}</td></tr>
            @endif
            
            @if(isset($warga_negara))
            <tr><td>Kewarganegaraan</td><td>:</td><td>{{ $warga_negara }}</td></tr>
            @endif
            
            @if(isset($pekerjaan))
            <tr><td>Pekerjaan</td><td>:</td><td>{{ $pekerjaan }}</td></tr>
            @endif
            
            @if(isset($alamat))
            <tr><td>Alamat</td><td>:</td><td>{{ $alamat }}</td></tr>
            @endif
            
            @if(isset($rt) && isset($rw))
            <tr><td>RT/RW</td><td>:</td><td>{{ $rt }}/{{ $rw }}</td></tr>
            @endif
        </table>

        <div class="isi-text" style="text-indent: 45px;">
            Adalah benar warga kami yang berdomisili di Kelurahan {{ $kelurahan->nama }}, 
            Kecamatan {{ $kelurahan->kecamatan }}, Kota Parepare.
        </div>

        <div class="isi-text" style="text-indent: 45px;">
            Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
        </div>

        {{-- TANDA TANGAN --}}
        <table class="ttd-table">
            <tr>
                <td class="ttd-cell"></td>
                <td class="sign-cell">
                    <div>Parepare, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                    <div style="margin-bottom: 5px;">LURAH {{ strtoupper($kelurahan->nama) }}</div>
                    
                    <div class="space">
                        @if(request()->is('preview-pdf-template*'))
                            <img src="{{ asset('signatures/bahrul_signature.png') }}" class="signature-img">
                        @endif
                    </div>

                    <div class="nama-lurah">{{ $nama_lurah }}</div>
                    <div>NIP. {{ $nip_lurah ?? '-' }}</div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>