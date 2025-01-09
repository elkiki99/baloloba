<div class="bg-gradient-to-b from-white via-yellow-400 to-white">
    <section class="mx-auto md:px-4 max-w-7xl" x-data="{ isExtended: $el.querySelector('#checkbox').checked }">
        <h2 class="px-4 text-5xl font-bold underline md:text-7xl decoration-yellow-500 sm:px-6 lg:px-8">Paquetes</h2>
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
                        <svg class="h-8 w-14 sm:-me-6" width="45" height="25" viewBox="0 0 45 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
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

        <livewire:packages.show />

        <p class="py-10 text-sm text-center text-gray-700 border-b border-gray-300">
            Los precios que se muestran son en pesos uruguayos y no hay cargos extra.
        </p>
    </section>
</div>