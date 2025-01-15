<x-app-layout>
    <!-- Marquee -->
    <div class="pt-12 sm:pt-0">
        <x-balo-loba-marquee />
    </div>

    <div class="flex flex-col space-y-32">
        @php
            $header = \App\Models\Header::where('id', 1)->first() ?? null;
        @endphp

        <!-- Welcome header -->
        @if ($header)
            <livewire:headers.show :header="$header" />
        @endif

        <!-- Porfolio -->
        <section class="px-1 mt-12 space-y-6">
            <div class="mx-auto max-w-7xl">
                <h1 class="px-4 text-5xl font-bold underline md:text-7xl sm:px-6 lg:px-8 decoration-yellow-500">
                    Portfolio</h1>
            </div>
            <div class="grid gap-1 sm:grid-cols-2 md:grid-cols-3">
                @forelse ($photoshoots as $photoshoot)
                    <x-photo-shoot-card :photoshoot="$photoshoot" />
                @empty
                    <p class="px-4 max-w-7xl sm:px-6 lg:px-16">No hay photoshoots disponibles</p>
                @endforelse
            </div>

            <div class="flex">
                <a wire:navigate class="flex items-center gap-2 px-4 py-2 ml-auto hover:blur-xs hover:cursor-pointer"
                    href="{{ route('portfolio') }}">
                    <p>Ver portfolio completo</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </section>

        <!-- About me -->
        @php
            $section = \App\Models\Section::where('id', 1)->first() ?? null;
        @endphp

        @if ($section)
            <livewire:sections.show.about-me :section="$section" />
        @endif

        <!-- Testimonials -->
        <livewire:testimonials.show />

        <!-- Paquetes -->
        @include('packages.packages')

        <!-- Contacto -->
        <section class="space-y-6 pb-[20vh]">
            <h1
                class="px-4 mx-auto text-5xl text-transparent max-w-7xl sm:px-6 lg:px-8 md:text-7xl bg-clip-text bg-gradient-to-r from-black to-gray-800">
                <span class="font-bold text-black underline decoration-yellow-500">Contactame</span>
            </h1>

            <div class="px-0 mx-auto sm:px-6 lg:px-8 sm:max-w-7xl">
                <div
                    class="max-w-xl p-8 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))]
                            from-gray-200
                            via-gray-100
                            to-gray-50 sm:rounded-md shadow-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-800">
                            {{ __('¿Necesitas un presupuesto?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-700">
                            {{ __('Escribime en caso de necesitar más información sobre nuestros paquetes.') }}
                        </p>
                    </header>

                    <livewire:components.contact-form />
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
