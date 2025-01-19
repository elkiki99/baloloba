<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Validate;
use App\Models\Category;

new class extends Component {
    public $category;

    #[Validate('required|string|max:255', as:'nombre')]
    public $name;

    #[Validate('required|string|max:255', as:'slug')]
    public $slug;

    #[Validate('nullable|string|max:500', as:'descripción')]
    public $description;

    public function mount($id)
    {
        $this->category = Category::findOrFail($id);
        $this->name = $this->category->name;
        $this->slug = $this->category->slug;
        $this->description = $this->category->description;
    }

    public function updateCategory()
    {
        if (!Gate::allows('modify-page')) {
            abort(403);
        }

        $this->validate();

        $this->category->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
        ]);

        // Category updated toast
        $this->dispatch('categoryUpdatedToast');
    }
}; ?>

<form class="mt-6 space-y-6">
    <x-category-form :category="$category" />

    <div class="flex">
        <div class="ml-auto">
            <x-primary-button wire:click.prevent='updateCategory'>
                {{ __('Actualizar') }}
            </x-primary-button>
        </div>
    </div>
</form>

<!-- Category updated toast -->
@script
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('categoryUpdatedToast', () => {
                toast('Actualizado', {
                    type: 'success',
                    position: 'bottom-right',
                    description: 'Categoria actualizado correctamente.'
                });
            });
        });
    </script>
@endscript
