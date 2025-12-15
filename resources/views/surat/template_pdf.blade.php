<!DOCTYPE html>
<html>
<head>
    <title>{{ $judul_surat }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; }
        .header { text-align: center; font-weight: bold; border-bottom: 2px solid black; padding-bottom: 10px; margin-bottom: 20px; }
        .content { margin-bottom: 30px; }
        .ttd { float: right; width: 30%; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        PEMERINTAH KOTA PAREPARE<br>
        KECAMATAN ... KELURAHAN ...<br>
        Jl. ... No. ...
    </div>

    <div style="text-align: center; font-weight: bold; text-decoration: underline;">
        {{ strtoupper($judul_surat) }}
    </div>
    <div style="text-align: center; margin-bottom: 20px;">
        Nomor: {{ $nomor_surat }}/.../...
    </div>

    <div class="content">
        <p>Yang bertanda tangan di bawah ini Lurah ..., menerangkan bahwa:</p>
        <table>
            <tr><td>Nama</td><td>: {{ $nama }}</td></tr>
            {{-- Tambahkan field lain sesuai kebutuhan --}}
        </table>
        <p>Adalah benar warga kami...</p>
    </div>

    <div class="ttd">
        Parepare, {{ $tanggal }}<br>
        Lurah,<br><br><br><br>
        <b>{{ $nama_lurah ?? 'Nama Lurah' }}</b>
    </div>
</body>
</html>