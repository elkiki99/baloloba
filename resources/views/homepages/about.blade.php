<x-app-layout>
    <div class="flex flex-col pt-12 space-y-32 sm:pt-0">
        <!-- Header -->
        <section class="flex flex-col items-start justify-center w-full min-h-screen bg-center bg-cover"
            style="background-image: url('{{ asset('cami.jpg') }}'); background-position: top;">
            <div class="absolute inset-0 h-screen mt-12 bg-black bg-opacity-50 sm:mt-0"></div>

            <div class="relative z-10 w-full px-6 mx-auto space-y-6 max-w-7xl text-start">
                <h1 class="text-6xl font-bold text-white uppercase md:text-9xl">SOBRE <span class="super-thin">MI</span></h1>

                <p class="max-w-2xl text-lg leading-relaxed text-gray-200 md:text-xl">
                    Tengo más de 4 años de experiencia en fotografía profesional, especializándome en retratos y moda.
                    Capturo momentos únicos con un enfoque creativo y detallado.
                </p>

                <p class="max-w-2xl text-sm leading-relaxed text-gray-300 md:text-base">
                    También realizo coberturas de eventos, transformando momentos importantes en recuerdos inolvidables.
                </p>
            </div>
        </section>

        <!-- Studio -->
        <section class="mt-12 pb-[20vh] space-y-6">
            <div class="mx-auto max-w-7xl">
                <h1 class="px-4 text-5xl font-bold underline md:text-7xl sm:px-6 md:px-8 decoration-yellow-500">Mi estudio</h1>
            </div>
            
            <div class="px-0 sm:px-6 md:px-8">
                <div class="relative flex items-center justify-center w-full min-h-screen bg-center bg-cover rounded-3xl"
                    style="background-image: url('{{ asset('estudio.jpg') }}');">

                    <div class="flex flex-col items-start space-y-6">
                        <h2 class="inline-block text-xl font-bold text-gray-900 sm:text-3xl md:text-5xl typing-effect">
                            Situado en el corazón de <span class="font-black underline decoration-yellow-500">Palermo</span>
                        </h2>

                        <!-- CTA -->
                        <div
                            class="inline-block px-10 py-2 text-2xl font-medium text-center transition duration-300 ease-in-out bg-transparent border border-gray-700 rounded-full hover:cursor-pointer sm:w-auto backdrop-blur-md hover:backdrop-blur-lg hover:bg-white/20">
                            <a href="{{ route('contact') }}" wire:navigate
                                class="flex items-center text-black hover:text-gray-800">
                                AGENDATE
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
        </section>

        <style>
            @keyframes typing {
                0% {
                    width: 0;
                }

                100% {
                    width: 100%;
                }
            }

            .typing-effect {
                display: inline-block;
                overflow: hidden;
                white-space: nowrap;
                max-width: 100%;
                border-right: 4px solid black;
                animation: typing 3s steps(30, end) 1s forwards, blink-caret 0.75s step-end 3s infinite;
            }

            @keyframes blink-caret {
                50% {
                    border-color: transparent;
                }
            }
        </style>
</x-app-layout>
