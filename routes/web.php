<?php

use App\Http\Controllers\HomePages;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LegalPagesController;
use App\Http\Controllers\PhotoShootController;

Route::get('/', [HomePages::class, 'welcome'])->name('welcome');
Route::get('/acerca-de', [HomePages::class, 'about'])->name('about');
Route::get('/contacto', [HomePages::class, 'contact'])->name('contact');

Route::get('/cookies', [LegalPagesController::class, 'cookies'])->name('cookies');
Route::get('/aviso-legal', [LegalPagesController::class, 'disclaimer'])->name('disclaimer');
Route::get('/politica-de-privacidad', [LegalPagesController::class, 'privacy'])->name('privacy');
Route::get('/devoluciones', [LegalPagesController::class, 'refund'])->name('refund');
Route::get('/terminos-y-conciones', [LegalPagesController::class, 'terms'])->name('terms');

Route::get('/portfolio', [PhotoShootController::class, 'portfolio'])->name('portfolio');

Route::get('/photoshoots', [PhotoShootController::class, 'index'])->middleware([EnsureUserIsAdmin::class])->name('photoshoot.index');
Route::get('/photoshoots/crear', [PhotoShootController::class, 'create'])->middleware([EnsureUserIsAdmin::class])->name('photoshoot.create');
Route::get('/photoshoot/{photoshoot:slug}', [PhotoShootController::class, 'show'])->name('photoshoot.show');
Route::get('/photoshoot/editar/{photoshoot:slug}', [PhotoShootController::class, 'edit'])->middleware([EnsureUserIsAdmin::class])->name('photoshoot.edit');

Route::get('/categorias', [CategoryController::class, 'index'])->middleware([EnsureUserIsAdmin::class])->name('categories.index');
Route::get('/categorias/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categorias/editar/{category:slug}', [CategoryController::class, 'edit'])->middleware([EnsureUserIsAdmin::class])->name('categories.edit');

Route::get('/paquetes', [PackageController::class, 'index'])->middleware([EnsureUserIsAdmin::class])->name('packages.index');
Route::get('/paquete/editar/{package:slug}', [PackageController::class, 'edit'])->middleware([EnsureUserIsAdmin::class])->name('packages.edit');

Route::view('perfil', 'profile')
    ->middleware(['auth'])  
    ->name('profile');

Route::view('panel', 'admin.panel')
    ->middleware([EnsureUserIsAdmin::class])
    ->name('panel');

require __DIR__ . '/auth.php';
