<?php

use App\Http\Controllers\KetuaProgramStudiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TataUsahaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Support\Facades\Route;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes (replacing Auth::routes())
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');

// Mahasiswa Routes
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    // Route::get('mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
    // Route::get('mahasiswa/letters', [MahasiswaController::class, 'letters'])->name('mahasiswa.letters');
    // Route::get('mahasiswa/letters/create', [MahasiswaController::class, 'create'])->name('mahasiswa.letters.create');
    // Route::post('mahasiswa/letters', [MahasiswaController::class, 'store'])->name('mahasiswa.letters.store');
    // Route::get('mahasiswa/letters/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.letters.show');
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
    Route::get('/letters', [MahasiswaController::class, 'letters'])->name('mahasiswa.letters');
    Route::get('/letters/create/{type}', [MahasiswaController::class, 'create'])->name('mahasiswa.letters.create');
    Route::post('/letters/store', [MahasiswaController::class, 'store'])->name('mahasiswa.letters.store');
    Route::get('/letters/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.letters.show');
    Route::get('letters/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.letters.edit');
    Route::put('letters/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.letters.update');
    Route::delete('letters/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.letters.destroy');
});

// Ketua Routes
Route::middleware(['auth', 'role:ketua'])->group(function () {
    Route::get('ketua/dashboard', [KetuaProgramStudiController::class, 'dashboard'])->name('ketua.dashboard');
    Route::get('ketua/letters', [KetuaProgramStudiController::class, 'letters'])->name('ketua.letters');
    Route::post('ketua/letters/{id}/approve', [KetuaProgramStudiController::class, 'approve'])->name('ketua.letters.approve');
    Route::post('ketua/letters/{id}/reject', [KetuaProgramStudiController::class, 'reject'])->name('ketua.letters.reject');
    Route::get('ketua/letters/{id}', [KetuaProgramStudiController::class, 'show'])->name('ketua.letters.show');
    Route::post('ketua/notifications/mark-as-read', [KetuaProgramStudiController::class, 'markNotificationsAsRead'])->name('ketua.notifications.markAsRead');
});

// Tata Usaha Routes
Route::middleware(['auth', 'role:tatausaha'])->group(function () {
    Route::get('tatausaha/dashboard', [TataUsahaController::class, 'dashboard'])->name('tatausaha.dashboard');
    Route::get('tatausaha/letters', [TataUsahaController::class, 'letters'])->name('tatausaha.letters');
    Route::post('tatausaha/letters/{id}/upload', [TataUsahaController::class, 'upload'])->name('tatausaha.letters.upload');
    Route::get('tatausaha/letters/{id}', [TataUsahaController::class, 'show'])->name('tatausaha.letters.show');
    Route::post('tatausaha/notifications/mark-as-read', [TataUsahaController::class, 'markNotificationsAsRead'])->name('tatausaha.notifications.markAsRead');
});

// Semuanya
Route::middleware(['auth'])->group(function () {
    // Route::get('ketua/dashboard', [KetuaProgramStudiController::class, 'dashboard'])->name('ketua.dashboard');
    // Route::get('ketua/letters', [KetuaProgramStudiController::class, 'letters'])->name('ketua.letters');
    // Route::post('ketua/letters/{id}/approve', [KetuaProgramStudiController::class, 'approve'])->name('ketua.letters.approve');
    // Route::post('ketua/letters/{id}/reject', [KetuaProgramStudiController::class, 'reject'])->name('ketua.letters.reject');
    // Route::get('ketua/letters/{id}', [KetuaProgramStudiController::class, 'show'])->name('ketua.letters.show');
    Route::get('letters/download/{id}', [MahasiswaController::class, 'download'])->name('mahasiswa.letters.download');
    
});