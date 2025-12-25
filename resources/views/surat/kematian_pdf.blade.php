<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan Kematian</title>
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
            margin: 30px auto; /* Margin atas dikurangi sedikit agar muat */
            padding: 0 40px;
        }
        
        /* KOP SURAT */
        .kop-table {
            width: 100%;
            border-bottom: 3px double #000;
            margin-bottom: 10px; /* Jarak diperpadat */
            padding-bottom: 5px;
        }
        .logo-cell { width: 80px; text-align: left; vertical-align: middle; }
        .text-cell { text-align: center; vertical-align: middle; }
        .text-cell h3 { margin: 0; font-size: 16pt; text-transform: uppercase; }
        .text-cell h4 { margin: 0; font-size: 14pt; text-transform: uppercase; }
        .text-cell p { margin: 0; font-size: 10pt; }

        /* JUDUL */
        .judul-area { text-align: center; margin-bottom: 15px; } /* Jarak diperpadat */
        .judul-area h2 {
            text-decoration: underline; font-size: 14pt; margin: 0;
            text-transform: uppercase; font-weight: bold;
        }

        /* ISI */
        .isi-text { text-align: justify; line-height: 1.3; margin-bottom: 5px; } /* Line height & margin diperpadat */
        
        .data-table { width: 100%; margin: 5px 0 10px 40px; } /* Margin tabel diperpadat */
        .data-table td { vertical-align: top; padding: 1px 0; } /* Padding baris diperpadat */
        
        /* --- TANDA TANGAN (TIDAK DIUBAH SAMA SEKALI) --- */
        .ttd-table {
            width: 100%;
            margin-top: 210px; /* TETAP SESUAI REQUEST */
        }

        .ttd-cell {
            width: 60%; 
        }

        .sign-cell {
            width: 40%;
            text-align: center;
        }

        .space {
            height: 100px; 
            position: relative;
            width: 100%;
        }

        .signature-img {
            width: 150px;     
            height: auto;
            position: absolute;
            top: -10px;      
            left: 50%;       
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

        {{-- JUDUL --}}
        <div class="judul-area">
            <h2>Surat Keterangan Kematian</h2>
            <div>Nomor: {{ $nomor_surat }}</div>
        </div>

        <div class="isi-text">
            Saya yang bertandatangan dibawah ini:
        </div>

        <table class="data-table">
            <tr>
                <td width="160">Nama</td>
                <td width="10">:</td>
                <td><strong>{{ $nama_lurah }}</strong></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>Lurah {{ $kelurahan->nama }}</td>
            </tr>
        </table>

        <div class="isi-text">
            Berdasarkan Surat Pengantar RT {{ $rt ?? '...' }} / RW {{ $rw ?? '...' }}, Kelurahan {{ $kelurahan->nama }} Kecamatan {{ $kelurahan->kecamatan }} Kota Parepare Nomor: {{ $nomor_pengantar ?? '....' }} tanggal {{ $tanggal_pengantar ?? '.........' }}, dengan ini menerangkan bahwa:
        </div>

        <table class="data-table">
            <tr><td width="160">Nama</td><td width="10">:</td><td><strong>{{ $nama }}</strong></td></tr>
            <tr><td>Tempat, Tanggal Lahir</td><td>:</td><td>{{ $ttl ?? '-' }}</td></tr>
            <tr><td>Pekerjaan</td><td>:</td><td>{{ $pekerjaan ?? '-' }}</td></tr>
            <tr><td>Alamat</td><td>:</td><td>{{ $alamat ?? '-' }}</td></tr>
        </table>

        <div class="isi-text">
            Telah meninggal dunia pada:
        </div>

        <table class="data-table">
            <tr><td width="160">Hari / Tanggal</td><td width="10">:</td><td>{{ $hari_kematian ?? '-' }} / {{ $tanggal_kematian ?? '-' }}</td></tr>
            <tr><td>Jam</td><td>:</td><td>{{ $jam_kematian ?? '-' }}</td></tr>
            <tr><td>Tempat Meninggal</td><td>:</td><td>{{ $tempat_kematian ?? '-' }}</td></tr>
        </table>

        <div class="isi-text">
            Demikian surat keterangan ini dibuat untuk keperluan pengurusan akta kematian.
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