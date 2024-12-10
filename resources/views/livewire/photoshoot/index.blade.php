<?php

use Livewire\Volt\Component;
use App\Models\PhotoShoot;

new class extends Component {
    public $photoshoots;

    public function mount()
    {
        $this->photoshoots = PhotoShoot::latest()->get();
    }
}; ?>


<div class="container p-4 mx-auto">
    <h1 class="mb-6 text-2xl font-bold">Listado de Photoshoots</h1>
    <div class="overflow-hidden bg-white rounded-lg shadow-md">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Nombre</th>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Categoría</th>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Precio</th>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Ubicación</th>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Duración</th>
                    <th class="px-4 py-2 font-semibold text-left text-gray-600">Estado</th>
                    <th class="px-4 py-2 font-semibold text-center text-gray-600">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($photoshoots as $photoshoot)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $photoshoot->name }}</td>
                        <td class="px-4 py-2">{{ $photoshoot->category->name ?? 'Sin categoría' }}</td>
                        <td class="px-4 py-2">${{ number_format($photoshoot->price, 2) }}</td>
                        <td class="px-4 py-2">{{ $photoshoot->location }}</td>
                        <td class="px-4 py-2">{{ $photoshoot->duration }} hrs</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-sm rounded-full 
                                {{ $photoshoot->status == 'activo' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ ucfirst($photoshoot->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('photoshoot.show', $photoshoot->slug) }}" class="text-blue-500 hover:underline">Ver</a> |
                            <a href="{{ route('photoshoot.edit', $photoshoot->slug) }}" class="text-yellow-500 hover:underline">Editar</a> |
                            {{-- <form action="{{ route('photoshoot.delete', $photoshoot->slug) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
