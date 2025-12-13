<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SIMAK')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body class="bg-white font-sans">
    @if(Auth::guard('pegawai')->check())
        @php
            $jabatan = Auth::guard('pegawai')->user()->id_jabatan;
        @endphp

        @if($jabatan == 1)
            @include('components.navAdmin')
        @elseif(in_array($jabatan, [2, 3]))
            @include('components.navLurah')
        @else
            @include('components.navbar')
        @endif
    @else
        @include('components.navbar')
        @include('components.footer')
    @endif

</body>

</html>