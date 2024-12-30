<?php

use App\Http\Controllers\HomePages;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\HeaderController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LegalPagesController;
use App\Http\Controllers\PhotoShootController;
use App\Http\Controllers\TestimonialController;
use App\Http\Middleware\CheckPhotoShootAccess;

Route::get('/', [HomePages::class, 'welcome'])->name('welcome');
Route::get('/sobre-mi', [HomePages::class, 'about'])->name('about');
Route::get('/contacto', [HomePages::class, 'contact'])->name('contact');

Route::get('/cookies', [LegalPagesController::class, 'cookies'])->name('cookies');
Route::get('/aviso-legal', [LegalPagesController::class, 'disclaimer'])->name('disclaimer');
Route::get('/politica-de-privacidad', [LegalPagesController::class, 'privacy'])->name('privacy');
Route::get('/devoluciones', [LegalPagesController::class, 'refund'])->name('refund');
Route::get('/terminos-y-conciones', [LegalPagesController::class, 'terms'])->name('terms');

Route::get('/portfolio', [PhotoShootController::class, 'portfolio'])->name('portfolio');

Route::get('/photoshoots', [PhotoShootController::class, 'index'])->middleware([EnsureUserIsAdmin::class])->name('photoshoot.index');
Route::get('/photoshoots/crear', [PhotoShootController::class, 'create'])->middleware([EnsureUserIsAdmin::class])->name('photoshoot.create');
Route::get('/photoshoot/{photoshoot:slug}', [PhotoShootController::class, 'show'])->middleware([CheckPhotoShootAccess::class])->name('photoshoot.show');
Route::get('/photoshoot/editar/{photoshoot:slug}', [PhotoShootController::class, 'edit'])->middleware([EnsureUserIsAdmin::class])->name('photoshoot.edit');


Route::get('/categorias', [CategoryController::class, 'index'])->middleware([EnsureUserIsAdmin::class])->name('categories.index');
Route::get('/categorias/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categorias/editar/{category:slug}', [CategoryController::class, 'edit'])->middleware([EnsureUserIsAdmin::class])->name('categories.edit');

Route::get('/paquetes', [PackageController::class, 'index'])->middleware([EnsureUserIsAdmin::class])->name('packages.index');
Route::get('/paquete/editar/{package:slug}', [PackageController::class, 'edit'])->middleware([EnsureUserIsAdmin::class])->name('packages.edit');    

// Panel
Route::middleware([EnsureUserIsAdmin::class])->group(function () {
    Route::get('/componentes', [HomePages::class, 'components'])->name('components.index');
    Route::get('/componentes/headers', [HeaderController::class, 'index'])->name('headers.index');
    Route::get('/componentes/header/editar/{header:slug}', [HeaderController::class, 'edit'])->name('headers.edit');

    Route::get('/componentes/secciones', [SectionController::class, 'index'])->name('sections.index');
    Route::get('/componentes/seccion/editar/{section:slug}', [SectionController::class, 'edit'])->name('sections.edit');

    Route::get('/componentes/testimonios', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/componentes/testimonio/editar/{testimonial:slug}', [TestimonialController::class, 'edit'])->name('testimonials.edit');

    Route::get('componentes/editar/footer', [FooterController::class, 'edit'])->name('footer.edit');
});

Route::get('/mis-photoshoots', [PhotoShootController::class, 'clientPhotoshoots'])->middleware(['auth'])->name('client.photoshoots');

Route::view('perfil', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('panel', 'admin.panel')
    ->middleware([EnsureUserIsAdmin::class])
    ->name('panel');

require __DIR__ . '/auth.php';
