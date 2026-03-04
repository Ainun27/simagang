<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DivisiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\PublicController;

// Public routes
Route::get('/', [PublicController::class, 'divisi'])->name('public.divisi');

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes (protected)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('divisi', DivisiController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    
    // TAMBAH INI - Route untuk toggle status
    Route::patch('/mahasiswa/{mahasiswa}/toggle-status', [MahasiswaController::class, 'toggleStatus'])
        ->name('mahasiswa.toggle-status');
});

// routes/web.php - tambahkan:
Route::get('/informasi', [PublicController::class, 'informasi'])->name('public.informasi');
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

// Public routes
Route::get('/', [PublicController::class, 'divisi'])->name('public.divisi');
Route::get('/informasi', [PublicController::class, 'informasi'])->name('public.informasi');
Route::get('/syarat', [PublicController::class, 'syarat'])->name('public.syarat');
Route::get('/alur', [PublicController::class, 'alur'])->name('public.alur');


Route::prefix('admin')->name('admin.')->group(function () {
    // ... route lainnya ...
    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
    Route::get('/laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
});

Route::get('/admin/laporan/export-page', [LaporanController::class, 'exportPage'])->name('admin.laporan.export.page');

Route::patch('/admin/mahasiswa/{id}/toggle-status', [MahasiswaController::class, 'toggleStatus'])->name('admin.mahasiswa.toggleStatus');