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
    <!-- Photoshoot deleted toast -->
    @if (session('photoshoot-deleted'))
        <div x-init="$nextTick(() => { photoshootUpdatedToast() })"></div>
    @endif

    <div class="grid gap-1 sm:grid-cols-2 md:grid-cols-3">
        @foreach ($photoshoots as $photoshoot)
            <x-photo-shoot-card :photoshoot="$photoshoot" />
        @endforeach
    </div>
</div>

<script>
    function photoshootUpdatedToast() {
        toast('Photoshoot eliminado', {
            type: 'success',
            position: 'bottom-right',
            description: 'Photoshoot eliminado correctamente.'
        });
    }

    document.addEventListener('livewire:init', () => {
        Livewire.on('photoshootUpdatedToast', () => {
            photoshootUpdatedToast();
        });
    });
</script>
