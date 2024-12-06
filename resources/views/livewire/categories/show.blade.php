<?php

use Livewire\Volt\Component;
use App\Models\PhotoShoot;

new class extends Component {
    public $categoryId;
    public $photoshoots;

    public function mount($id)
    {
        $this->categoryId = $id;
        $this->photoshoots = PhotoShoot::where('category_id', $this->categoryId)->latest()->get();
    }
}; ?>

<div class="grid gap-1 sm:grid-cols-2 md:grid-cols-3">
    @foreach ($photoshoots as $photoshoot)
        <x-photo-shoot-card :photoshoot="$photoshoot" />
    @endforeach
</div>
