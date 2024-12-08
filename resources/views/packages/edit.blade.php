<x-admin-panel-layout>
    <section class="py-[20vh] sm:px-6 lg:px-8 px-0">
        <div class="space-y-6 md:mx-auto max-w-7xl">
            <h1 class="px-4 text-5xl font-bold underline md:text-7xl decoration-yellow-500">Editar paquetes</h1>

            <!-- Eventos -->
            <div
                class="max-w-2xl p-8 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))]
                    from-gray-200
                    via-gray-100
                    to-gray-50 sm:rounded-md shadow-xl">
                <header>
                    <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">
                        {{ __('Editar moda') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Edita los datos del paquete de moda.') }}
                    </p>
                </header>

                <livewire:packages.edit.fashion />
            </div>

            <!-- Polaroids -->
            <div
                class="max-w-2xl p-8 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))]
                            from-gray-200
                            via-gray-100
                            to-gray-50 sm:rounded-md shadow-xl">
                <header>
                    <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">
                        {{ __('Editar polaroids') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Edita los datos del paquete de polaroids.') }}
                    </p>
                </header>

                <livewire:packages.edit.polaroids />
            </div>

            <!-- Moda -->
            <div
                class="max-w-2xl p-8 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))]
                    from-gray-200
                    via-gray-100
                    to-gray-50 sm:rounded-md shadow-xl">
                <header>
                    <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">
                        {{ __('Editar eventos') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Edita los datos del paquete de eventos.') }}
                    </p>
                </header>

                <livewire:packages.edit.events />
            </div>
        </div>
    </section>
</x-admin-panel-layout>