<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kdtController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route ::get('/kdt',[kdtController::class,'index']);

// Route untuk menampilkan halaman login
Route::get('/auth', [AuthController::class, 'index'])->name('login');

// Route untuk memproses form login
Route::post('/auth/login', [AuthController::class, 'login']);

// Route untuk halaman sukses setelah login (halaman dashboard)
Route::get('/dashboard', function () {
    if (!session('success')) {
        return redirect()->route('login');
    }
    return view('dashboard');
})->name('dashboard');

// Arahkan halaman utama ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

