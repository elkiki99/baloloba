<x-admin-panel-layout>
    <section class="pb-[20vh] pt-[6vh] sm:pt-[12vh] sm:px-6 lg:px-8 px-4">
        <div class="space-y-6 md:mx-auto max-w-7xl">
            <h1 class="text-5xl font-bold underline md:text-7xl decoration-yellow-500">Editar paquete</h1>

            <!-- Breadcrumbs -->
            <nav class="flex justify-between px-3.5 py-1 rounded-md">
                <ol
                    class="inline-flex items-center space-x-1 text-xs text-neutral-500 [&_.active-breadcrumb]:text-neutral-600 [&_.active-breadcrumb]:font-medium sm:mb-0">
                    <li class="flex items-center h-full"><a wire:navigate href="{{ route('panel') }}" class="py-1 hover:text-neutral-900"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                <path
                                    d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                                <path
                                    d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                            </svg>
                        </a></li>
                    <svg class="w-5 h-5 text-gray-400/70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g fill="none" stroke="none">
                            <path d="M10 8.013l4 4-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </g>
                    </svg>
                    <li><a wire:navigate href="{{ route('packages.index') }}"
                            class="inline-flex items-center py-1 font-normal hover:text-neutral-900 focus:outline-none">Paquetes</a>
                    </li>
                    <svg class="w-5 h-5 text-gray-400/70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g fill="none" stroke="none">
                            <path d="M10 8.013l4 4-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </g>
                    </svg>
                    <li><p
                            class="inline-flex items-center py-1 font-normal text-gray-900 hover:text-neutral-800 focus:outline-none">Editar</p>
                    </li>
                </ol>
            </nav>
            
            <!-- Paquetes -->
            <div
                class="max-w-2xl p-8 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))]
                    from-gray-200
                    via-gray-100
                    to-gray-50 sm:rounded-md shadow-xl">
                <header>
                    <h2 class="text-lg font-medium text-gray-800">
                        {{ __('Editar paquete') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-700">
                        {{ __('Edita los datos del paquete.') }}
                    </p>
                </header>

                <livewire:packages.edit :id="$package->id" /> 
            </div>
        </div>
    </section>
</x-admin-panel-layout>