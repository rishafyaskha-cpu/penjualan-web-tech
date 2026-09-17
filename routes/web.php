<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

// Route untuk Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yang dilindungi oleh Middleware Auth (Hanya bisa diakses jika sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('barang', BarangController::class);
    Route::resource('transaksi', TransaksiController::class);

    Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
});