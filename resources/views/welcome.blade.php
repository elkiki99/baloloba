<x-app-layout>
    <div class="w-full min-h-screen bg-center bg-cover "
        style="background-image: url('{{ asset('header1.jpg') }}'); background-position: top;">
        <div class="absolute inset-0 bg-black bg-opacity-30"></div>

        <div class="mx-auto max-w-7xl">
            <div class="absolute z-10 mx-auto space-y-6 top-1/2 ">
                <h1 class="font-bold text-white text-9xl">BALO LOBA</h1>
                <p class="text-2xl text-gray-200">FOTOGRAFÍA DE AUTOR EN RETRATOS Y MODA</p>

                <!-- CTA -->
                <div
                    class="items-center inline-block px-10 py-2 mx-auto text-3xl font-medium text-center transition duration-300 ease-in-out bg-transparent border border-gray-300 rounded-full hover:cursor-pointer sm:w-auto backdrop-blur-md hover:backdrop-blur-lg hover:bg-white/10">
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
    </div>

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

    <!-- Marquee -->
    <x-balo-loba-marquee />
</x-app-layout>
