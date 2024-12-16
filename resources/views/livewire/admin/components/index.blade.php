<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section>
    <div class="overflow-hidden bg-white rounded-lg shadow-md">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Nombre</th>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Descripción</th>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Componente</th>
                    <th class="px-4 py-2 font-semibold text-gray-600 text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Header -->
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-4">Headers</td>
                    <td class="px-4 py-4">Edita los headers</td>
                    <td class="px-4 py-4">Headers</td>
                    <td class="h-full px-4 py-2">
                        <div class="flex items-center justify-end gap-2">
                            <div class="flex items-center justify-center">
                                <a wire:navigate href="{{ route('headers.index') }}" class="text-gray-600 hover:text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                      </svg>
                                      
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                
                <!-- Acerca de mi -->
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-4">Acerca de mi</td>
                    <td class="px-4 py-4">Acerca de mi de la página principal</td>
                    <td class="px-4 py-4">Página principal</td>
                    <td class="h-full px-4 py-2">
                        <div class="flex items-center justify-end gap-2">
                            <div class="flex items-center justify-center">
                                <a wire:navigate href="#" class="text-gray-600 hover:text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Testimonios -->
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-4">Testimonios</td>
                    <td class="px-4 py-4">Testimonios de la página principal</td>
                    <td class="px-4 py-4">Página principal</td>
                    <td class="h-full px-4 py-2">
                        <div class="flex items-center justify-end gap-2">
                            <div class="flex items-center justify-center">
                                <a wire:navigate href="#" class="text-gray-600 hover:text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Header -->
                {{-- <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-4">Header</td>
                    <td class="px-4 py-4">Header de la página de portfolio</td>
                    <td class="px-4 py-4">Página de portfolio</td>
                    <td class="h-full px-4 py-2">
                        <div class="flex items-center justify-end gap-2">
                            <div class="flex items-center justify-center">
                                <a wire:navigate href="{{ route('portfolio.header') }}" class="text-gray-600 hover:text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Header -->
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-4">Header</td>
                    <td class="px-4 py-4">Header de la página sobre mi</td>
                    <td class="px-4 py-4">Página sobre mi</td>
                    <td class="h-full px-4 py-2">
                        <div class="flex items-center justify-end gap-2">
                            <div class="flex items-center justify-center">
                                <a wire:navigate href="{{ route('about.header') }}" class="text-gray-600 hover:text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr> --}}

                <!-- Mi estudio -->
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-4">Mi estudio</td>
                    <td class="px-4 py-4">Mi estudio de la página sobre mi</td>
                    <td class="px-4 py-4">Sobre mi</td>
                    <td class="h-full px-4 py-2">
                        <div class="flex items-center justify-end gap-2">
                            <div class="flex items-center justify-center">
                                <a wire:navigate href="#" class="text-gray-600 hover:text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Contact -->
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-4">Contacto</td>
                    <td class="px-4 py-4">Texto de la página contacto</td>
                    <td class="px-4 py-4">Contacto</td>
                    <td class="h-full px-4 py-2">
                        <div class="flex items-center justify-end gap-2">
                            <div class="flex items-center justify-center">
                                <a wire:navigate href="#" class="text-gray-600 hover:text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
