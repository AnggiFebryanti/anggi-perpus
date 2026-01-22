<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;

/*
|--------------------------------------------------------------------------
| ROUTES TAMU (GUEST)
|--------------------------------------------------------------------------
| Routes yang bisa diakses tanpa login (misal: halaman login)
|--------------------------------------------------------------------------
*/

// Redirect root ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Tampilkan halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

/*
|--------------------------------------------------------------------------
| ROUTES YANG MEMBUTUHKAN AUTHENTICATION
|--------------------------------------------------------------------------
| Routes ini menggunakan middleware 'auth' untuk memastikan user sudah login
| Middleware 'auth' berfungsi seperti "satpam" yang mencegah akses tanpa login
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes untuk Kategori (CRUD lengkap)
    Route::resource('categories', CategoryController::class);

    // Routes untuk Buku (CRUD lengkap dengan upload)
    Route::resource('books', BookController::class);

    // Routes untuk Peminjaman (Transaksi)
    Route::resource('loans', LoanController::class);

    // Logout (harus di dalam group auth karena butuh session yang valid)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| CATATAN UNTUK PRESENTASI:
|--------------------------------------------------------------------------
1. Middleware 'auth':
   - Memeriksa apakah user sudah login
   - Jika belum login, redirect ke halaman login
   - Jika sudah login, izinkan akses ke route tersebut

2. Konsep Session:
   - Saat login berhasil, Laravel menyimpan informasi user di session
   - Session ini tersimpan di server dan bisa diakses di request berikutnya
   - Saat logout, session dihapus untuk keamanan
|--------------------------------------------------------------------------
*/
