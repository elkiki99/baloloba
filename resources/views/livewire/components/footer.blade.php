<?php

use Livewire\Volt\Component;
use App\Models\Footer;

new class extends Component {
    protected $listeners = [
        'footerUpdatedSuccessfully' => 'reloadComponent',
    ];

    public function reloadComponent()
    {
        $this->dispatch('$refresh');
    }

    public function with()
    {
        return [
            'footer' => Footer::all()->first(),
        ];
    }
}; ?>

<footer class="text-white from-black via-gray-950 bg-gradient-to-r to-gray-900 h-[88vh] sm:h-[80vh] lg:p-8 z-10">
    <div class="flex flex-col justify-between h-full p-6 mx-auto">
        <div class="flex flex-wrap">
            <!-- About Us Section -->
            <div class="w-full px-4 py-2 md:w-1/3">
                <h3 class="mb-2 text-lg font-bold">{{ $footer->title ?? null }}</h3>
                <p class="text-sm text-gray-400 md:text-md">{{ $footer->description ?? null }}</p>
            </div>

            <!-- Contact & Socials Section -->
            <div class="w-full px-4 py-2 md:w-2/3">
                <div class="grid w-full grid-cols-2 gap-4 lg:grid-cols-4">
                    <div class="w-full">
                        <h3 class="mb-2 text-lg font-bold">Contame</h3>

                        <!-- Location -->
                        <div class="">
                            <a href="{{ $footer->address ?? null }}"
                                rel="noopener noreferrer" target="blank"
                                class="inline-flex items-center text-sm text-gray-400 md:text-md hover:text-gray-200 hover:blur-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="mr-1 size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                Mi estudio
                            </a>
                        </div>

                        <!-- Call me -->
                        <div
                            class="inline-flex items-center text-sm text-gray-400 md:text-md hover:text-gray-200 hover:blur-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="mr-1 size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                            <p class="text-sm text-gray-400 md:text-md">{{ $footer->phone ?? null }}</p>
                        </div>
                    </div>

                    <!-- Redes -->
                    <div class="w-full">
                        <h3 class="mb-2 text-lg font-bold">Redes</h3>
                        <ul class="ml-[-1.25px]">

                            <!-- Mail -->
                            <li class="">
                                <a href="mailto:{{ $footer->email ?? null }}"
                                    class="inline-flex items-center text-sm text-gray-400 md:text-md hover:text-gray-200 hover:blur-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 size-5" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>Mail
                                </a>
                            </li>

                            <!-- Linkedin -->
                            <li class="p-0.5">
                                <a href="https://www.linkedin.com/in/camila-fernandez16/" rel="noopener noreferrer"
                                    target="blank"
                                    class="inline-flex items-center text-sm text-gray-400 md:text-md hover:text-gray-200 hover:blur-xs">
                                    <svg class="mr-2 size-4" xmlns="http://www.w3.org/2000/svg"
                                        preserveAspectRatio="xMidYMid" viewBox="0 0 256 256">
                                        <path
                                            d="M218.123 218.127h-37.931v-59.403c0-14.165-.253-32.4-19.728-32.4-19.756 0-22.779 15.434-22.779 31.369v60.43h-37.93V95.967h36.413v16.694h.51a39.907 39.907 0 0 1 35.928-19.733c38.445 0 45.533 25.288 45.533 58.186l-.016 67.013ZM56.955 79.27c-12.157.002-22.014-9.852-22.016-22.009-.002-12.157 9.851-22.014 22.008-22.016 12.157-.003 22.014 9.851 22.016 22.008A22.013 22.013 0 0 1 56.955 79.27m18.966 138.858H37.95V95.967h37.97v122.16ZM237.033.018H18.89C8.58-.098.125 8.161-.001 18.471v219.053c.122 10.315 8.576 18.582 18.89 18.474h318.144c10.336.128 18.823-8.139 18.966-18.474V18.454c-.147-10.33-8.635-18.588-18.966-18.453"
                                            fill="#FFF" />
                                    </svg>LinkedIn
                                </a>
                            </li>

                            <!-- Instagram -->
                            <li class="p-0.5">
                                <a href="{{ $footer->instagram ?? null }}" rel="noopener noreferrer" target="blank"
                                    class="inline-flex items-center text-sm text-gray-400 md:text-md hover:text-gray-200 hover:blur-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 size-4"
                                        preserveAspectRatio="xMidYMid" viewBox="0 0 256 256">
                                        <path fill="#fff"
                                            d="M128 23.064c34.177 0 38.225.13 51.722.745 12.48.57 19.258 2.655 23.769 4.408 5.974 2.322 10.238 5.096 14.717 9.575 4.48 4.479 7.253 8.743 9.575 14.717 1.753 4.511 3.838 11.289 4.408 23.768.615 13.498.745 17.546.745 51.723 0 34.178-.13 38.226-.745 51.723-.57 12.48-2.655 19.257-4.408 23.768-2.322 5.974-5.096 10.239-9.575 14.718-4.479 4.479-8.743 7.253-14.717 9.574-4.511 1.753-11.289 3.839-23.769 4.408-13.495.616-17.543.746-51.722.746-34.18 0-38.228-.13-51.723-.746-12.48-.57-19.257-2.655-23.768-4.408-5.974-2.321-10.239-5.095-14.718-9.574-4.479-4.48-7.253-8.744-9.574-14.718-1.753-4.51-3.839-11.288-4.408-23.768-.616-13.497-.746-17.545-.746-51.723 0-34.177.13-38.225.746-51.722.57-12.48 2.655-19.258 4.408-23.769 2.321-5.974 5.095-10.238 9.574-14.717 4.48-4.48 8.744-7.253 14.718-9.575 4.51-1.753 11.288-3.838 23.768-4.408 13.497-.615 17.545-.745 51.723-.745M128 0C93.237 0 88.878.147 75.226.77c-13.625.622-22.93 2.786-31.071 5.95-8.418 3.271-15.556 7.648-22.672 14.764C14.367 28.6 9.991 35.738 6.72 44.155 3.555 52.297 1.392 61.602.77 75.226.147 88.878 0 93.237 0 128c0 34.763.147 39.122.77 52.774.622 13.625 2.785 22.93 5.95 31.071 3.27 8.417 7.647 15.556 14.763 22.672 7.116 7.116 14.254 11.492 22.672 14.763 8.142 3.165 17.446 5.328 31.07 5.95 13.653.623 18.012.77 52.775.77s39.122-.147 52.774-.77c13.624-.622 22.929-2.785 31.07-5.95 8.418-3.27 15.556-7.647 22.672-14.763 7.116-7.116 11.493-14.254 14.764-22.672 3.164-8.142 5.328-17.446 5.95-31.07.623-13.653.77-18.012.77-52.775s-.147-39.122-.77-52.774c-.622-13.624-2.786-22.929-5.95-31.07-3.271-8.418-7.648-15.556-14.764-22.672C227.4 14.368 220.262 9.99 211.845 6.72c-8.142-3.164-17.447-5.328-31.071-5.95C167.122.147 162.763 0 128 0Zm0 62.27C91.698 62.27 62.27 91.7 62.27 128c0 36.302 29.428 65.73 65.73 65.73 36.301 0 65.73-29.428 65.73-65.73 0-36.301-29.429-65.73-65.73-65.73Zm0 108.397c-23.564 0-42.667-19.103-42.667-42.667S104.436 85.333 128 85.333s42.667 19.103 42.667 42.667-19.103 42.667-42.667 42.667Zm83.686-110.994c0 8.484-6.876 15.36-15.36 15.36-8.483 0-15.36-6.876-15.36-15.36 0-8.483 6.877-15.36 15.36-15.36 8.484 0 15.36 6.877 15.36 15.36Z" />
                                    </svg>Instagram
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Acessos rápidos -->
                    <div class="w-full">
                        <h3 class="mb-2 text-lg font-bold">Acceso directo</h3>
                        <ul>
                            <li><a wire:navigate href="{{ route('welcome') }}"
                                    class="text-sm text-gray-400 hover:blur-xs md:text-md hover:text-gray-200">Inicio</a>
                            </li>
                            <li><a wire:navigate href="{{ route('about') }}"
                                    class="text-sm text-gray-400 hover:blur-xs md:text-md hover:text-gray-200">Sobre
                                    mi</a></li>
                            <li><a wire:navigate href="{{ route('contact') }}"
                                    class="text-sm text-gray-400 hover:blur-xs md:text-md hover:text-gray-200">Contacto</a>
                            </li>
                            <li><a wire:navigate href="{{ route('portfolio') }}"
                                    class="text-sm text-gray-400 hover:blur-xs md:text-md hover:text-gray-200">Porfolio</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Páginas legales -->
                    <div class="w-full">
                        <h3 class="mb-2 text-lg font-bold">Legal</h3>
                        <ul>
                            <li><a wire:navigate href="{{ route('terms') }}"
                                    class="text-sm text-gray-400 md:text-md hover:text-gray-200 hover:blur-xs">Términos
                                    y condiciones</a>
                            </li>
                            <li><a wire:navigate href="{{ route('privacy') }}"
                                    class="text-sm text-gray-400 md:text-md hover:text-gray-200 hover:blur-xs">Política
                                    de privacidad</a></li>
                            <li><a wire:navigate href="{{ route('refund') }}"
                                    class="text-sm text-gray-400 md:text-md hover:text-gray-200 hover:blur-xs">Devoluciones</a>
                            </li>

                            <li><a wire:navigate href="{{ route('disclaimer') }}"
                                    class="text-sm text-gray-400 md:text-md hover:text-gray-200 hover:blur-xs">Aviso
                                    legal</a>
                            </li>
                            <li><a wire:navigate href="{{ route('cookies') }}"
                                    class="text-sm text-gray-400 md:text-md hover:text-gray-200 hover:blur-xs">Cookies</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info de empresa -->
        <div class="flex justify-between w-full px-2 mt-auto">
            <div class="">
                <h1 class="hidden text-6xl font-bold lg:text-8xl xl:text-9xl md:inline-block">Balo <span
                        class="super-thin">Loba</span>
                </h1>
                <p class="text-sm text-gray-400 md:text-md">© {{ now()->year }} {{ config('app.name') }}. Todos los
                    derechos reservados.</p>
            </div>

            <!-- Logo -->
            <div class="hidden lg:flex">
                <x-application-logo width="120px" height="120px" color="text-white" class="mx-20" />
            </div>
        </div>
</footer>
