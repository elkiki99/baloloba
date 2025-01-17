<x-admin-panel-layout>
    <section class="pb-[20vh] sm:pt-[12vh] pt-[6vh] sm:px-6 lg:px-8 px-4">
        <div class="space-y-6 md:mx-auto max-w-7xl">
            <h1 class="text-5xl font-bold underline md:text-7xl decoration-yellow-500">Categorías</h1>

            <!-- Breadcrumbs -->
            <nav class="flex justify-between px-3.5 py-1 rounded-md">
                <ol
                    class="inline-flex items-center space-x-1 text-xs text-neutral-500 [&_.active-breadcrumb]:text-neutral-600 [&_.active-breadcrumb]:font-medium sm:mb-0">
                    <li class="flex items-center h-full"><a wire:navigate href="{{ route('panel') }}"
                            class="py-1 hover:text-neutral-900"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="size-4">
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
                    <li>
                        <p class="inline-flex items-center py-1 font-normal hover:text-neutral-900 focus:outline-none">
                            Categorías</p>
                    </li>
                </ol>
            </nav>

            <!-- Photoshoots listing -->
            <livewire:categories.index />
        </div>
    </section>
</x-admin-panel-layout>
