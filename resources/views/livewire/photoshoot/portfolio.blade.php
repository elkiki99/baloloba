<?php

use Livewire\Volt\Component;
use App\Models\PhotoShoot;

new class extends Component {
    public $photoshoots;

    public function mount()
    {
        $this->photoshoots = PhotoShoot::latest()->where('status', 'published')->get() ?? null;
    }
}; ?>

<div class="mt-12 space-y-6 pb-[20vh]">
    <div class="grid gap-1 sm:grid-cols-2 md:grid-cols-3">
        @forelse ($photoshoots as $photoshoot)
            <x-photo-shoot-card :photoshoot="$photoshoot" />
        @empty
            <p class="px-4 mt-20 max-w-7xl sm:px-6 lg:px-16">No hay photoshoots disponibles</p>
        @endforelse
    </div>
</div>