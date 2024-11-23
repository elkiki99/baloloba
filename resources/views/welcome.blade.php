<x-app-layout>
    <div class="w-full min-h-screen bg-center bg-cover "
        style="background-image: url('{{ asset('header1.jpg') }}'); background-position: top;">
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>

        <div class="mx-auto max-w-7xl">
            <div class="absolute z-10 mx-auto ml-12 space-y-6 text-white top-1/2 ">
                <h1 class="font-bold text-9xl">BALO LOBA</h1>
                <p class="text-2xl">FOTOGRAFÍA DE AUTOR EN RETRATOS Y MODA</p>

                <!-- CTA -->
                <div
                    class="items-center inline-block px-10 py-2 mx-auto text-xl font-medium text-center transition duration-300 ease-in-out bg-transparent border-gray-300 rounded-full sm:w-auto backdrop-blur-md hover:backdrop-blur-lg hover:bg-white/10">
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
        {{-- <h1 class="font-bold text-9xl">BALO LOBA BALO LOBA BALO LOBA BALO LOBA BALO LOBA BALO LOBA BALO LOBA BALO LOBA BALO LOBA BALO LOBA BALO LOBA BALO LOBA BALO LOBA BALO LOBA BALO LOBA BALO LOBA BALO LOBA BALO LOBA</h1> --}}
        <div class="mx-auto max-w-7xl">
            <h1 class="font-bold text-9xl">PORTFOLIO</h1>
        </div>
        <div class="grid grid-cols-3 gap-1 mx-1">
            <a href="{{ asset('308234441_1215140699031874_3114405947350534715_n.jpg')}}"><img class="max-h-[700px]" src="{{ asset('308234441_1215140699031874_3114405947350534715_n.jpg')}}"></a>
            <a href="{{ asset('5.jpg')}}"><img class="max-h-[700px]" src="{{ asset('5.jpg')}}"></a>
            <a href="{{ asset('3 (4).jpg')}}"><img class="max-h-[700px]" src="{{ asset('3 (4).jpg')}}"></a>
        </div>
    </div>
</x-app-layout>
