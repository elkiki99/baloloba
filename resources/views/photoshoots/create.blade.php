<x-app-layout>
    <section class="pt-12 pb-[20vh] sm:px-6 md:px-8 px-0">
        <div class="space-y-6 md:mx-auto sm:mt-10 max-w-7xl">
            <h1 class="px-4 pt-10 text-5xl font-bold underline md:text-7xl decoration-yellow-500">Crear photoshoot</h1>

            <div
                class="max-w-2xl p-8 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))]
                    from-gray-200
                    via-gray-100
                    to-gray-50 sm:rounded-md shadow-xl">
                <header>
                    <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">
                        {{ __('Nuevo photoshoot') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Crea una nueva sesión fotográfica.') }}
                    </p>
                </header>

                <livewire:photoshoot.create />
            </div>
        </div>

        <div class="mt-5">
            @if (session('message'))
                <p class="text-sm text-green-600">{{ session('message') }}</p>
            @endif
        </div>
        
    </section>
</x-app-layout>
