<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $login_type = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'nip';

        if (Auth::guard('pegawai')->attempt([
            $login_type => $credentials['login'],
            'password' => $credentials['password'],
        ])) {
            $request->session()->regenerate();

            $pegawai = Auth::guard('pegawai')->user();

            // Redirect berdasarkan jabatan
            if (in_array($pegawai->id_jabatan, [2, 3])) {
                return redirect()->route('pegawai.dashboard');
            } elseif ($pegawai->id_jabatan == 1) {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::guard('pegawai')->logout();
                return redirect()->route('login')->withErrors([
                    'login' => 'Anda tidak memiliki hak akses.',
                ]);
            }
        }

        return back()->withErrors([
            'login' => 'Email/NIP atau password salah',
        ])->withInput();
    }

    public function showForgotForm()
    {
        return view('auth.forgot');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $token = Str::random(64);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        $resetLink = url("/reset-password/{$token}?email=" . urlencode($request->email));

        // Kirim via SMTP Brevo
        Mail::raw("Klik link berikut untuk reset password: $resetLink", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Reset Kata Sandi - Sistem Manajemen Kelurahan');
        });

        return back()->with('status', 'Link reset dikirim ke email Anda.');
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $check = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$check || Carbon::parse($check->created_at)->addMinutes(60)->isPast()) {
            return back()->withErrors(['email' => 'Token reset tidak valid atau telah kedaluwarsa']);
        }

        DB::table('user')->where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Password berhasil direset. Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
