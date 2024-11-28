<x-app-layout>
    <div class="flex flex-col pt-12 space-y-32 sm:pt-0">
        <!-- Header -->
        <section class="flex flex-col items-start justify-end w-full min-h-screen py-12 bg-center bg-cover"
            style="background-image: url('{{ asset($photoshoot->header_photo) }}'); background-position: top;">
            <div class="absolute inset-0 h-screen mt-12 bg-black sm:mt-0 bg-opacity-30"></div>

            <div class="relative z-10 w-full px-6 mx-auto space-y-6 max-w-7xl text-start">
                @php
                    // Divide el título en palabras
                    $words = explode(' ', $photoshoot->name);
                    // Calcula el índice de división
                    $splitIndex = ceil(count($words) / 2);
                    // Separa las palabras en dos partes
                    $firstPart = implode(' ', array_slice($words, 0, $splitIndex));
                    $secondPart = implode(' ', array_slice($words, $splitIndex));
                @endphp

                <h1 class="text-6xl font-bold text-white uppercase md:text-7xl">
                    {{ $firstPart }}
                    <span class="super-thin">{{ $secondPart }}</span>
                </h1>
                <p class="max-w-2xl text-lg leading-relaxed text-gray-200 md:text-xl">{{ $photoshoot->description }}</p>

                <!-- CTA -->
                <div
                    class="items-center inline-block px-10 py-2 text-2xl font-medium text-center transition duration-300 ease-in-out bg-transparent border border-gray-300 rounded-full hover:cursor-pointer sm:w-auto backdrop-blur-md hover:backdrop-blur-lg hover:bg-white/10">
                    <a href="{{ route('categories.index', $photoshoot->category) }}" wire:navigate
                        class="flex items-center text-white hover:text-gray-200">
                        + {{ $photoshoot->category->name}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 ml-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                </div>

                <!-- Date & Time -->
                <div class="">
                    <p class="text-lg text-gray-300">{{ \Carbon\Carbon::parse($photoshoot->date)->toFormattedDateString() }}</p>
                    <p class="text-gray-400 text-md">{{ $photoshoot->location }}</p>
                </div>
            </div>
        </section>

        <!-- Photoshoot photos -->
        <section class="mt-12 space-y-6 pb-[20vh]">
            <div class="grid gap-1 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($photoshoot->photos as $photo)
                    <div class="w-full h-full overflow-hidden">
                        <img class="object-cover w-full h-full" src="{{ asset($photo->filename) }}" alt="Photo">
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</x-app-layout>
