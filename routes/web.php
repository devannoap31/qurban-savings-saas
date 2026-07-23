<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JemaahController;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/mitra', [PublicController::class, 'mitra'])->name('mitra');
Route::get('/mitra/register', [PublicController::class, 'register'])->name('mitra.register');

// Auth Routes
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
        // Add more admin routes here as needed (store, update, destroy)
    });

    // Jemaah Routes
    Route::middleware('can:jemaah')->prefix('jemaah')->name('jemaah.')->group(function () {
        Route::get('/dashboard', [JemaahController::class, 'dashboard'])->name('dashboard');
    });

});
