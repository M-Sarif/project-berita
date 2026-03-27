<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;

Route::get('/home', function () {
    return view('home');
});

Route::get('/navbar', function () {
    return view('navbar');
});

Route::get('/footer', function () {
    return view('footer');
});

// Menggunakan controller utama (di luar folder admin)
Route::get('/berita', [BeritaController::class, 'index']);

// ─── Admin Login ─────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Login (hanya bisa diakses jika belum login)
    Route::middleware('guest')->group(function () {
        Route::get('/', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman yang butuh autentikasi admin
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Menggunakan alias 'AdminBeritaController' agar tidak bentrok
        Route::resource('berita', AdminBeritaController::class);

        // Update status berita (publish/draft) menggunakan alias
        Route::patch('/berita/{berita}/status', [AdminBeritaController::class, 'updateStatus'])
            ->name('berita.status');
    });
});
