<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Reset Kata Sandi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">Reset Kata Sandi</h2>

    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
      <input type="hidden" name="email" value="{{ $email }}">

      <label class="block mb-2 text-sm font-medium text-gray-700">Kata Sandi Baru</label>
      <input type="password" name="password" required
             class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-400 mb-3">

      @error('password')
        <div class="text-red-600 text-sm mb-3">{{ $message }}</div>
      @enderror

      <label class="block mb-2 text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
      <input type="password" name="password_confirmation" required
             class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-400 mb-4">

      <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded text-sm font-semibold">
        Simpan Kata Sandi
      </button>
    </form>

    <div class="text-sm mt-4 text-center">
      <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Kembali ke Login</a>
    </div>
  </div>
</body>
</html>
