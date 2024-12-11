<?php

use Livewire\Volt\Component;
use App\Models\PhotoShoot;

new class extends Component {
    public $photoshoots;

    public function mount()
    {
        $this->photoshoots = Photoshoot::latest()->get();
    }
}; ?>

<div class="mt-12 space-y-6 pb-[20vh]">
    <div class="grid gap-1 sm:grid-cols-2 md:grid-cols-3">
        @foreach ($photoshoots as $photoshoot)
            <x-photo-shoot-card :photoshoot="$photoshoot" />
        @endforeach
    </div>
</div>