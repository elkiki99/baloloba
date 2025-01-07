<?php

use Livewire\Volt\Component;
use App\Models\PhotoShoot;

new class extends Component {
    public $photoshoots;

    public function mount()
    {
        $client = Auth::user();

        $this->photoshoots = $client->clientPhotoShoots->map(function ($clientPhotoShoot) {
            return $clientPhotoShoot->photoShoot;
        });
    }
}; ?>

<div>
    <!-- Contenedor de la tabla -->
    <div class="overflow-hidden bg-white rounded-lg shadow-md">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Nombre</th>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Categoría</th>
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
                        <td class="px-4 py-4">{{ $photoshoot->location }}</td>
                        <td class="px-4 py-4">
                            <span
                                class="px-2 py-1 text-sm rounded-full 
    {{ $photoshoot->status == 'published'
        ? 'bg-green-100/50 text-green-600/50'
        : ($photoshoot->status == 'client_preview'
            ? 'bg-pink-100/50 text-pink-600/50'
            : 'bg-blue-100/50 text-blue-600/50') }}">
                                {{ $photoshoot->status == 'published'
                                    ? 'Publicado'
                                    : ($photoshoot->status == 'client_preview'
                                        ? 'En revisión'
                                        : 'Borrador') }}
                            </span>
                        </td>
                        <td class="h-full px-4 py-2">
                            <div class="flex items-center justify-end gap-2">
                                <div class="flex items-center justify-center">
                                    <a wire:navigate
                                        href="{{ $photoshoot->status === 'draft' ? '' : route('photoshoot.show', $photoshoot->slug) }}"
                                        class="text-gray-600 hover:text-gray-800 {{ $photoshoot->status === 'draft' ? 'cursor-not-allowed' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
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

    <!-- Photoshoot approved toast -->
    @if (session('photoshoot-approved'))
        <div x-init="$nextTick(() => { photoshootApprovedToast() })"></div>
    @endif
</div>

<script>
    function photoshootApprovedToast() {
        toast('Photoshoot aprobado', {
            type: 'success',
            position: 'bottom-right',
            description: 'Photoshoot aprobado exitosamente.'
        });
    }

    document.addEventListener('livewire:init', () => {
        Livewire.on('photoshootApprovedToast', () => {
            photoshootApprovedToast();
        });
    });
</script>