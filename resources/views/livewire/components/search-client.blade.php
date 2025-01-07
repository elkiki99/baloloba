<?php

use Livewire\Volt\Component;
use App\Models\PhotoShoot;
use App\Models\User;

new class extends Component {
    public $photoshoot;
    public $users = [];
    public $search = '';
    public $selectedUser = null;

    public function mount($id)
    {
        $this->photoshoot = PhotoShoot::findOrFail($id);
    }

    public function updatedSearch()
    {
        $existingClientIds = $this->photoshoot->clients()->select('users.id')->pluck('id');

        if (!empty($this->search)) {
            $this->users = User::where('name', 'like', '%' . $this->search . '%')
                ->where('isAdmin', false)
                ->whereNotIn('id', $existingClientIds)
                ->take(5)
                ->get();
        } else {
            $this->users = [];
        }
    }

    public function addClientToPhotoshoot($userId)
    {
        if (!$this->photoshoot->clients()->where('client_id', $userId)->exists()) {
            $this->photoshoot->clients()->attach($userId);
        }
        $this->reset(['search', 'selectedUser']);
    }

    public function removeClientFromPhotoshoot($clientId)
    {
        $this->photoshoot->clients()->detach($clientId);
        $this->photoshoot->refresh();
    }
}; ?>

<div class="mt-4">
    <x-input-label for="search" :value="__('Buscar usuario')" />

    <div class="relative mt-1">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </span>
        <x-text-input wire:model.live.debounce.300ms="search" placeholder="Escribe para buscar..."
            class="block w-full pl-10 border-gray-300 rounded-md shadow-sm" />
    </div>

    @if ($search)
        <ul class="mt-2 bg-white rounded-md shadow">
            @foreach ($users as $user)
                <li class="px-4 py-2 border-b cursor-pointer last:border-b-0 hover:bg-gray-100"
                    wire:click.prevent="addClientToPhotoshoot({{ $user->id }})">
                    {{ $user->name }}
                </li>
            @endforeach
        </ul>
    @elseif($search)
        <p class="mt-2 text-sm text-gray-600">No se encontraron usuarios.</p>
    @endif

    @forelse($photoshoot->clients as $client)
        <div class="mt-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-gray-500 size-4">
                        <path fill-rule="evenodd"
                            d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="text-gray-600">{{ $client->name }}, {{ $client->email }}</span>
                </div>
                <button x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-client-photoshoot-deletion-{{ $client->id }}')"
                    class="ml-2 text-red-600">
                    Eliminar
                </button>
            </div>
        </div>

        <x-modal name="confirm-client-photoshoot-deletion-{{ $client->id }}">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __('¿Segura que queres eliminar este cliente del photoshoot?') }}
                </h3>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('El cliente perderá el acceso a su photoshoot y sus fotos favoritas se eliminarán automáticamente. Si quieres puedes actualizar el estado del photoshoot a borrador, el cliente no podrá ver el photoshoot y no alterarás el estado de sus favoritos.') }}
                </p>

                <div class="flex justify-end mt-6">
                    <x-secondary-button class="px-4 py-2" x-on:click="$dispatch('close')">
                        {{ __('Cancelar') }}
                    </x-secondary-button>

                    <x-danger-button x-on:click="$dispatch('close')" class="px-4 py-2 ms-3"
                        wire:click.prevent="removeClientFromPhotoshoot({{ $client->id }})">Eliminar</x-danger-button>
                </div>
            </div>
        </x-modal>
    @empty
        <div class="mt-4">
            <p class="text-gray-600">No hay clientes asignados a este photoshoot.</p>
        </div>
    @endforelse
</div>
