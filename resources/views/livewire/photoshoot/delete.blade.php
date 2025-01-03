<?php

use Livewire\Volt\Component;
use App\Models\PhotoShoot;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    public $photoshootId;

    public function deletePhotoShoot()
    {
        if (!Gate::allows('modify-page')) {
            abort(403);
        }
        
        $photoshoot = PhotoShoot::findOrFail($this->photoshootId);

        Storage::disk('s3')->deleteDirectory('photoshoots/' . $photoshoot->slug);
        $photoshoot->delete();

        return redirect()->route('photoshoot.index')->with('photoshoot-deleted', 'Photoshoot eliminado exitosamente');
    }
}; ?>

<div>
    <x-danger-button class="px-4 py-2 ms-3" wire:click.prevent="deletePhotoShoot">
        {{ __('Si, eliminar photoshoot') }}
    </x-danger-button>
</div>
