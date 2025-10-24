<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Auth\VerifyEmail;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;

Route::middleware('guest')->group(function () {

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.submit');
    
    // Route::get('forgot-password', AuthController::class)->name('password.request');
    // Route::get('reset-password/{token}', AuthController::class)->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', VerifyEmail::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

