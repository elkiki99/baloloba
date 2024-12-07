<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomePages;
use App\Http\Controllers\LegalPagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoShootController;

Route::get('/', [HomePages::class, 'welcome'])->name('welcome');
Route::get('/about', [HomePages::class, 'about'])->name('about');
Route::get('/contact', [HomePages::class, 'contact'])->name('contact');

Route::get('/cookies', [LegalPagesController::class, 'cookies'])->name('cookies');
Route::get('/aviso-legal', [LegalPagesController::class, 'disclaimer'])->name('disclaimer');
Route::get('/politica-de-privacidad', [LegalPagesController::class, 'privacy'])->name('privacy');
Route::get('/devoluciones', [LegalPagesController::class, 'refund'])->name('refund');
Route::get('/terminos-y-conciones', [LegalPagesController::class, 'terms'])->name('terms');

Route::get('/portfolio', [PhotoShootController::class, 'index'])->name('portfolio');
Route::get('/photoshoots/create', [PhotoShootController::class, 'create'])->name('photoshoot.create');
Route::get('/photoshoot/{photoshoot:slug}', [PhotoShootController::class, 'show'])->name('photoshoot.show');
Route::get('/photoshoot/edit/{photoshoot:slug}', [PhotoShootController::class, 'edit'])->name('photoshoot.edit');
    
Route::get('/categorias/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::view('dashboard', 'dashboard')
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::view('panel', 'panel')
    ->middleware(['auth'])
    ->middleware(['admin'])
    ->name('panel');

require __DIR__.'/auth.php';
