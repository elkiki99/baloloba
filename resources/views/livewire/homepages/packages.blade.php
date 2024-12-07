<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class="bg-gradient-to-b from-white via-yellow-400 to-white">
    <section class=" mx-auto md:px-4 max-w-7xl" x-data="{ isExtended: $el.querySelector('#checkbox').checked }">
        <h2 class="px-4 text-5xl md:text-7xl font-bold underline decoration-yellow-500 sm:px-6 md:px-8">Paquetes</h2>
        <!-- Toggle switch -->
        <div class="flex flex-col items-center justify-center gap-4 py-5 sm:flex-row sm:gap-6">
            <!-- Label básico -->
            <label class="text-sm text-gray-700 min-w-[3rem] text-center sm:me-3">
                Básico
            </label>

            <!-- Toggle switch -->
            <div class="relative">
                <input type="checkbox" id="checkbox"
                    class="relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-yellow-500 disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-yellow-500 checked:border-yellow-500 focus:checked:border-yellow-500 
                    
                                before:inline-block before:size-6 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200"
                    checked x-model="isExtended" />
            </div>

            <!-- Label extendido -->
            <label class="relative text-sm text-gray-700 min-w-[4rem] text-center sm:ms-3">
                Extendido
                <span class="absolute bottom-12 right sm:right-0 sm:-top-12">
                    <span class="flex items-center justify-end">
                        <svg class="h-8 w-14 sm:-me-6" width="45" height="25" viewBox="0 0 45 25"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M43.2951 3.47877C43.8357 3.59191 44.3656 3.24541 44.4788 2.70484C44.5919 2.16427 44.2454 1.63433 43.7049 1.52119L43.2951 3.47877ZM4.63031 24.4936C4.90293 24.9739 5.51329 25.1423 5.99361 24.8697L13.8208 20.4272C14.3011 20.1546 14.4695 19.5443 14.1969 19.0639C13.9242 18.5836 13.3139 18.4152 12.8336 18.6879L5.87608 22.6367L1.92723 15.6792C1.65462 15.1989 1.04426 15.0305 0.563943 15.3031C0.0836291 15.5757 -0.0847477 16.1861 0.187863 16.6664L4.63031 24.4936ZM43.7049 1.52119C32.7389 -0.77401 23.9595 0.99522 17.3905 5.28788C10.8356 9.57127 6.58742 16.2977 4.53601 23.7341L6.46399 24.2659C8.41258 17.2023 12.4144 10.9287 18.4845 6.96211C24.5405 3.00476 32.7611 1.27399 43.2951 3.47877L43.7049 1.52119Z"
                                fill="currentColor" class="fill-gray-400" />
                        </svg>
                        <span
                            class="inline-block mt-2 whitespace-nowrap text-[10px] leading-5 font-semibold tracking-wide uppercase bg-yellow-500 text-white rounded-full py-1 px-2">PROMO</span>
                    </span>
                </span>
            </label>
        </div>

        <div class="md:space-x-6 md:flex lg:space-x-8">
            <!-- Events -->
            <div class="max-w-[500px] mx-auto flex flex-col my-10 p-6 text-center transition bg-gray-100 border rounded-lg shadow-lg md:w-1/3 md:hover:scale-[1.02]"
                x-data="{
                    {{-- annualFoundationUrl: '{{ route('checkout', ['price' => config('pricing.plans.foundation_plan.prices.annual')]) }}',
                                monthlyFoundationUrl: '{{ route('checkout', ['price' => config('pricing.plans.foundation_plan.prices.monthly')]) }}' --}}
                }">
                <div class="items-center justify-between pb-2 lg:flex text-start">
                    <h2 class="text-2xl font-semibold">Eventos</h2>
                    <span class="text-4xl font-bold underline-orange"
                        x-text="isExtended ? '$5.799' : '$4.499'"></span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-16 md:size-20">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                </svg>

                <!-- Features: Eventos -->
                <ul class="flex-grow my-4">
                    <li class="flex mb-2 text-start"
                        x-text="isExtended 
                                        ? '✔ Cobertura completa de eventos de hasta 5 horas' 
                                        : '✔ Cobertura de eventos de 2 horas'">
                    </li>
                    <li class="flex mb-2 text-start"
                        x-text="isExtended 
                                        ? '✔ Álbum digital con hasta 100 fotografías' 
                                        : '✔ 50 fotografías editadas entregadas en formato digital'">
                    </li>
                    <li class="flex mb-2 text-start"
                        x-text="isExtended 
                                        ? '✔ Sesión previa al evento (30 minutos)' 
                                        : '✔ Fotografías grupales y retratos individuales'">
                    </li>
                    <li class="flex mb-2 text-start"
                        x-text="isExtended 
                                        ? '✔ Video destacado del evento (2-3 minutos)' 
                                        : '✔ Fotografías disponibles en 72 horas'">
                    </li>
                </ul>

                @guest
                    <a :href="isExtended ? annualFoundationUrl : monthlyFoundationUrl"
                        class="flex items-center justify-center w-full px-4 py-2 my-2 mt-auto text-gray-100 rounded-lg hover:blur-xs hover:cursor-pointer bg-gray-950">Obtener
                        sesión
                    </a>
                @endguest
            </div>

            <!-- Polaroids (Center Highlighted) -->
            <div class="max-w-[500px] mx-auto flex flex-col my-10 p-6 text-center transition transform md:scale-110 bg-gray-950 border rounded-lg shadow-lg md:w-1/3 md:hover:scale-[1.12]"
                x-data="{
                    {{-- annualStructuralUrl: '{{ route('checkout', ['price' => config('pricing.plans.structural_plan.prices.annual')]) }}',
                                    monthlyStructuralUrl: '{{ route('checkout', ['price' => config('pricing.plans.structural_plan.prices.monthly')]) }}' --}}
                }">
                <div class="items-center justify-between pb-2 text-gray-100 lg:flex text-start">
                    <h2 class="text-2xl font-semibold">Polaroids</h2>
                    <span class="text-4xl font-bold underline-orange"
                        x-text="isExtended ? '$3.199' : '$2.499'"></span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="text-white size-16 md:size-20">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                </svg>

                <!-- Features: Polaroids -->
                <ul class="flex-grow my-4">
                    <li class="flex mb-2 text-gray-200 text-start"
                        x-text="isExtended 
                                        ? '✔ Acceso exclusivo a la galería completa de fotos polaroid' 
                                        : '✔ 10 fotografías digitales a color'">
                    </li>
                    <li class="flex mb-2 text-gray-200 text-start"
                        x-text="isExtended 
                                        ? '✔ Actualizaciones semanales de la colección' 
                                        : '✔ Asesoramiento en vestuario y estética'">
                    </li>
                    <li class="flex mb-2 text-gray-200 text-start"
                        x-text="isExtended 
                                        ? '✔ Prioridad en las ediciones limitadas' 
                                        : '✔ Estudio personal con fondo blanco'">
                    </li>
                    <li class="flex mb-2 text-gray-200 text-start"
                        x-text="isExtended 
                                        ? '✔ Envío mensual de copias físicas (hasta 5)' 
                                        : '✔ 40 minutos de sesión en estudio'">
                    </li>
                </ul>

                @guest
                    <a :href="isExtended ? annualStructuralUrl : monthlyStructuralUrl"
                        class="flex items-center justify-center w-full px-4 py-2 my-2 mt-auto text-gray-900 bg-yellow-500 rounded-lg hover:blur-xs hover:cursor-pointer">Obtener
                        sesión
                    </a>
                @endguest
            </div>

            <!-- Fashion -->
            <div class="max-w-[500px] mx-auto flex flex-col my-10 p-6 text-center transition bg-gray-100 border rounded-lg shadow-lg md:w-1/3 md:hover:scale-[1.02]"
                x-data="{
                    {{-- annualMasterUrl: '{{ route('checkout', ['price' => config('pricing.plans.master_plan.prices.annual')]) }}',
                                        monthlyMasterUrl: '{{ route('checkout', ['price' => config('pricing.plans.master_plan.prices.monthly')]) }}' --}}
                }">
                <div class="items-center justify-between pb-2 lg:flex text-start">
                    <h2 class="text-2xl font-semibold">Moda</h2>
                    <span class="text-4xl font-bold underline-orange"
                        x-text="isExtended ? '$4.499' : '$3.199'"></span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-16 md:size-20">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
                </svg>

                <!-- Features: Moda -->
                <ul class="flex-grow my-4">
                    <li class="flex mb-2 text-start"
                        x-text="isExtended 
                                        ? '✔ Editoriales de moda exclusivas' 
                                        : '✔ Sesión con dirección de pose profesional'">
                    </li>
                    <li class="flex mb-2 text-start"
                        x-text="isExtended 
                                        ? '✔ Asesoramiento personalizado de estilo y tendencia' 
                                        : '✔ 15 fotografías editadas en alta resolución'">
                    </li>
                    <li class="flex mb-2 text-start"
                        x-text="isExtended 
                                        ? '✔ Acceso a una galería privada online para elegir tus fotos favoritas' 
                                        : '✔ Producción de vestuario y maquillaje'">
                    </li>
                    <li class="flex mb-2 text-start"
                        x-text="isExtended 
                                        ? '✔ Reportajes en ubicaciones exclusivas seleccionadas' 
                                        : '✔ Entrega digital en un plazo de 7 días'">
                    </li>
                </ul>

                @guest
                    <a :href="isExtended ? annualMasterUrl : monthlyMasterUrl"
                        class="flex items-center justify-center w-full px-4 py-2 text-gray-100 rounded-lg hover:blur-xs hover:cursor-pointer bg-gray-950">Obtener
                        sesión
                    </a>
                @endguest
            </div>
        </div>

        <p class="py-10 text-sm text-center text-gray-700 border-b border-gray-300">
            Los precios que se muestran son en pesos uruguayos y no hay cargos extra.
        </p>
    </section>
</div>
