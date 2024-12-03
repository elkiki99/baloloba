<?php

use Livewire\Volt\Component;
use App\Models\PhotoShoot;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    public $photoshootId;

    public function deletePhotoShoot()
    {
        // $photoshoot = PhotoShoot::findOrFail($this->photoshootId);

        // Storage::disk('s3')->deleteDirectory('photoshoots/' . $photoshoot->slug);
        // $photoshoot->delete();

        $this->dispatch('photoshootDeleted');
        // session()->flash('toast', [
        //     'message' => 'Photoshoot eliminado exitosamente.',
        //     'type' => 'success',
        //     'position' => 'bottom-right'
        // ]);

        return redirect()->route('portfolio');
    }
}; ?>

<div>
    <!-- Botón para eliminar -->
    <x-danger-button class="px-4 py-2 ms-3" wire:click="deletePhotoShoot()">
        {{ __('Si, eliminar photoshoot') }}
    </x-danger-button>
</div>
