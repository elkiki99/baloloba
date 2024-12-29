<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('registrar', 'pages.auth.register')
        ->name('register');

    Volt::route('login', 'pages.auth.login')
        ->name('login');

    Volt::route('olvidaste-tu-contraseña', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('restablecer-contraseña/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verificar-mail', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verificar-mail/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirmar-contraseña', 'pages.auth.confirm-password')
        ->name('password.confirm');
});
