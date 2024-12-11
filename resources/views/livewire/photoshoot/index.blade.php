<?php

use Livewire\Volt\Component;
use App\Models\PhotoShoot;

new class extends Component {
    public function with()
    {
        return [
            'photoshoots' => PhotoShoot::latest()->paginate(10),
        ];
    }
}; ?>

<section class="flex flex-col min-h-screen">
    <!-- Photoshoot deleted toast -->
    @if (session('photoshoot-deleted'))
        <div x-init="$nextTick(() => { photoshootDeletedToast() })"></div>
    @endif

    <!-- Contenedor de la tabla -->
    <div class="overflow-hidden bg-white rounded-lg shadow-md">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Nombre</th>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Categoría</th>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Precio</th>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Ubicación</th>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Estado</th>
                    <th class="px-4 py-2 font-semibold text-gray-600 text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($photoshoots as $photoshoot)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-4">{{ $photoshoot->name }}</td>
                        <td class="px-4 py-4">{{ $photoshoot->category->name ?? 'Sin categoría' }}</td>
                        <td class="px-4 py-4">${{ number_format($photoshoot->price, 2) }}</td>
                        <td class="px-4 py-4">{{ $photoshoot->location }}</td>
                        <td class="px-4 py-4">
                            <span   
                                class="px-2 py-1 text-sm rounded-full 
                                {{ $photoshoot->status == 'published' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }}">
                                {{ $photoshoot->status == 'published' ? 'Publicado' : 'Borrador' }}
                            </span>
                        </td>
                        <td class="h-full px-4 py-2">
                            <div class="flex items-center justify-end gap-2">
                                <div class="flex items-center justify-center">
                                    <a wire:navigate href="{{ route('photoshoot.show', $photoshoot->slug) }}"
                                        class="text-gray-600 hover:text-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="flex items-center justify-center">
                                    <a wire:navigate href="{{ route('photoshoot.edit', $photoshoot->slug) }}"
                                        class="text-gray-600 hover:text-gray-800">
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
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-600">No hay photoshoots</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginador -->
    <div class="mt-6">
        @if ($photoshoots->hasPages())
            {{ $photoshoots->links() }}
        @endif
    </div>
</section>

<script>
    function photoshootDeletedToast() {
        toast('Photoshoot eliminado', {
            type: 'success',
            position: 'bottom-right',
            description: 'Photoshoot eliminado correctamente.'
        });
    }

    document.addEventListener('livewire:init', () => {
        Livewire.on('photoshootDeletedToast', () => {
            photoshootDeletedToast();
        });
    });
</script>
