<x-app-layout>
    <div class="flex flex-col space-y-32">
        <!-- Header -->
        <section class="flex flex-col items-start justify-center w-full min-h-screen bg-center bg-cover"
            style="background-image: url('{{ asset('header.jpg') }}'); background-position: top;">
            <div class="absolute inset-0 h-screen bg-black bg-opacity-30"></div>

            <div class="relative z-10 w-full px-6 mx-auto space-y-6 max-w-7xl text-start">
                <h1 class="text-6xl font-bold text-white uppercase md:text-9xl">PORTFOLIO</h1>
                <p class="max-w-xl text-xl text-gray-100 md:text-2xl">Explora mi catálogo</p>

                <!-- CTA -->
                <div
                    class="items-center inline-block px-10 py-2 text-2xl font-medium text-center transition duration-300 ease-in-out bg-transparent border border-gray-300 rounded-full hover:cursor-pointer sm:w-auto backdrop-blur-md hover:backdrop-blur-lg hover:bg-white/10">
                    <a href="#" class="flex items-center text-white hover:text-gray-200">
                        AGENDATE
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 ml-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
        
        <!-- Porfolio -->
        <section class="mt-12 space-y-6 pb-[20vh]">
            <div class="grid gap-1 sm:grid-cols-2 md:grid-cols-3">
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
        </section>
    </div>
</x-app-layout>