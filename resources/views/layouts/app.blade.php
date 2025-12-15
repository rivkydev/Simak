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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Cek apakah ada session "success" dari Controller
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000 // Pop up akan hilang otomatis dalam 2 detik
            });
        @endif

        // Cek apakah ada session "error" (Opsional, untuk jaga-jaga)
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33',
                confirmButtonText: 'Tutup'
            });
        @endif
    </script>
</body>
</html>