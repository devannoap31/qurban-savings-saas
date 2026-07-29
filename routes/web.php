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
Route::post('/mitra/register', [PublicController::class, 'storeMitra'])->name('mitra.register.post');
Route::post('/mitra/register/cancel', [PublicController::class, 'cancelRegistration'])->name('mitra.register.cancel')->middleware('auth');

// Static Pages
Route::get('/tentang-kami', [PublicController::class, 'tentang'])->name('pages.tentang');
Route::get('/panduan-tabungan', [PublicController::class, 'panduan'])->name('pages.panduan');
Route::get('/pusat-bantuan', [PublicController::class, 'bantuan'])->name('pages.bantuan');
Route::get('/kebijakan-privasi', [PublicController::class, 'privasi'])->name('pages.privasi');
Route::get('/syarat-ketentuan', [PublicController::class, 'syarat'])->name('pages.syarat');

// Auth Routes
Route::get('/mitra/login', [AuthController::class, 'mitraLogin'])->name('mitra.login');
Route::post('/mitra/login', [AuthController::class, 'authenticateMitra'])->name('mitra.login.post');

Route::get('/superadmin/login', [AuthController::class, 'superadminLogin'])->name('superadmin.login');
Route::post('/superadmin/login', [AuthController::class, 'authenticateSuperadmin'])->name('superadmin.login.post');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticateJemaah'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [\App\Http\Controllers\PasswordResetController::class, 'showLinkRequestForm'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [\App\Http\Controllers\PasswordResetController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [\App\Http\Controllers\PasswordResetController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [\App\Http\Controllers\PasswordResetController::class, 'reset'])->middleware('guest')->name('password.update');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    
    // Email Verification Routes
    Route::get('/email/verify', function () {
        return view('auth.registration-success');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
        $request->fulfill();
        
        $user = $request->user();
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/jemaah/dashboard');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi telah dikirim ulang ke email Anda.');
    })->middleware('throttle:6,1')->name('verification.send');

    // Superadmin Routes
    Route::get('/superadmin/dashboard', [App\Http\Controllers\SuperadminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/superadmin/profil', [App\Http\Controllers\SuperadminController::class, 'profil'])->name('superadmin.profil');
    Route::put('/superadmin/profil', [App\Http\Controllers\SuperadminController::class, 'updateProfil'])->name('superadmin.profil.update');
    Route::get('/superadmin/arsip', [App\Http\Controllers\SuperadminController::class, 'arsip'])->name('superadmin.arsip');
    Route::put('/superadmin/mitra/{id}/status', [App\Http\Controllers\SuperadminController::class, 'updateStatus'])->name('superadmin.status');
    Route::post('/superadmin/mitra/{id}/restore', [App\Http\Controllers\SuperadminController::class, 'restore'])->name('superadmin.restore');
    Route::delete('/superadmin/mitra/{id}', [App\Http\Controllers\SuperadminController::class, 'destroy'])->name('superadmin.destroy');

    // Admin Routes
    Route::middleware(['can:admin', 'verified', 'approved'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Masjid Image Management
        Route::put('/masjid/image', [AdminController::class, 'updateImage'])->name('masjid.image.update');
        Route::delete('/masjid/image', [AdminController::class, 'removeImage'])->name('masjid.image.remove');
        
        // Admin CRUD
        Route::post('/hewan', [AdminController::class, 'storeHewan'])->name('hewan.store');
        Route::put('/hewan/{id}', [AdminController::class, 'updateHewan'])->name('hewan.update');
        Route::post('/setoran', [AdminController::class, 'storeSetoran'])->name('setoran.store');
        Route::post('/pengeluaran', [AdminController::class, 'storePengeluaran'])->name('pengeluaran.store');
        Route::put('/masjid/profil', [AdminController::class, 'updateProfil'])->name('masjid.profil.update');
        Route::post('/masjid/rekening', [AdminController::class, 'storeRekening'])->name('masjid.rekening.store');
        Route::put('/masjid/rekening/{id}', [AdminController::class, 'updateRekening'])->name('masjid.rekening.update');
        Route::delete('/masjid/rekening/{id}', [AdminController::class, 'destroyRekening'])->name('masjid.rekening.destroy');
        Route::delete('/jemaah/{id}/batal', [AdminController::class, 'batalJemaah'])->name('jemaah.batal');
        Route::post('/jemaah', [AdminController::class, 'storeJemaah'])->name('jemaah.store');
        Route::get('/cetak-laporan', [AdminController::class, 'cetakLaporan'])->name('cetak-laporan');
    });

    // Jemaah Routes
    Route::middleware(['can:jemaah', 'verified'])->prefix('jemaah')->name('jemaah.')->group(function () {
        Route::get('/dashboard', [JemaahController::class, 'dashboard'])->name('dashboard');
        Route::get('/cetak/{id}', [JemaahController::class, 'cetakLaporan'])->name('cetak-laporan');
    });

});
