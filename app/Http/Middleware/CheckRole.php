<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$allowedJabatan)
    {
        $pegawai = Auth::guard('pegawai')->user();

        // Jika belum login
        if (!$pegawai) {
            return redirect()->route('login')->withErrors([
                'login' => 'Silakan login terlebih dahulu.'
            ])->withInput();
        }

        // Jika jabatan tidak diizinkan
        if (!in_array($pegawai->id_jabatan, $allowedJabatan)) {
            Auth::guard('pegawai')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'login' => 'Anda tidak memiliki hak akses untuk masuk ke halaman ini.'
            ]);
        }

        return $next($request);
    }
}
