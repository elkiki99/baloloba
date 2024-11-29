<x-app-layout>
    <div class="flex flex-col pt-12 space-y-32 sm:pt-0">
        <!-- Header -->
        <section class="flex flex-col items-start justify-center w-full min-h-screen bg-center bg-cover"
            style="background-image: url('{{ asset('home/vale_header.jpg') }}'); background-position: top;">
            <div class="absolute inset-0 h-screen mt-12 bg-black sm:mt-0 bg-opacity-30"></div>

            <div class="relative z-10 w-full px-6 mx-auto space-y-6 max-w-7xl text-start">
                <h1 class="text-6xl font-bold text-white uppercase md:text-9xl">PORT<span class="super-thin">FOLIO</span>
                </h1>
                <p class="max-w-2xl text-lg leading-relaxed text-gray-200 md:text-xl">Explora mi catálogo, conocé mi
                    trabajo</p>

                <!-- CTA -->
                <div
                    class="items-center inline-block px-10 py-2 text-2xl font-medium text-center transition duration-300 ease-in-out bg-transparent border border-gray-300 rounded-full hover:cursor-pointer sm:w-auto backdrop-blur-md hover:backdrop-blur-lg hover:bg-white/10">
                    <a href="{{ route('contact') }}" wire:navigate
                        class="flex items-center text-white hover:text-gray-200">
                        AGENDATE
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="ml-2 size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Porfolio -->
        <section class="mt-12 space-y-6 pb-[20vh]">
            <div class="grid gap-1 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($photoshoots as $photoshoot)
                    <x-photo-shoot-card :photoshoot="$photoshoot" />
                @endforeach
            </div>
        </section>
    </div>
</x-app-layout>
