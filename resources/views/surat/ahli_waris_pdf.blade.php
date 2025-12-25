<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan Ahli Waris</title>
    <style>
    /* --- STYLE UNTUK PREVIEW DI BROWSER --- */
    @media screen {
        body {
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            padding: 40px 0;
            margin: 0;
        }

        .container {
            background-color: white;
            width: 21cm;
            min-height: 29.7cm;
            padding: 2cm;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
        }
    }

    /* --- STYLE STANDAR UNTUK PDF --- */
    @page {
        margin: 2cm;
    }

    body {
        font-family: 'Times New Roman', Times, serif;
        font-size: 12pt;
        line-height: 1.6;
        color: black;
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

    /* Ukuran logo dikembalikan ke standar awal Anda yang sudah sesuai */
    .kop-surat td.logo {
        width: 100px;
        vertical-align: middle;
    }

    .kop-surat img {
        width: 80px; /* Ukuran asli yang Anda inginkan */
        height: auto;
    }

    .kop-surat td.text {
        text-align: center;
        vertical-align: middle;
    }

    .kop-surat h3 { margin: 0; font-size: 16pt; font-weight: bold; text-transform: uppercase; }
    .kop-surat h4 { margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase; }
    .kop-surat p { margin: 2px 0; font-size: 10pt; }

    /* --- JUDUL & ISI --- */
    .judul-surat { text-align: center; margin: 30px 0 20px 0; }
    .judul-surat h2 { text-decoration: underline; font-size: 14pt; font-weight: bold; text-transform: uppercase; }
    .nomor-surat { text-align: center; margin-bottom: 30px; font-size: 11pt; }

    .isi-surat table { margin-left: 50px; margin-top: 15px; margin-bottom: 15px; }
    .isi-surat table td { padding: 3px 0; vertical-align: top; }
    .isi-surat table td:first-child { width: 200px; }

    /* --- TANDA TANGAN --- */
    .ttd {
        margin-top: 150px;
        margin-left: 60%;
        text-align: center;
    }

    .ttd-space {
        height: 60px;
        position: relative;
    }

    /* Mengatur posisi preview signature agar pas di tengah */
    @media screen {
        .ttd-space img {
            position: absolute;
            width: 300px;
            left: 50%;
            transform: translateX(-50%);
            top: -70px;
            opacity: 0.6;
        }
    }

    .nama-ttd { text-decoration: underline; font-weight: bold; text-transform: uppercase; }
    .nip { font-size: 10pt; }
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
            <p>Parepare, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>LURAH {{ strtoupper($kelurahan->nama) }}</p>
            
            <div class="ttd-space">
                @if(request()->is('preview-pdf-template*'))
                    <img src="{{ asset('signatures/bahrul_signature.png') }}" alt="Signature Preview">
                @endif
            </div>

            <div class="nama-ttd">{{ strtoupper($nama_lurah) }}</div>
            <div class="nip">NIP. {{ $nip_lurah ?? '-' }}</div>
        </div>
</body>
</html>