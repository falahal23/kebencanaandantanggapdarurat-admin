<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kdtController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController; // pastikan huruf besar kecilnya sesuai dengan nama file controller

// Default redirect ke halaman login
Route::get('/', function () {
    return redirect()->route('admin.login');
});

//  Halaman KDT
Route::get('/kdt', [kdtController::class, 'index']);

//  Halaman Login Admin
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');

//  Proses Login Admin
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.process');

//  Halaman Dashboard Admin
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Logout Admin
Route::get('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
