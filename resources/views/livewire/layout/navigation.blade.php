<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }"
    class="fixed top-0 z-50 w-full px-3 mx-auto text-sm font-medium text-center bg-transparent rounded-none sm:rounded-full sm:w-auto sm:top-10 backdrop-filter mix-blend-luminosity backdrop-blur-lg sm:flex">
    <!-- Primary Navigation Menu -->
    <div class="flex items-center justify-between h-12 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="{{ route('welcome') }}">
                <x-application-logo />
            </a>
        </div>  

        <!-- Hamburguer for mobile -->
        <div class="sm:hidden">
            <button @click="open = !open" class="inline-flex items-center justify-center p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path :class="{ 'hidden': open, 'block': !open }" class="block" stroke-linecap="round"
                        stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
                    <path :class="{ 'hidden': !open, 'block': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Navigation Links -->
        <div class="hidden sm:flex sm:items-center sm:space-x-8 sm:ml-10">
            <x-nav-link wire:navigate :href="route('portfolio')" :active="request()->routeIs('portfolio')">
                {{ __('Portfolio') }}
            </x-nav-link>
            <x-nav-link wire:navigate :href="route('about')" :active="request()->routeIs('about')">
                {{ __('Sobre mi') }}
            </x-nav-link>

            <x-nav-link wire:navigate :href="route('contact')" :active="request()->routeIs('contact')"
                class="">
                <div class="flex items-center">
                    {{ __('Contacto') }}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </div>
            </x-nav-link>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="flex sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link wire:navigate :href="route('portfolio')" :active="request()->routeIs('portfolio')">
                {{ __('Portfolio') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link wire:navigate :href="route('about')" :active="request()->routeIs('about')">
                {{ __('About me') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>