<?php

use Livewire\Volt\Component;
use App\Models\PhotoShoot;

new class extends Component {
    public $categoryId;
    public $photoshoots;

    public function mount($id)
    {
        $this->categoryId = $id;
        $this->photoshoots = PhotoShoot::where('category_id', $this->categoryId)
            ->where('status', 'published')
            ->latest()
            ->get();
    }
}; ?>

<div class="grid gap-1 sm:grid-cols-2 md:grid-cols-3">
    @forelse ($photoshoots as $photoshoot)
        <x-photo-shoot-card :photoshoot="$photoshoot" />
    @empty
        <p class="px-4 mt-20 max-w-7xl sm:px-6 lg:px-16">No hay photoshoots para esta categoría</p>
    @endforelse
</div>
