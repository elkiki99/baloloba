<x-app-layout>
    <div class="min-h-screen">
        <div class="pt-12">
            <div class="space-y-6 sm:mt-10">
                <!-- Text header -->
                <div class="px-4 mx-auto space-y-4 sm:px-6 md:space-y-6 lg:px-8 max-w-7xl">
                    <h1
                        class="pt-10 text-5xl text-transparent md:text-7xl bg-clip-text bg-gradient-to-r from-black to-gray-800">
                        Agenda tu sesión con <span class="font-bold text-black underline decoration-yellow-500">Camila
                            Fernández</span>
                        en un solo click
                    </h1>
                    <p class="pb-5 text-sm text-gray-800 border-b border-gray-300 sm:text-2xl">¡Elegí uno de nuestros
                        paquetes
                        y obtené un 15% de
                        descuento hoy!
                    </p>
                </div>

                <!-- Paquetes -->
                <div class="py-16">
                    @include('packages.show')
                </div>

                <!-- Contacto -->
                <section class="space-y-6 pb-[20vh]">
                    <h1
                        class="px-4 mx-auto text-5xl text-transparent max-w-7xl sm:px-6 lg:px-8 md:text-7xl bg-clip-text bg-gradient-to-r from-black to-gray-800">
                        <span class="font-bold text-black underline decoration-yellow-500">Contactame</span>
                    </h1>

                    <div class="px-0 mx-auto sm:px-6 lg:px-8 sm:max-w-7xl">
                        <div
                            class="max-w-xl p-8 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))]
                    from-gray-200
                    via-gray-100
                    to-gray-50 sm:rounded-md shadow-xl">
                            <header>
                                <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">
                                    {{ __('Hablemos') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-700 dark:text-gray-400">
                                    {{ __('¡Mandame tus dudas por acá! Siempre respondo.') }}
                                </p>
                            </header>

                            <livewire:components.contact-form />
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
