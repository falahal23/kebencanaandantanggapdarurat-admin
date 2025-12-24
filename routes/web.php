<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistribusiLogistikController;
use App\Http\Controllers\DonasiBencanaController;
use App\Http\Controllers\KejadianBencanaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogistikBencanaController;
use App\Http\Controllers\PoskoBencanaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;use Illuminate\Support\Facades\Route;

// Dashboard (opsional)
Route::get('/kejadian', [KejadianBencanaController::class, 'index']);

// Modul utama
Route::resource('kejadian', KejadianBencanaController::class);
Route::resource('posko', PoskoBencanaController::class);
Route::resource('donasi', DonasiBencanaController::class);
Route::resource('logistik', LogistikBencanaController::class);
Route::resource('distribusi', DistribusiLogistikController::class);
Route::resource('warga', WargaController::class);

//  LOGIN
Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

//  LOGOUT
// GET
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
// POST
Route::post('/logout', [LoginController::class, 'logout'])->name('logout.post');

//  REGISTER
// Tampilkan form register
Route::get('/register', [UserController::class, 'create'])->name('user.create');
// Simpan data register
Route::post('/register', [UserController::class, 'store'])->name('user.store');

//  DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//  Admin Views
Route::get('/admin.kejadian_bencana.index', [KejadianBencanaController::class, 'index'])->name('kejadian_bencana.index');
Route::get('/admin.posko_bencana.index', [PoskoBencanaController::class, 'index'])->name('posko_bencana.index');

// Media Upload
Route::post('/media/upload', [MediaController::class, 'upload'])->name('media.upload');

//  USER
Route::resource('user', UserController::class);
Route::resource('user/index', UserController::class);

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('user', UserController::class);
});

//  WARGA
Route::resource('warga', WargaController::class);

Route::get('/pages/admin/warga', [WargaController::class, 'index'])->name('pages.admin.warga.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('warga', WargaController::class);
});

//Posko Bencana
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('posko', PoskoBencanaController::class);
});
Route::get('admin/posko/{posko}/edit', [PoskoBencanaController::class, 'edit'])->name('admin.posko.edit');

//donasi bencana
Route::prefix('admin')->name('admin.')->group(function () {

    // Resource route untuk Donasi Bencana
    Route::resource('donasi', DonasiBencanaController::class);

    // Jika mau menambahkan route khusus untuk hapus media, bisa seperti ini:
    Route::delete('donasi/{donasi}/media/{media}', [DonasiBencanaController::class, 'destroyMedia'])
        ->name('donasi.media.destroy');
});

// Logistik Bencana
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('logistik_bencana', LogistikBencanaController::class);
});

// Distribusi Logistik
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('distribusi_logistik', DistribusiLogistikController::class);
});

// Dashboard hanya untuk user login
Route::get('/dashboard', [DashboardController::class, 'index'])
     ->middleware('checkislogin');

// Group route untuk beberapa halaman sekaligus
Route::group(['middleware' => ['checkislogin']], function () {
    Route::resource('user', UserController::class);
});

Route::middleware(['checkislogin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['checkrole:Super Admin'])->group(function () {
    Route::resource('/user', UserController::class);
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('checkislogin')
    ->name('dashboard');

Route::group(['middleware' => ['checkislogin', 'checkrole:Super Admin']], function () {
    Route::resource('/user', UserController::class);
});

//profile
Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');


Route::get('/admin/user/{id}', [UserController::class, 'show'])
    ->name('user.show');
