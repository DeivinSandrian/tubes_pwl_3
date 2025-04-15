<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KetuaProgramStudiController;
use App\Http\Controllers\TataUsahaController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Role-Based Routes (protected by authentication and role middleware)
Route::middleware(['auth'])->group(function () {
    // Mahasiswa Routes
    Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('role:mahasiswa')->group(function () {
        Route::get('dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
        Route::get('submit-letter', [MahasiswaController::class, 'submitLetter'])->name('submit_letter');
        Route::post('submit-letter', [MahasiswaController::class, 'storeLetter'])->name('store_letter');
        Route::get('letters', [MahasiswaController::class, 'viewLetters'])->name('letters');
        Route::get('letters/{id}/download', [MahasiswaController::class, 'downloadLetter'])->name('download_letter');
    });

    // Ketua Program Studi Routes
    Route::prefix('ketua')->name('ketua.')->middleware('role:ketua')->group(function () {
        Route::get('dashboard', [KetuaProgramStudiController::class, 'dashboard'])->name('dashboard');
        Route::get('approve-letter/{id}', [KetuaProgramStudiController::class, 'approveLetter'])->name('approve_letter');
        Route::post('approve-letter/{id}', [KetuaProgramStudiController::class, 'storeApproval'])->name('store_approval');
        Route::post('reject-letter/{id}', [KetuaProgramStudiController::class, 'rejectLetter'])->name('reject_letter');
    });

    // Tata Usaha Routes
    Route::prefix('tatausaha')->name('tatausaha.')->middleware('role:tatausaha')->group(function () {
        Route::get('dashboard', [TataUsahaController::class, 'dashboard'])->name('dashboard');
        Route::get('create-letter', [TataUsahaController::class, 'createLetter'])->name('create_letter');
        Route::post('create-letter', [TataUsahaController::class, 'storeLetter'])->name('store_letter');
        Route::get('upload-letter', [TataUsahaController::class, 'uploadLetter'])->name('upload_letter');
        Route::post('upload-letter', [TataUsahaController::class, 'storeUpload'])->name('store_upload');
    });
});