<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan Domisili Usaha</title>
    <style>
        /* Pengaturan Kertas Langsung ke DomPDF */
        @page {
            margin: 0; /* Kita atur margin lewat container agar lebih terkontrol */
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        .container {
            width: 700px; /* Ukuran aman untuk A4 agar tidak terpotong kanan */
            margin: 40px auto;
            padding: 0 40px;
        }

        /* --- KOP SURAT --- */
        .kop-table {
            width: 100%;
            border-bottom: 3px double #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .logo-cell {
            width: 80px;
            text-align: left;
            vertical-align: middle;
        }

        .text-cell {
            text-align: center;
            vertical-align: middle;
        }

        .text-cell h3 { margin: 0; font-size: 16pt; text-transform: uppercase; }
        .text-cell h4 { margin: 0; font-size: 14pt; text-transform: uppercase; }
        .text-cell p { margin: 0; font-size: 10pt; }

        /* --- JUDUL --- */
        .judul-area {
            text-align: center;
            margin-bottom: 30px;
        }
        .judul-area h2 {
            text-decoration: underline;
            font-size: 14pt;
            margin-bottom: 0;
            text-transform: uppercase;
        }

        /* --- ISI --- */
        .isi-text {
            text-align: justify;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .data-table {
            width: 100%;
            margin: 15px 0 15px 40px; /* Indentasi tabel data */
        }

        .data-table td {
            vertical-align: top;
            padding: 4px 0;
        }

        /* --- TANDA TANGAN --- */
        .ttd-table {
            width: 100%;
            margin-top: 200px;
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
        <table class="kop-table">
            <tr>
                <td class="logo-cell">
                    <img src="{{ request()->is('preview-pdf-template*') ? asset('assets/logo/parepare.png') : public_path('assets/logo/parepare.png') }}" width="75">
                </td>
                <td class="text-cell">
                    <h3>PEMERINTAH KOTA PAREPARE</h3>
                    <h4>KECAMATAN {{ strtoupper($kelurahan->kecamatan) }}</h4>
                    <h4>KELURAHAN {{ strtoupper($kelurahan->nama) }}</h4>
                    <p>{{ $alamat_kelurahan }} Kota Parepare Kode Pos {{ $kelurahan->kode_pos }}</p>
                </td>
            </tr>
        </table>

        <div class="judul-area">
            <h2>SURAT KETERANGAN DOMISILI USAHA</h2>
            <div>Nomor: {{ $nomor_surat }}</div>
        </div>

        <div class="isi-text" style="text-indent: 45px;">
            Yang bertanda tangan di bawah ini Lurah {{ $kelurahan->nama }}, Kecamatan {{ $kelurahan->kecamatan }}, Kota Parepare, dengan ini menerangkan bahwa:
        </div>

        <table class="data-table">
            <tr>
                <td width="180">Nama Perusahaan</td>
                <td width="10">:</td>
                <td><strong>{{ $nama_perusahaan }}</strong></td>
            </tr>
            <tr>
                <td>Nama Penanggung Jawab</td>
                <td>:</td>
                <td><strong>{{ $penanggung_jawab }}</strong></td>
            </tr>
            <tr>
                <td>Alamat Usaha</td>
                <td>:</td>
                <td>{{ $alamat_perusahaan }}</td>
            </tr>
        </table>

        <div class="isi-text" style="text-indent: 45px;">
            Adalah benar berdomisili di wilayah Kelurahan {{ $kelurahan->nama }}, Kecamatan {{ $kelurahan->kecamatan }}, Kota Parepare, dan menjalankan usaha di alamat tersebut di atas.
        </div>

        <div class="isi-text" style="text-indent: 45px;">
            Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
        </div>

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