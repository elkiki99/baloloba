<x-app-layout>

    <!-- Marquee -->
    <x-balo-loba-marquee />

    <!-- Header -->
    <div class="flex flex-col items-start justify-center w-full min-h-screen bg-center bg-cover"
        style="background-image: url('{{ asset('header1.jpg') }}'); background-position: top;">
        <div class="absolute inset-0 bg-black bg-opacity-10"></div>

        <div class="relative z-10 w-full px-6 mx-auto space-y-6 max-w-7xl text-start">
            <h1 class="font-bold text-white text-9xl">BALO LOBA</h1>
            <p class="text-2xl text-gray-200">FOTOGRAFÍA DE AUTOR EN RETRATOS Y MODA</p>

            <!-- CTA -->
            <div
                class="items-center inline-block px-10 py-2 text-3xl font-medium text-center transition duration-300 ease-in-out bg-transparent border border-gray-300 rounded-full hover:cursor-pointer sm:w-auto backdrop-blur-md hover:backdrop-blur-lg hover:bg-white/10">
                <a href="#" class="flex items-center text-white hover:text-gray-200">
                    CONTACTO
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Porfolio -->
    <div class="min-h-screen mt-12 space-y-6">
        <div class="mx-auto max-w-7xl">
            <h1 class="font-bold text-9xl">PORTFOLIO</h1>
        </div>
        <div class="grid grid-cols-3 gap-1 mx-1">
            <a href="{{ asset('308234441_1215140699031874_3114405947350534715_n.jpg') }}">
                <div class="w-full h-full overflow-hidden">
                    <img class="object-cover w-full h-full"
                        src="{{ asset('308234441_1215140699031874_3114405947350534715_n.jpg') }}">
                </div>
            </a>
            <a href="{{ asset('5.jpg') }}">
                <div class="w-full h-full overflow-hidden">
                    <img class="object-cover w-full h-full" src="{{ asset('5.jpg') }}">
                </div>
            </a>
            <a href="{{ asset('3 (4).jpg') }}">
                <div class="w-full h-full overflow-hidden">
                    <img class="object-cover w-full h-full" src="{{ asset('3 (4).jpg') }}">
                </div>
            </a>
            <a href="{{ asset('DSC_0335.jpg') }}">
                <div class="w-full h-full overflow-hidden">
                    <img class="object-cover w-full h-full" src="{{ asset('DSC_0335.jpg') }}">
                </div>
            </a>
            <a href="{{ asset('DSC_0386.jpg') }}">
                <div class="w-full h-full overflow-hidden">
                    <img class="object-cover w-full h-full" src="{{ asset('DSC_0386.jpg') }}">
                </div>
            </a>
            <a href="{{ asset('DSC_0723 (1) (1).jpg') }}">
                <div class="w-full h-full overflow-hidden">
                    <img class="object-cover w-full h-full" src="{{ asset('DSC_0723 (1) (1).jpg') }}">
                </div>
            </a>
        </div>
    </div>

    <!-- About me -->
    <div class="min-h-screen mt-12 space-y-6">
        <div class="mx-auto max-w-7xl">
            <h1 class="font-bold text-9xl">SOBRE MI</h1>

            <div class="relative w-full min-h-screen bg-center bg-cover"
                style="background-image: url('{{ asset('cami.jpg') }}'); background-position: top;">
                <div class="flex flex-col items-start justify-start h-full p-6 space-y-6">
                    <h2 class="max-w-sm text-5xl text-white">
                        Mi nombre es Camila, me gusta crear y experimentar, comencé mi carrera hace varios años y desde
                        entonces me dedico a la fotografía de retratos y moda.
                    </h2>

                    <!-- CTA -->
                    <div
                        class="inline-block px-10 py-2 text-3xl font-medium text-center transition duration-300 ease-in-out bg-transparent border border-gray-100 rounded-full hover:cursor-pointer sm:w-auto backdrop-blur-md hover:backdrop-blur-lg hover:bg-white/10">
                        <a href="#" class="flex items-center text-white hover:text-gray-100">
                            SOBRE MI
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact -->
    <div class="min-h-screen mt-12 mb-[20vh] space-y-6">
        <div class="mx-auto space-y-6 max-w-7xl">
            <h1 class="font-bold text-9xl">CONTACTO</h1>

            <div class="dark:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Escribime!') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Mandame tus dudas por acá! Te respondo lo antes posible.') }}
                            </p>
                        </header>

                        <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
                            <div>
                                <x-input-label for="name" :value="__('Nombre')" />
                                <x-text-input wire:model="name" id="name" name="name" type="text"
                                    class="block w-full mt-1" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input wire:model="email" id="email" name="email" type="email"
                                    class="block w-full mt-1" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="phone" :value="__('Teléfono')" />
                                <x-text-input wire:model="phone" id="phone" name="phone" type="tel"
                                    class="block w-full mt-1" required autocomplete="phone" />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            <div>
                                <x-input-label for="message" :value="__('Tu mensaje')" />
                                <textarea 
                                    wire:model="message" 
                                    id="message" 
                                    name="message" 
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" 
                                    rows="4" 
                                    required
                                    autocomplete="message"></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('message')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Enviar') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
