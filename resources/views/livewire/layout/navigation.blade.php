<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    public $class;
}; ?>

<nav
    class="{{ $class }} top-0 z-50 w-full px-3 mx-auto text-sm font-medium text-center bg-transparent rounded-none sm:rounded-full sm:w-auto sm:top-10 backdrop-filter mix-blend-luminosity backdrop-blur-lg sm:flex">
    <!-- Primary Navigation Menu -->
    <div class="flex items-center justify-between h-12 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="{{ route('welcome') }}">
                <x-application-logo class="w-8 h-8 text-gray-500 fill-current" />
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex sm:items-center sm:space-x-8 sm:ml-10">
            <x-nav-link wire:navigate :href="route('portfolio')" :active="request()->routeIs('portfolio') || (request()->is('categoria/*') && !request()->is('categoria/editar/*')) || (request()->is('photoshoot/*') && !request()->is('photoshoot/editar/*'))">
                {{ __('Portfolio') }}
            </x-nav-link>
            <x-nav-link wire:navigate :href="route('about')" :active="request()->routeIs('about')">
                {{ __('Sobre mi') }}
            </x-nav-link>

            <x-nav-link wire:navigate :href="route('contact')" :active="request()->routeIs('contact')">
                {{ __('Contacto') }}
            </x-nav-link>

            @if (Auth::user() && Auth::user()->isAdmin())
                <x-nav-link wire:navigate :href="route('panel')" :active="request()->routeIs('panel') || request()->is('paquetes') || request()->is('paquete/*') || request()->is('componentes') || request()->is('componentes/*') || request()->is('perfil') || request()->is('photoshoots') || request()->is('photoshoots/crear') || request()->is('photoshoot/editar/*') || request()->is('categoria/editar/*') || request()->is('categorias')">
                    {{ __('Panel') }}
                </x-nav-link>
            @elseif(Auth::user())
                <x-nav-link wire:navigate :href="route('profile')" :active="request()->routeIs('profile')">
                    {{ __('Perfil') }}
                </x-nav-link>
            @endif
        </div>
    </div>
</nav>
