<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\PhotoShoot;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Spanish language
        setlocale(LC_TIME, 'es_ES.UTF-8');
        Carbon::setLocale('es');
        date_default_timezone_set(config('app.timezone'));

        //Gates
        Gate::define('modify-page', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('like-photoshoot-photos', function (User $user, Photoshoot $photoshoot) {
            return !$user->isAdmin() && $photoshoot->status === 'client_preview' && $photoshoot->clients->contains($user->id);
        });
    }
}
