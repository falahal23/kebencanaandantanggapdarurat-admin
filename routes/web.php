<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    KejadianBencanaController,
    PoskoBencanaController,
    DonasiBencanaController,
    LogistikBencanaController,
    DistribusiLogistikController,
    LoginController,
    DashboardController,
    UserController,
    WargaController
};

// Dashboard (opsional)


Route::get('/kejadian', [KejadianBencanaController::class, 'index']);

// Modul utama
Route::resource('kejadian', KejadianBencanaController::class);
Route::resource('posko', PoskoBencanaController::class);
Route::resource('donasi', DonasiBencanaController::class);
Route::resource('logistik', LogistikBencanaController::class);
Route::resource('distribusi', DistribusiLogistikController::class);
Route::resource('warga', WargaController::class);


// Menampilkan halaman login
Route::get('/', [LoginController::class, 'index'])->name('login.index');
// Proses login
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
//Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Tampilkan form register
Route::get('/register', [UserController::class, 'create'])->name('user.create');

// Proses simpan data register
Route::post('/register', [UserController::class, 'store'])->name('user.store');

// Logout user
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

// Halaman index kejadian bencana
Route::get('/admin.kejadian_bencana.index', [KejadianBencanaController::class, 'index'])->name('kejadian_bencana.index');

//Halaman index posko Bencana
Route::get('/admin.posko_bencana.index', [KejadianBencanaController::class, 'index'])->name('posko_bencana.index');

//

// Media Upload
Route::post('/media/upload', [MediaController::class, 'upload'])->name('media.upload');

//user
route:: resource('user', UserController::class);

route:: resource('user/index', UserController::class);

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('user', UserController::class);
});


//warga
Route::resource('warga', WargaController::class);

Route::get('/pages/admin/warga', [WargaController::class, 'index'])->name('pages.admin.warga.index');


Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('warga', WargaController::class);
});


