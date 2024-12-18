<x-app-layout>
    <div class="flex flex-col pt-12 space-y-32 sm:pt-0">
        <!-- Header -->
        <section class="flex flex-col items-start justify-end w-full min-h-screen py-12 bg-center bg-cover"
            style="background-image: url( {{ Storage::disk('s3')->url($randomPhotoshoot->header_photo) }}); background-position: top;">
            <div class="absolute inset-0 h-screen mt-12 bg-black sm:mt-0 bg-opacity-30"></div>

            <div class="relative z-10 w-full px-4 mx-auto space-y-6 lg:px-8 sm:px-6 max-w-7xl text-start">
                @php
                    // Divide el título en palabras
                    $words = explode(' ', $randomPhotoshoot->name);
                    // Calcula el índice de división
                    $splitIndex = ceil(count($words) / 2);
                    // Separa las palabras en dos partes
                    $firstPart = implode(' ', array_slice($words, 0, $splitIndex));
                    $secondPart = implode(' ', array_slice($words, $splitIndex));
                @endphp

                <div class="flex items-center gap-12">
                    <h1 class="text-6xl font-bold text-white uppercase md:text-7xl">
                        {{ $firstPart }}
                        <span class="super-thin">{{ $secondPart }}</span>
                    </h1>

                    @can('modify-page')
                        <a wire:navigate href="{{ route('photoshoot.edit', $randomPhotoshoot->slug) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="text-gray-300 size-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </a>
                    @endcan
                </div>

                <p class="max-w-2xl leading-relaxed text-gray-200 text-md md:text-lg">
                    {{ $randomPhotoshoot->description }}</p>

                <!-- CTA -->
                <div
                    class="items-center inline-block px-10 py-2 text-2xl font-medium text-center transition duration-300 ease-in-out bg-transparent border border-gray-300 rounded-full hover:blur-xs hover:cursor-pointer sm:w-auto backdrop-blur-md hover:backdrop-blur-lg hover:bg-white/10">
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

                <!-- Date & Time -->
                <div class="">
                    <p class="text-lg text-gray-300">
                        {{ \Carbon\Carbon::parse($randomPhotoshoot->date)->toFormattedDateString() }}</p>
                    <p class="text-gray-400 text-md">{{ $randomPhotoshoot->location }}</p>
                </div>
            </div>
        </section>

        <!-- Photoshoot photo gallery -->
        <section class="mt-12 px-1 space-y-6 pb-[20vh]">
            <livewire:categories.show :id="$category->id" />
        </section>
    </div>
</x-app-layout>
