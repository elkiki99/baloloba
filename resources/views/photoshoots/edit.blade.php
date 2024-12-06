<x-app-layout>
    <section class="pt-12 pb-[20vh] sm:px-6 md:px-8 px-0">
        <div class="space-y-6 md:mx-auto sm:mt-10 max-w-7xl">
            <h1 class="px-4 pt-10 text-5xl font-bold underline md:text-7xl decoration-yellow-500">Editar photoshoot</h1>

            <div class="flex flex-col max-w-2xl">
                <a wire:navigate class="flex items-center gap-2 px-4 py-2 ml-auto text-gray-600 hover:cursor-pointer"
                    href="{{ route('photoshoot.show', $photoshoot->slug) }}">
                    <p>Ir al photoshoot</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>

                <div
                    class=" p-8 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))]
                    from-gray-200
                    via-gray-100
                    to-gray-50 sm:rounded-md shadow-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">
                            {{ __('Modificar photoshoot') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-700 dark:text-gray-400">
                            {{ __('Actualiza esta sesión fotográfica.') }}
                        </p>
                    </header>

                    <livewire:photoshoot.edit :id="$photoshoot->id" />
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
