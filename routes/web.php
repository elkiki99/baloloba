<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomePages;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoShootController;

Route::get('/', [HomePages::class, 'welcome'])->name('welcome');
Route::get('/about', [HomePages::class, 'about'])->name('about');
Route::get('/contact', [HomePages::class, 'contact'])->name('contact');

Route::get('/portfolio', [PhotoShootController::class, 'index'])->name('portfolio');
Route::get('/photoshoot/create', [PhotoShootController::class, 'create'])->name('photoshoot.create');
Route::post('/photoshoot', [PhotoShootController::class, 'store'])->name('photoshoot.store');
Route::get('/photoshoot/{photoshoot:slug}', [PhotoShootController::class, 'show'])->name('photoshoot.show');
Route::get('/photoshoot/{photoshoot:slug}/edit', [PhotoShootController::class, 'edit'])->name('photoshoot.edit');
Route::put('/photoshoot/{photoshoot:slug}/edit', [PhotoShootController::class, 'update'])->name('photoshoot.update');
Route::delete('/photoshoot/{photoshoot:slug}', [PhotoShootController::class, 'destroy'])->name('photoshoot.destroy');

Route::get('/categorias/{category:name}', [CategoryController::class, 'index'])->name('categories.index');

Route::view('dashboard', 'dashboard')
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
