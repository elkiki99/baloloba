<x-app-layout>
    <!-- Marquee -->
    <div class="pt-12 sm:pt-0">
        <x-balo-loba-marquee />
    </div>

    <div class="flex flex-col space-y-32">
        @php
            $header = \App\Models\Header::where('id', 1)->first();
        @endphp
        
        <!-- Welcome header -->
        <livewire:headers.show :header="$header" />

        <!-- Porfolio -->
        <section class="px-1 mt-12 space-y-6">
            <div class="mx-auto max-w-7xl">
                <h1 class="px-4 text-5xl font-bold underline md:text-7xl sm:px-6 lg:px-8 decoration-yellow-500">
                    Portfolio</h1>
            </div>
            <div class="grid gap-1 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($photoshoots as $photoshoot)
                    <x-photo-shoot-card :photoshoot="$photoshoot" />
                @endforeach
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
            $section = \App\Models\Section::where('id', 1)->first();
        @endphp
        
        <livewire:sections.show.about-me :section="$section" />

        <!-- Testimonials -->
        <section class="mt-12 space-y-6">
            <div class="mx-auto max-w-7xl">
                <h1 class="px-4 text-5xl font-bold underline md:text-7xl sm:px-6 lg:px-8 decoration-yellow-500">
                    Testimonios</h1>

                <div class="grid-cols-2 gap-6 px-0 mt-6 space-y-4 md:space-y-0 md:grid sm:px-6 lg:px-8">
                    <!-- Testimonial 1 -->
                    <blockquote
                        class="relative w-full max-w-3xl p-4 pb-6 mx-auto border-b border-gray-200 rounded shadow md:p-8">
                        <footer class="pb-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="rounded-full size-24" src="{{ asset('home/vale_quote.jpg') }}"
                                        alt="Valentina Camejo">
                                </div>
                                <div class="ml-4">
                                    <div x-data="{
                                        hoverCardHovered: false,
                                        hoverCardDelay: 600,
                                        hoverCardLeaveDelay: 500,
                                        hoverCardTimout: null,
                                        hoverCardLeaveTimeout: null,
                                        hoverCardEnter() {
                                            clearTimeout(this.hoverCardLeaveTimeout);
                                            if (this.hoverCardHovered) return;
                                            clearTimeout(this.hoverCardTimout);
                                            this.hoverCardTimout = setTimeout(() => {
                                                this.hoverCardHovered = true;
                                            }, this.hoverCardDelay);
                                        },
                                        hoverCardLeave() {
                                            clearTimeout(this.hoverCardTimout);
                                            if (!this.hoverCardHovered) return;
                                            clearTimeout(this.hoverCardLeaveTimeout);
                                            this.hoverCardLeaveTimeout = setTimeout(() => {
                                                this.hoverCardHovered = false;
                                            }, this.hoverCardLeaveDelay);
                                        }
                                    }" class="relative" @mouseover="hoverCardEnter()"
                                        @mouseleave="hoverCardLeave()">
                                        <div
                                            class="text-2xl font-semibold text-gray-800 hover:underline hover:cursor-pointer">
                                            Valentina Camejo</div>
                                        <div x-show="hoverCardHovered"
                                            class="absolute top-0 w-[365px] max-w-lg mt-5 z-30 -translate-x-1/2 translate-y-3 left-1/2"
                                            x-cloak>
                                            <div x-show="hoverCardHovered"
                                                class="w-[full] h-auto bg-white space-x-3 p-5 flex items-start rounded-md shadow-sm border border-neutral-200/70"
                                                x-transition>
                                                <img src="{{ asset('home/vale_quote.jpg') }}" alt="Valentina Camejo"
                                                    class="rounded-full w-14 h-14" />
                                                <div class="relative">
                                                    <p class="mb-1 font-bold">@valentinacamejo16</p>
                                                    <p class="mb-1 text-sm text-gray-600">Valentina Camejo, Miss Mundo
                                                        Uruguay 2020 y directora de Miss Océano y Turismo. Lidera con
                                                        excelencia uno de los certámenes internacionales de belleza más
                                                        destacados de Uruguay.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-lg text-gray-500">Miss Mundo Uruguay 2020</div>
                                    </div>
                                </div>
                        </footer>

                        <div class="relative z-10">
                            <p class="text-gray-800 sm:text-xl"><em>
                                    “Camila es una artista en todo el sentido de la palabra. Ha trabajado con nuestras
                                    modelos en producciones increíbles, capturando su esencia con una visión única. Cada
                                    sesión con ella es mágica.”
                                </em></p>
                        </div>
                    </blockquote>

                    <!-- Testimonial 2 -->
                    <blockquote
                        class="relative w-full max-w-3xl p-4 pb-6 mx-auto border-b border-gray-200 rounded shadow md:p-8">

                        <footer class="pb-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="z-20 rounded-full size-24" src="{{ asset('home/vicoo_quote.jpg') }}"
                                        alt="Victoria Otero">
                                </div>
                                <div class="ml-4">
                                    <div x-data="{
                                        hoverCardHovered: false,
                                        hoverCardDelay: 600,
                                        hoverCardLeaveDelay: 500,
                                        hoverCardTimout: null,
                                        hoverCardLeaveTimeout: null,
                                        hoverCardEnter() {
                                            clearTimeout(this.hoverCardLeaveTimeout);
                                            if (this.hoverCardHovered) return;
                                            clearTimeout(this.hoverCardTimout);
                                            this.hoverCardTimout = setTimeout(() => {
                                                this.hoverCardHovered = true;
                                            }, this.hoverCardDelay);
                                        },
                                        hoverCardLeave() {
                                            clearTimeout(this.hoverCardTimout);
                                            if (!this.hoverCardHovered) return;
                                            clearTimeout(this.hoverCardLeaveTimeout);
                                            this.hoverCardLeaveTimeout = setTimeout(() => {
                                                this.hoverCardHovered = false;
                                            }, this.hoverCardLeaveDelay);
                                        }
                                    }" class="relative" @mouseover="hoverCardEnter()"
                                        @mouseleave="hoverCardLeave()">
                                        <div
                                            class="text-2xl font-semibold text-gray-800 hover:underline hover:cursor-pointer">
                                            Victoria Otero</div>
                                        <div x-show="hoverCardHovered"
                                            class="absolute top-0 w-[365px] max-w-lg mt-5 z-30 -translate-x-1/2 translate-y-3 left-1/2"
                                            x-cloak>
                                            <div x-show="hoverCardHovered"
                                                class="w-[full] h-auto bg-white space-x-3 p-5 flex items-start rounded-md shadow-sm border border-neutral-200/70"
                                                x-transition>
                                                <img src="{{ asset('home/vicoo_quote.jpg') }}" alt="Victoria Otero"
                                                    class="rounded-full w-14 h-14" />
                                                <div class="relative">
                                                    <p class="mb-1 font-bold">@vicootero</p>
                                                    <p class="mb-1 text-sm text-gray-600">Victoria Otero es una actriz
                                                        uruguaya profesional, se destaca en teatro independiente.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-lg text-gray-500">Actriz</div>
                                    </div>
                                </div>
                        </footer>

                        <div class="relative z-10">
                            <p class="text-gray-800 sm:text-xl"><em>
                                    “Fue un placer trabajar con Camila, entendió perfecto lo que quería en mis fotos,
                                    sin
                                    dudas volvería a elegir este servicio!”
                                </em></p>
                        </div>
                    </blockquote>

                    <!-- Testimonial 3 -->
                    <blockquote
                        class="relative w-full max-w-3xl p-4 pb-6 mx-auto border-b border-gray-200 rounded shadow md:p-8">
                        <footer class="pb-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="rounded-full size-24" src="{{ asset('home/pia_mallarin_quote.jpg') }}"
                                        alt="Pia Mallarini">
                                </div>
                                <div class="ml-4">
                                    <div x-data="{
                                        hoverCardHovered: false,
                                        hoverCardDelay: 600,
                                        hoverCardLeaveDelay: 500,
                                        hoverCardTimout: null,
                                        hoverCardLeaveTimeout: null,
                                        hoverCardEnter() {
                                            clearTimeout(this.hoverCardLeaveTimeout);
                                            if (this.hoverCardHovered) return;
                                            clearTimeout(this.hoverCardTimout);
                                            this.hoverCardTimout = setTimeout(() => {
                                                this.hoverCardHovered = true;
                                            }, this.hoverCardDelay);
                                        },
                                        hoverCardLeave() {
                                            clearTimeout(this.hoverCardTimout);
                                            if (!this.hoverCardHovered) return;
                                            clearTimeout(this.hoverCardLeaveTimeout);
                                            this.hoverCardLeaveTimeout = setTimeout(() => {
                                                this.hoverCardHovered = false;
                                            }, this.hoverCardLeaveDelay);
                                        }
                                    }" class="relative" @mouseover="hoverCardEnter()"
                                        @mouseleave="hoverCardLeave()">
                                        <div
                                            class="text-2xl font-semibold text-gray-800 hover:underline hover:cursor-pointer">
                                            Pia Mallarini</div>
                                        <div x-show="hoverCardHovered"
                                            class="absolute top-0 w-[365px] max-w-lg mt-5 z-30 -translate-x-1/2 translate-y-3 left-1/2"
                                            x-cloak>
                                            <div x-show="hoverCardHovered"
                                                class="w-[full] h-auto bg-white space-x-3 p-5 flex items-start rounded-md shadow-sm border border-neutral-200/70"
                                                x-transition>
                                                <img src="{{ asset('home/pia_mallarin_quote.jpg') }}"
                                                    alt="Pia Mallarini" class="rounded-full w-14 h-14" />
                                                <div class="relative">
                                                    <p class="mb-1 font-bold">@piamallarini_</p>
                                                    <p class="mb-1 text-sm text-gray-600">Pia Mallarini, actriz
                                                        uruguaya
                                                        profesional que se destaca principalmente en teatro nacional.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-lg text-gray-500">Actriz</div>
                                    </div>
                                </div>
                        </footer>

                        <div class="relative z-10">
                            <p class="text-gray-800 sm:text-xl"><em>
                                    “Camila tiene un don para hacer que te sientas cómodo frente a la cámara. Su energía
                                    y profesionalismo son incomparables, y el resultado final es siempre sorprendente.
                                    ¡Es una genia!”
                                </em></p>
                        </div>
                    </blockquote>


                    <!-- Testimonial 4 -->
                    <blockquote
                        class="relative w-full max-w-3xl p-4 pb-6 mx-auto border-b border-gray-200 rounded shadow md:p-8">
                        <footer class="pb-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="rounded-full size-24" src="{{ asset('home/diana_quote.jpg') }}"
                                        alt="Diana Morgades">
                                </div>
                                <div class="ml-4">
                                    <div x-data="{
                                        hoverCardHovered: false,
                                        hoverCardDelay: 600,
                                        hoverCardLeaveDelay: 500,
                                        hoverCardTimout: null,
                                        hoverCardLeaveTimeout: null,
                                        hoverCardEnter() {
                                            clearTimeout(this.hoverCardLeaveTimeout);
                                            if (this.hoverCardHovered) return;
                                            clearTimeout(this.hoverCardTimout);
                                            this.hoverCardTimout = setTimeout(() => {
                                                this.hoverCardHovered = true;
                                            }, this.hoverCardDelay);
                                        },
                                        hoverCardLeave() {
                                            clearTimeout(this.hoverCardTimout);
                                            if (!this.hoverCardHovered) return;
                                            clearTimeout(this.hoverCardLeaveTimeout);
                                            this.hoverCardLeaveTimeout = setTimeout(() => {
                                                this.hoverCardHovered = false;
                                            }, this.hoverCardLeaveDelay);
                                        }
                                    }" class="relative" @mouseover="hoverCardEnter()"
                                        @mouseleave="hoverCardLeave()">
                                        <div
                                            class="text-2xl font-semibold text-gray-800 hover:underline hover:cursor-pointer">
                                            Diana Morgades</div>
                                        <div x-show="hoverCardHovered"
                                            class="absolute top-0 w-[365px] max-w-lg mt-5 z-30 -translate-x-1/2 translate-y-3 left-1/2"
                                            x-cloak>
                                            <div x-show="hoverCardHovered"
                                                class="w-[full] h-auto bg-white space-x-3 p-5 flex items-start rounded-md shadow-sm border border-neutral-200/70"
                                                x-transition>
                                                <img src="{{ asset('home/diana_quote.jpg') }}" alt="Diana Morgades"
                                                    class="rounded-full w-14 h-14" />
                                                <div class="relative">
                                                    <p class="mb-1 font-bold">@morgades_diana</p>
                                                    <p class="mb-1 text-sm text-gray-600">Diana Morgades, directora
                                                        nacional de Miss Teen Universal Uruguay y Miss Supranational.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-lg text-gray-500">Directora Nacional</div>
                                    </div>
                                </div>
                        </footer>

                        <div class="relative z-10">
                            <p class="text-gray-800 sm:text-xl"><em>
                                    “Trabajar con Camila es una experiencia increíble. Su creatividad y atención a los
                                    detalles hacen que cada sesión sea única, y el resultado final siempre supera
                                    cualquier expectativa. ¡100% recomendada!”
                                </em></p>
                        </div>
                    </blockquote>
                </div>
            </div>
        </section>

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
                        <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">
                            {{ __('¿Necesitas un presupuesto?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-700 dark:text-gray-400">
                            {{ __('Escribime en caso de necesitar más información sobre nuestros paquetes.') }}
                        </p>
                    </header>

                    <livewire:components.contact-form />
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
