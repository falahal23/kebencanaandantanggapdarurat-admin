<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    KejadianBencanaController,
    PoskoBencanaController,
    DonasiBencanaController,
    LogistikBencanaController,
    DistribusiLogistikController,
    LoginController
};

// Dashboard (opsional)
Route::get('/', [KejadianBencanaController::class, 'index']);

// Modul utama
Route::resource('kejadian', KejadianBencanaController::class);
Route::resource('posko', PoskoBencanaController::class);
Route::resource('donasi', DonasiBencanaController::class);
Route::resource('logistik', LogistikBencanaController::class);
Route::resource('distribusi', DistribusiLogistikController::class);

// Menampilkan halaman login
Route::get('/admin.login', [LoginController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/admin.login', [LoginController::class, 'login'])->name('login.process');

// Logout user
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Halaman dashboard utama
Route::get('/admin.Dashboard', [KejadianBencanaController::class, 'Dashboard'])->name('Dashboard');

// show kejadian
Route::get('/kejadian/{id}', [KejadianBencanaController::class, 'show'])->name('kejadian.show');

Route::get('kejadian.destroy', [KejadianBencanaController::class, 'index'])->name('kejadian.index');
