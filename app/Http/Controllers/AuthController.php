<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     * Menggunakan Auth::attempt() untuk manual authentication
     * Session akan menyimpan informasi user yang login
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        // Auth::attempt() akan otomatis mengecek password yang di-hash
        // Jika berhasil, session akan otomatis dibuat untuk user
        if (Auth::attempt($request->only('email', 'password'))) {
            // Regenerasi session untuk mencegah session fixation attack
            $request->session()->regenerate();

            // Redirect ke dashboard dengan pesan sukses
            return redirect()->route('dashboard')
                ->with('success', 'Login berhasil! Selamat datang, ' . Auth::user()->name);
        }

        // Jika gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    /**
     * Proses logout
     * Hapus session dan regenerasi token untuk keamanan
     */
    public function logout(Request $request)
    {
        // Logout user dari Auth guard
        Auth::logout();

        // Hapus session yang ada
        $request->session()->invalidate();

        // Regenerasi CSRF token untuk keamanan
        $request->session()->regenerateToken();

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
