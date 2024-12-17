<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPhotoShootAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $photoshoot = $request->route('photoshoot');

        // Acceso para photoshoots publicados
        if ($photoshoot->status === 'published') {
            return $next($request);
        }

        // Acceso para photoshoots en client_preview
        if ($photoshoot->status === 'client_preview') {
            if (Auth::check() && (Auth::user()->isAdmin() || $photoshoot->clients->contains(Auth::id()))) {
                return $next($request);
            }
        }

        // Acceso para photoshoots en draft solo para admin
        if ($photoshoot->status === 'draft') {
            if (Auth::check() && Auth::user()->isAdmin()) {
                return $next($request);
            }
        }

        // Si no cumple las condiciones, redirigir al home
        return redirect('/');
    }
}
