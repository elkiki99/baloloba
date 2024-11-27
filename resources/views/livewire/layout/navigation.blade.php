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

<nav
    class="fixed top-0 z-50 w-full px-3 mx-auto text-sm font-medium text-center bg-transparent rounded-none sm:rounded-full sm:w-auto sm:top-10 backdrop-filter mix-blend-luminosity backdrop-blur-lg sm:flex">
    <!-- Primary Navigation Menu -->
    <div class="flex items-center justify-between h-12 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="{{ route('welcome') }}">
                <x-application-logo />
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex sm:items-center sm:space-x-8 sm:ml-10">
            <x-nav-link wire:navigate :href="route('portfolio')" :active="request()->routeIs('portfolio')">
                {{ __('Portfolio') }}
            </x-nav-link>
            <x-nav-link wire:navigate :href="route('about')" :active="request()->routeIs('about')">
                {{ __('Sobre mi') }}
            </x-nav-link>

            <x-nav-link wire:navigate :href="route('contact')" :active="request()->routeIs('contact')">
                {{ __('Contacto') }}
            </x-nav-link>
        </div>
    </div>
</nav>
