<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Login - SIMAK</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .bg-overlay::before {
      content: '';
      position: absolute;
      inset: 0;
      background-color: rgba(255, 255, 255, 0.6);
      z-index: 0;
    }
  </style>
</head>

<body class="relative min-h-screen flex items-center justify-center px-4 py-8 bg-cover bg-center bg-no-repeat bg-overlay"
  style="background-image: url('{{ asset('assets/bg/monumen.png') }}');">

  <div class="relative z-10 w-full max-w-4xl shadow-2xl rounded-3xl overflow-hidden flex flex-col md:flex-row">

    <!-- Kiri -->
    <div class="bg-gradient-to-br from-blue-600 to-blue-400 text-white p-6 sm:p-8 md:p-10 md:w-1/2 w-full flex flex-col justify-between">
      <div>
        <a href="{{ route('home') }}"
          class="inline-flex items-center gap-2 mb-6 text-white hover:underline text-sm">
          ← Kembali ke Beranda
        </a>
        <h2 class="text-2xl sm:text-3xl font-bold mb-2">Hi,</h2>
        <h3 class="text-xl sm:text-2xl font-bold mb-4">Selamat Datang Di SIMAK</h3>
        <p class="text-sm text-white/80">Silahkan masuk untuk melanjutkan ke sistem.</p>
      </div>
    </div>

    <!-- Kanan -->
    <div class="bg-white/90 backdrop-blur-sm p-6 sm:p-8 md:p-10 md:w-1/2 w-full">
      <div class="flex justify-center gap-4 mb-6 flex-wrap">
        <img src="{{ asset('assets/logo/parepare.png') }}" alt="Logo Parepare" class="h-10 sm:h-12 w-auto">
        <img src="{{ asset('assets/logo/ith.png') }}" alt="Logo ITH" class="h-10 sm:h-12 w-auto">
      </div>

      @if(session('status'))
      <div class="mb-4 text-green-700 bg-green-100 px-4 py-2 rounded-md text-sm">
        {{ session('status') }}
      </div>
      @endif

      <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <input name="login" type="text" placeholder="Email atau NIP"
          value="{{ old('login') }}"
          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm"
          required>

        <input name="password" type="password" placeholder="Password"
          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none text-sm"
          required>

        <div class="flex justify-between items-center text-sm">
          <label class="flex items-center gap-2">
            <input type="checkbox" name="remember" class="rounded text-blue-600">
            <span class="text-gray-600">Ingat Saya</span>
          </label>
          <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Lupa Password?</a>
        </div>

        @if ($errors->has('login'))
        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md shadow-sm text-sm">
          <strong class="font-semibold">Terjadi kesalahan:</strong>
          <div class="mt-2 space-y-1">
            <div class="flex items-start gap-2">
              <svg class="w-4 h-4 mt-1 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-9-4a1 1 0 012 0v4a1 1 0 01-2 0V6zm1 8a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" clip-rule="evenodd" />
              </svg>
              <span>{{ $errors->first('login') }}</span>
            </div>
          </div>
        </div>
        @endif



        <button type="submit"
          class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition text-sm">
          Login
        </button>
      </form>

    </div>

  </div>

</body>

</html>