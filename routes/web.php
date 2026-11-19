<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\AreaParkirController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\TransaksiController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\RekapController;

// Halaman awal langsung diarahkan ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Autentikasi (Login & Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ================= ADMIN =================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
   Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('tarif', TarifController::class);
    Route::resource('area', AreaParkirController::class);
    Route::resource('kendaraan', KendaraanController::class);
    Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log.index');
});

// ================= PETUGAS =================
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/masuk', [TransaksiController::class, 'formMasuk'])->name('transaksi.formMasuk');
    Route::post('/transaksi/masuk', [TransaksiController::class, 'storeMasuk'])->name('transaksi.storeMasuk');
    Route::get('/transaksi/keluar/{id}', [TransaksiController::class, 'formKeluar'])->name('transaksi.formKeluar');
    Route::post('/transaksi/keluar/{id}', [TransaksiController::class, 'prosesKeluar'])->name('transaksi.prosesKeluar');
    Route::get('/struk/{id}', [TransaksiController::class, 'cetakStruk'])->name('transaksi.struk')->middleware('auth');

});

// ================= OWNER =================
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
});