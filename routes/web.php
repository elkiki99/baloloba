<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::view('dashboard', 'dashboard')
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('portfolio', 'portfolio')
    ->name('portfolio');

Route::view('about', 'about')
    ->name('about');

Route::view('contact', 'contact')
    ->name('contact');

require __DIR__.'/auth.php';
