<x-app-layout>
    <!-- Marquee -->
    <div class="pt-12 sm:pt-0">
        <x-balo-loba-marquee />
    </div>

    <div class="flex flex-col space-y-32">
        <!-- Header -->
        <section class="flex flex-col items-start justify-center w-full min-h-screen bg-center bg-cover"
            style="background-image: url('{{ asset('pipi_header.jpg') }}'); background-position: top;">
            <div class="absolute inset-0 bg-black mt-[68px] sm:mt-5 h-screen bg-opacity-50"></div>

            <div class="relative z-10 w-full px-6 mx-auto space-y-6 max-w-7xl text-start">
                <h1 class="text-6xl font-bold text-white uppercase md:text-9xl">{{ config('app.name') }}</h1>
                <p class="max-w-xl text-xl text-gray-100 md:text-2xl">Fotografía de autor en retratos, moda y eventos</p>

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
        <section class="mt-12 space-y-6">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
                <h1 class="text-5xl font-bold underline md:text-7xl decoration-yellow-500">PORTFOLIO</h1>
            </div>
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

        <!-- About me -->
        <section class="px-4 mt-12 space-y-6 sm:px-6 md:px-8">  
            <div class="mx-auto max-w-7xl">
                <h1 class="text-5xl font-bold underline md:text-7xl decoration-yellow-500">SOBRE MI</h1>

                <div class="items-center justify-between gap-10 mx-auto mt-6 lg:flex lg:flex-row-reverse max-w-7xl">
                    <div class="lg:w-1/2">
                        <img class="object-contain w-full h-auto" src="{{ asset('cami2.jpg') }}"
                            alt="Camila Fernández">
                    </div>

                    <div
                        class="lg:w-1/2 mt-6 space-y-6 lg:mt-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-yellow-500 via-white to-white">

                        <h1 class="text-6xl font-bold lg:text-8xl">Camila Fernández</h1>

                        <div class="">
                            <p class="text-xl text-gray-800">Especializada en retratos, moda y eventos con un enfoque
                                artístico
                                único.
                            </p>
                            <p class="text-base text-gray-700">- Fundadora y alma creativa detrás de Balo Loba.
                            </p>
                        </div>

                        <!-- Button -->
                        <div
                            class="items-center inline-block px-10 py-2 text-2xl font-medium text-center transition duration-300 ease-in-out bg-transparent border border-gray-900 rounded-full hover:cursor-pointer sm:w-auto backdrop-blur-md hover:backdrop-blur-lg hover:bg-yellow-100">
                            <a href="#" class="flex items-center text-gray-800 hover:text-gray-900">
                                SOBRE MI
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="mt-12 space-y-6">
            <div class="mx-auto max-w-7xl">
                <h1 class="px-4 text-5xl font-bold underline md:text-7xl sm:px-6 md:px-8 decoration-yellow-500">TESTIMONIOS</h1>

                <div class="grid-cols-2 gap-6 px-0 mt-6 space-y-4 md:space-y-0 md:grid sm:px-6 md:px-8">
                    <!-- Testimonial 1 -->
                    <blockquote
                        class="relative w-full max-w-3xl p-4 pb-6 mx-auto border-b border-gray-200 rounded shadow md:p-8">
                        <footer class="pb-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="rounded-full size-24" src="{{ asset('vale.jpg') }}"
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
                                                <img src="{{ asset('vale.jpg') }}" alt="Valentina Camejo"
                                                    class="rounded-full w-14 h-14" />
                                                <div class="relative">
                                                    <p class="mb-1 font-bold">@valentinacamejo16</p>
                                                    <p class="mb-1 text-sm text-gray-600">Valentina Camejo, Miss
                                                        Uruguay 2021 y directora de Miss Océano y Turismo. Lidera con
                                                        excelencia uno de los certámenes internacionales de belleza más
                                                        destacados de Uruguay.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-lg text-gray-500">Miss Uruguay 2021</div>
                                    </div>
                                </div>
                        </footer>

                        {{-- <svg class="absolute w-16 h-16 mt-6 text-gray-100 transform -translate-x-6 -translate-y-8 left-10 top-1/2"
                            width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M7.39762 10.3C7.39762 11.0733 7.14888 11.7 6.6514 12.18C6.15392 12.6333 5.52552 12.86 4.76621 12.86C3.84979 12.86 3.09047 12.5533 2.48825 11.94C1.91222 11.3266 1.62421 10.4467 1.62421 9.29999C1.62421 8.07332 1.96459 6.87332 2.64535 5.69999C3.35231 4.49999 4.33418 3.55332 5.59098 2.85999L6.4943 4.25999C5.81354 4.73999 5.26369 5.27332 4.84476 5.85999C4.45201 6.44666 4.19017 7.12666 4.05926 7.89999C4.29491 7.79332 4.56983 7.73999 4.88403 7.73999C5.61716 7.73999 6.21938 7.97999 6.69067 8.45999C7.16197 8.93999 7.39762 9.55333 7.39762 10.3ZM14.6242 10.3C14.6242 11.0733 14.3755 11.7 13.878 12.18C13.3805 12.6333 12.7521 12.86 11.9928 12.86C11.0764 12.86 10.3171 12.5533 9.71484 11.94C9.13881 11.3266 8.85079 10.4467 8.85079 9.29999C8.85079 8.07332 9.19117 6.87332 9.87194 5.69999C10.5789 4.49999 11.5608 3.55332 12.8176 2.85999L13.7209 4.25999C13.0401 4.73999 12.4903 5.27332 12.0713 5.85999C11.6786 6.44666 11.4168 7.12666 11.2858 7.89999C11.5215 7.79332 11.7964 7.73999 12.1106 7.73999C12.8437 7.73999 13.446 7.97999 13.9173 8.45999C14.3886 8.93999 14.6242 9.55333 14.6242 10.3Z"
                                fill="currentColor" />
                        </svg> --}}

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
                                    <img class="z-20 rounded-full size-24" src="{{ asset('vico.jpg') }}"
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
                                                <img src="{{ asset('vico.jpg') }}" alt="Victoria Otero"
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

                        {{-- <svg class="absolute w-16 h-16 mt-6 text-gray-100 transform -translate-x-6 -translate-y-8 left-10 top-1/2"
                                            width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path
                                                d="M7.39762 10.3C7.39762 11.0733 7.14888 11.7 6.6514 12.18C6.15392 12.6333 5.52552 12.86 4.76621 12.86C3.84979 12.86 3.09047 12.5533 2.48825 11.94C1.91222 11.3266 1.62421 10.4467 1.62421 9.29999C1.62421 8.07332 1.96459 6.87332 2.64535 5.69999C3.35231 4.49999 4.33418 3.55332 5.59098 2.85999L6.4943 4.25999C5.81354 4.73999 5.26369 5.27332 4.84476 5.85999C4.45201 6.44666 4.19017 7.12666 4.05926 7.89999C4.29491 7.79332 4.56983 7.73999 4.88403 7.73999C5.61716 7.73999 6.21938 7.97999 6.69067 8.45999C7.16197 8.93999 7.39762 9.55333 7.39762 10.3ZM14.6242 10.3C14.6242 11.0733 14.3755 11.7 13.878 12.18C13.3805 12.6333 12.7521 12.86 11.9928 12.86C11.0764 12.86 10.3171 12.5533 9.71484 11.94C9.13881 11.3266 8.85079 10.4467 8.85079 9.29999C8.85079 8.07332 9.19117 6.87332 9.87194 5.69999C10.5789 4.49999 11.5608 3.55332 12.8176 2.85999L13.7209 4.25999C13.0401 4.73999 12.4903 5.27332 12.0713 5.85999C11.6786 6.44666 11.4168 7.12666 11.2858 7.89999C11.5215 7.79332 11.7964 7.73999 12.1106 7.73999C12.8437 7.73999 13.446 7.97999 13.9173 8.45999C14.3886 8.93999 14.6242 9.55333 14.6242 10.3Z"
                                                fill="currentColor" />
                                        </svg> --}}

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
                                    <img class="rounded-full size-24" src="{{ asset('pia.jpg') }}"
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
                                                <img src="{{ asset('pia.jpg') }}" alt="Pia Mallarini"
                                                    class="rounded-full w-14 h-14" />
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

                        {{-- <svg class="absolute w-16 h-16 mt-6 text-gray-100 transform -translate-x-6 -translate-y-8 left-10 top-1/2"
                            width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M7.39762 10.3C7.39762 11.0733 7.14888 11.7 6.6514 12.18C6.15392 12.6333 5.52552 12.86 4.76621 12.86C3.84979 12.86 3.09047 12.5533 2.48825 11.94C1.91222 11.3266 1.62421 10.4467 1.62421 9.29999C1.62421 8.07332 1.96459 6.87332 2.64535 5.69999C3.35231 4.49999 4.33418 3.55332 5.59098 2.85999L6.4943 4.25999C5.81354 4.73999 5.26369 5.27332 4.84476 5.85999C4.45201 6.44666 4.19017 7.12666 4.05926 7.89999C4.29491 7.79332 4.56983 7.73999 4.88403 7.73999C5.61716 7.73999 6.21938 7.97999 6.69067 8.45999C7.16197 8.93999 7.39762 9.55333 7.39762 10.3ZM14.6242 10.3C14.6242 11.0733 14.3755 11.7 13.878 12.18C13.3805 12.6333 12.7521 12.86 11.9928 12.86C11.0764 12.86 10.3171 12.5533 9.71484 11.94C9.13881 11.3266 8.85079 10.4467 8.85079 9.29999C8.85079 8.07332 9.19117 6.87332 9.87194 5.69999C10.5789 4.49999 11.5608 3.55332 12.8176 2.85999L13.7209 4.25999C13.0401 4.73999 12.4903 5.27332 12.0713 5.85999C11.6786 6.44666 11.4168 7.12666 11.2858 7.89999C11.5215 7.79332 11.7964 7.73999 12.1106 7.73999C12.8437 7.73999 13.446 7.97999 13.9173 8.45999C14.3886 8.93999 14.6242 9.55333 14.6242 10.3Z"
                                fill="currentColor" />
                        </svg> --}}

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
                                    <img class="rounded-full size-24" src="{{ asset('diana.jpg') }}"
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
                                                <img src="{{ asset('diana.jpg') }}" alt="Diana Morgades"
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

                        {{-- <svg class="absolute w-16 h-16 mt-6 text-gray-100 transform -translate-x-6 -translate-y-8 left-10 top-1/2"
                            width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M7.39762 10.3C7.39762 11.0733 7.14888 11.7 6.6514 12.18C6.15392 12.6333 5.52552 12.86 4.76621 12.86C3.84979 12.86 3.09047 12.5533 2.48825 11.94C1.91222 11.3266 1.62421 10.4467 1.62421 9.29999C1.62421 8.07332 1.96459 6.87332 2.64535 5.69999C3.35231 4.49999 4.33418 3.55332 5.59098 2.85999L6.4943 4.25999C5.81354 4.73999 5.26369 5.27332 4.84476 5.85999C4.45201 6.44666 4.19017 7.12666 4.05926 7.89999C4.29491 7.79332 4.56983 7.73999 4.88403 7.73999C5.61716 7.73999 6.21938 7.97999 6.69067 8.45999C7.16197 8.93999 7.39762 9.55333 7.39762 10.3ZM14.6242 10.3C14.6242 11.0733 14.3755 11.7 13.878 12.18C13.3805 12.6333 12.7521 12.86 11.9928 12.86C11.0764 12.86 10.3171 12.5533 9.71484 11.94C9.13881 11.3266 8.85079 10.4467 8.85079 9.29999C8.85079 8.07332 9.19117 6.87332 9.87194 5.69999C10.5789 4.49999 11.5608 3.55332 12.8176 2.85999L13.7209 4.25999C13.0401 4.73999 12.4903 5.27332 12.0713 5.85999C11.6786 6.44666 11.4168 7.12666 11.2858 7.89999C11.5215 7.79332 11.7964 7.73999 12.1106 7.73999C12.8437 7.73999 13.446 7.97999 13.9173 8.45999C14.3886 8.93999 14.6242 9.55333 14.6242 10.3Z"
                                fill="currentColor" />
                        </svg> --}}

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

        <!-- Contact -->
        <section class="mt-12 pb-[20vh] space-y-6 sm:px-6 md:px-8 px-0">
            <div class="space-y-6 md:mx-auto max-w-7xl">
                <h1 class="px-4 text-5xl font-bold underline md:text-7xl decoration-yellow-500">CONTACTO</h1>

                <div>
                    <div
                        class="
                        max-w-xl p-8 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))]
                        from-gray-200
                        via-gray-100
                        to-gray-50 sm:rounded-md shadow-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">
                                    {{ __('Hablemos') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-700 dark:text-gray-400">
                                    {{ __('¡Mandame tus dudas por acá! Siempre respondo.') }}
                                </p>
                            </header>

                            <form wire:submit="sendMessage" class="mt-6 space-y-6">
                                <div>
                                    <x-input-label class="" for="name" :value="__('Nombre')" />
                                    <x-text-input wire:model="name" id="name" name="name" type="text"
                                        class="block w-full mt-1" required autocomplete="name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <x-input-label class="" for="email" :value="__('Email')" />
                                    <x-text-input wire:model="email" id="email" name="email" type="email"
                                        class="block w-full mt-1" required autocomplete="username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>

                                <div>
                                    <x-input-label class="" for="phone" :value="__('Teléfono')" />
                                    <x-text-input wire:model="phone" id="phone" name="phone" type="tel"
                                        class="block w-full mt-1" required autocomplete="phone" />
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                </div>

                                <div>
                                    <x-input-label class="" for="message" :value="__('Tu consulta')" />
                                    <textarea wire:model="message" id="message" name="message"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-500 focus:ring-yellow-500 dark:focus:ring-yellow-500"
                                        rows="4" required autocomplete="message"></textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('message')" />
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Enviar') }}</x-primary-button>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
