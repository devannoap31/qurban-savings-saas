<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JemaahController;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/masjid', [PublicController::class, 'masjids'])->name('masjids.index');
Route::get('/masjid/{id}', [PublicController::class, 'showMasjid'])->name('masjids.show');
Route::get('/masjid/{id}/daftar', [PublicController::class, 'daftarJemaah'])->name('masjids.daftar');
Route::post('/masjid/{id}/daftar', [PublicController::class, 'storeJemaah'])->name('masjids.daftar.store');
Route::get('/mitra', [PublicController::class, 'mitra'])->name('mitra');
Route::get('/mitra/register', [PublicController::class, 'register'])->name('mitra.register');

// Static Pages
Route::get('/tentang-kami', [PublicController::class, 'tentang'])->name('pages.tentang');
Route::get('/panduan-tabungan', [PublicController::class, 'panduan'])->name('pages.panduan');
Route::get('/pusat-bantuan', [PublicController::class, 'bantuan'])->name('pages.bantuan');
Route::get('/kebijakan-privasi', [PublicController::class, 'privasi'])->name('pages.privasi');
Route::get('/syarat-ketentuan', [PublicController::class, 'syarat'])->name('pages.syarat');

// Auth Routes
Route::get('/mitra/login', [AuthController::class, 'mitraLogin'])->name('mitra.login');
Route::get('/superadmin/login', [AuthController::class, 'superadminLogin'])->name('superadmin.login');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    
    // Superadmin Routes
    Route::get('/superadmin/dashboard', [App\Http\Controllers\SuperadminController::class, 'index'])->name('superadmin.dashboard');

    // Admin Routes
    Route::middleware('can:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Masjid Image Management
        Route::put('/masjid/image', [AdminController::class, 'updateImage'])->name('masjid.image.update');
        Route::delete('/masjid/image', [AdminController::class, 'removeImage'])->name('masjid.image.remove');
        
        // Admin CRUD
        Route::post('/hewan', [AdminController::class, 'storeHewan'])->name('hewan.store');
        Route::post('/setoran', [AdminController::class, 'storeSetoran'])->name('setoran.store');
        Route::post('/pengeluaran', [AdminController::class, 'storePengeluaran'])->name('pengeluaran.store');
        Route::put('/masjid/profil', [AdminController::class, 'updateProfil'])->name('masjid.profil.update');
        Route::post('/masjid/rekening', [AdminController::class, 'storeRekening'])->name('masjid.rekening.store');
        Route::put('/masjid/rekening/{id}', [AdminController::class, 'updateRekening'])->name('masjid.rekening.update');
        Route::delete('/masjid/rekening/{id}', [AdminController::class, 'destroyRekening'])->name('masjid.rekening.destroy');
    });

    // Jemaah Routes
    Route::middleware('can:jemaah')->prefix('jemaah')->name('jemaah.')->group(function () {
        Route::get('/dashboard', [JemaahController::class, 'dashboard'])->name('dashboard');
    });

});
