<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lupa Kata Sandi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">Lupa Kata Sandi</h2>

    @if (session('status'))
      <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <label class="block mb-2 text-sm font-medium text-gray-700">Alamat Email</label>
      <input type="email" name="email" value="{{ old('email') }}" required autofocus
             class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-400 mb-4">

      @error('email')
        <div class="text-red-600 text-sm mb-3">{{ $message }}</div>
      @enderror

      <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded text-sm font-semibold">
        Kirim Link Reset
      </button>
    </form>

    <div class="text-sm mt-4 text-center">
      <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Kembali ke Login</a>
    </div>
  </div>
</body>
</html>
