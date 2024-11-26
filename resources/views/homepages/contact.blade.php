<x-app-layout>
    <div class="min-h-screen">
        <div class="py-12">
            <div class="px-6 mx-auto space-y-6 sm:mt-20 max-w-7xl lg:px-8">
                <h1
                    class="py-5 text-4xl text-transparent sm:text-5xl md:text-7xl lg:text-8xl bg-clip-text bg-gradient-to-r from-black to-gray-800">
                    Agenda tu sesión con <span
                        class="font-bold text-black underline decoration-yellow-500">{{ config('app.name') }}</span>
                    en un solo click
                </h1>
                <p class="pb-5 text-2xl text-gray-800 border-b-2">¡Elegí uno de nuestros paquetes y obtené un 15% de
                    descuento hoy!
                </p>

                <!-- Paquetes -->
                <section class="py-16" x-data="{ isAnnual: $el.querySelector('#checkbox').checked }">
                    <h2 class="text-6xl font-bold underline decoration-yellow-500">Paquetes</h2>
                    <!-- Toggle switch -->
                    <div class="flex items-center justify-center py-5">
                        <label class="text-sm text-gray-500 min-w-14 me-3">Básico</label>

                        <input type="checkbox" id="checkbox"
                            class="relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-yellow-500 disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-yellow-500 checked:border-yellow-500 focus:checked:border-yellow-500 
                    
                            before:inline-block before:size-6 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 "
                            checked x-model="isAnnual" />

                        <label class="relative text-sm text-gray-500 min-w-14 ms-3">
                            Extendido
                            <span class="absolute -top-10 start-auto -end-28">
                                <span class="flex items-center">
                                    <svg class="h-8 w-14 -me-6" width="45" height="25" viewBox="0 0 45 25"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M43.2951 3.47877C43.8357 3.59191 44.3656 3.24541 44.4788 2.70484C44.5919 2.16427 44.2454 1.63433 43.7049 1.52119L43.2951 3.47877ZM4.63031 24.4936C4.90293 24.9739 5.51329 25.1423 5.99361 24.8697L13.8208 20.4272C14.3011 20.1546 14.4695 19.5443 14.1969 19.0639C13.9242 18.5836 13.3139 18.4152 12.8336 18.6879L5.87608 22.6367L1.92723 15.6792C1.65462 15.1989 1.04426 15.0305 0.563943 15.3031C0.0836291 15.5757 -0.0847477 16.1861 0.187863 16.6664L4.63031 24.4936ZM43.7049 1.52119C32.7389 -0.77401 23.9595 0.99522 17.3905 5.28788C10.8356 9.57127 6.58742 16.2977 4.53601 23.7341L6.46399 24.2659C8.41258 17.2023 12.4144 10.9287 18.4845 6.96211C24.5405 3.00476 32.7611 1.27399 43.2951 3.47877L43.7049 1.52119Z"
                                            fill="currentColor" class="fill-gray-300" />
                                    </svg>
                                    <span
                                        class="mt-3 inline-block whitespace-nowrap text-[11px] leading-5 font-semibold tracking-wide uppercase bg-yellow-500 text-white rounded-full py-1 px-2.5">Obtené + con -</span>
                                </span>
                            </span>
                        </label>
                    </div>

                    <div class="justify-center md:space-x-6 md:flex">
                        <!-- Foundation Plan -->
                        <div class="w-full my-10 p-6 text-center transition bg-gray-100 border rounded-lg shadow-lg md:w-1/3 md:hover:scale-[1.02]"
                            x-data="{
                                {{-- annualFoundationUrl: '{{ route('checkout', ['price' => config('pricing.plans.foundation_plan.prices.annual')]) }}',
                                monthlyFoundationUrl: '{{ route('checkout', ['price' => config('pricing.plans.foundation_plan.prices.monthly')]) }}' --}}
                            }">
                            <div class="items-center justify-between pb-2 lg:flex text-start">
                                <h2 class="text-2xl font-semibold">Foundation</h2>
                                <span class="text-4xl font-bold underline-orange"
                                    x-text="isAnnual ? '$49/yr' : '$5/mo'"></span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                                stroke="currentColor" class="size-16 md:size-20">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                            </svg>

                            <!-- Features -->
                            <ul class="my-4">
                                <li class="flex mb-2 text-start">&#10004; Monthly newsletters with
                                    key articles</li>
                                <li class="flex mb-2 text-start">&#10004; Access to all blog posts
                                    and updates</li>
                                <li class="flex mb-2 text-start">&#10004; Participation in
                                    community discussions</li>
                                <li class="flex mb-2 text-start">&#10004; Top stories of the week
                                </li>
                                <li class="flex mb-2 text-start">&#10004; Downloadable resources
                                </li>
                            </ul>


                            @auth
                                @if (!auth()->user()->subscribed())
                                    <a :href="isAnnual ? annualFoundationUrl : monthlyFoundationUrl"
                                        class="flex items-center justify-center w-full px-4 py-2 my-6 text-gray-100 rounded-lg hover:blur-xs hover:cursor-pointer bg-gray-950">Subscribe
                                        now
                                    </a>
                                @elseif(auth()->user()->subscribedToProduct(config('pricing.plans.foundation_plan.product_id')))
                                    <a href="{{ route('billing') }}"
                                        class="flex items-center justify-center w-full px-4 py-2 my-6 text-gray-100 rounded-lg hover:blur-xs hover:cursor-pointer bg-gray-950">
                                        Manage your plan
                                    </a>
                                @endif
                            @endauth

                            @guest
                                <a :href="isAnnual ? annualFoundationUrl : monthlyFoundationUrl"
                                    class="flex items-center justify-center w-full px-4 py-2 my-6 text-gray-100 rounded-lg hover:blur-xs hover:cursor-pointer bg-gray-950">Subscribe
                                    now
                                </a>
                            @endguest
                        </div>

                        <!-- Structural (Center Highlighted) -->
                        <div class="w-full my-10 p-6 text-center transition transform md:scale-110 bg-gray-950 border       rounded-lg shadow-lg md:w-1/3 hover:scale-[1.12]"
                            x-data="{
                                {{-- annualStructuralUrl: '{{ route('checkout', ['price' => config('pricing.plans.structural_plan.prices.annual')]) }}',
                                    monthlyStructuralUrl: '{{ route('checkout', ['price' => config('pricing.plans.structural_plan.prices.monthly')]) }}' --}}
                            }">
                            <div class="items-center justify-between pb-2 text-gray-100 lg:flex text-start">
                                <h2 class="text-2xl font-semibold">Structural</h2>
                                <span class="text-4xl font-bold underline-orange"
                                    x-text="isAnnual ? '$99/yr' : '$10/mo'"></span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                                stroke="currentColor" class="text-gray-300 size-16 md:size-20">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                            </svg>

                            <!-- Features -->
                            <ul class="my-4">
                                <li class="flex mb-2 text-gray-200 text-start">&#10004; Weekly
                                    newsletters with curated content</li>
                                <li class="flex mb-2 text-gray-200 text-start">&#10004; Early
                                    access to new blog posts</li>
                                <li class="flex mb-2 text-gray-200 text-start">&#10004; Exclusive
                                    monthly architectural design tips</li>
                                <li class="flex mb-2 text-gray-200 text-start">&#10004; Downloadable resources</li>
                                <li class="flex mb-2 text-gray-200 text-start">&#10004; Access to
                                    members-only webinars and Q&A sessions</li>
                                <li class="flex mb-2 text-gray-200 text-start">&#10004; Discounts
                                    on architectural events and workshops</li>
                            </ul>

                            @auth
                                @if (!auth()->user()->subscribed())
                                    <a :href="isAnnual ? annualStructuralUrl : monthlyStructuralUrl"
                                        class="flex items-center justify-center w-full px-4 py-2 my-6 text-gray-900 bg-yellow-500 rounded-lg hover:blur-xs hover:cursor-pointer">Subscribe
                                        now
                                    </a>
                                @elseif(auth()->user()->subscribedToProduct(config('pricing.plans.structural_plan.product_id')))
                                    <a href="{{ route('billing') }}"
                                        class="flex items-center justify-center w-full px-4 py-2 my-6 text-gray-900 bg-yellow-500 rounded-lg hover:blur-xs hover:cursor-pointer">
                                        Manage your plan
                                    </a>
                                @endif
                            @endauth

                            @guest
                                <a :href="isAnnual ? annualStructuralUrl : monthlyStructuralUrl"
                                    class="flex items-center justify-center w-full px-4 py-2 my-6 text-gray-900 bg-yellow-500 rounded-lg hover:blur-xs hover:cursor-pointer">Subscribe
                                    now
                                </a>
                            @endguest
                        </div>

                        <!-- Master -->
                        <div class="w-full my-10 p-6 text-center transition bg-gray-100 border rounded-lg shadow-lg md:w-1/3 md:hover:scale-[1.02]"
                            x-data="{
                                {{-- annualMasterUrl: '{{ route('checkout', ['price' => config('pricing.plans.master_plan.prices.annual')]) }}',
                                        monthlyMasterUrl: '{{ route('checkout', ['price' => config('pricing.plans.master_plan.prices.monthly')]) }}' --}}
                            }">
                            <div class="items-center justify-between pb-2 lg:flex text-start">
                                <h2 class="text-2xl font-semibold">Master</h2>
                                <span class="text-4xl font-bold underline-orange"
                                    x-text="isAnnual ? '$199/yr' : '$20/mo'"></span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                                stroke="currentColor" class="size-16 md:size-20">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                            </svg>

                            <!-- Features -->
                            <ul class="my-4">
                                <li class="flex mb-2 text-start">&#10004; Daily newsletters with
                                    latest trends</li>
                                <li class="flex mb-2 text-start">&#10004; Full access to all
                                    future blog posts</li>
                                <li class="flex mb-2 text-start">&#10004; Personalized content
                                    recommendations</li>
                                <li class="flex mb-2 text-start">&#10004; Access to exclusive
                                    architectural case studies</li>
                                <li class="flex mb-2 text-start">&#10004; Invitations to
                                    exclusive architecture events</li>
                                <li class="flex mb-2 text-start">&#10004; Access to all future
                                    digital products and courses</li>
                            </ul>

                            @auth
                                @if (!auth()->user()->subscribed())
                                    <a :href="isAnnual ? annualMasterUrl : monthlyMasterUrl"
                                        class="flex items-center justify-center w-full px-4 py-2 my-6 text-gray-100 rounded-lg hover:blur-xs hover:cursor-pointer bg-gray-950">Subscribe
                                        now
                                    </a>
                                @elseif(auth()->user()->subscribedToProduct(config('pricing.plans.master_plan.product_id')))
                                    <a href="{{ route('billing') }}"
                                        class="flex items-center justify-center w-full px-4 py-2 my-6 text-gray-100 rounded-lg hover:blur-xs hover:cursor-pointer bg-gray-950">
                                        Manage your plan
                                    </a>
                                @endif
                            @endauth

                            @guest
                                <a :href="isAnnual ? annualMasterUrl : monthlyMasterUrl"
                                    class="flex items-center justify-center w-full px-4 py-2 my-6 text-gray-100 rounded-lg hover:blur-xs hover:cursor-pointer bg-gray-950">Subscribe
                                    now
                                </a>
                            @endguest
                        </div>
                    </div>

                    <p class="py-10 text-sm text-center text-gray-500 border-b-2">
                        Los precios que se muestran son en pesos uruguayos y no hay cargos extra.
                    </p>
                </section>

                <!-- Contacto -->
                <section class="mx-auto space-y-6 sm:px-6 pb-[20vh] max-w-7xl lg:px-8">
                    <h1
                        class="px-6 py-5 text-4xl text-transparent sm:px-0 sm:text-5xl md:text-7xl lg:text-8xl bg-clip-text bg-gradient-to-r from-black to-gray-800">
                        <span class="font-bold text-black underline decoration-yellow-500">Contactame.</span>
                        ¡Capturemos momentos únicos!
                    </h1>

                    <div
                        class="max-w-xl p-8 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))]
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
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
