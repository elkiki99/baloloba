<?php

use Livewire\Volt\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;


new class extends Component {
    public $category;
    public $name;
    public $slug;
    public $description;

    public function mount($id)
    {
        $this->category = Category::findOrFail($id);
        $this->name = $this->category->name;
        $this->slug = $this->category->slug;
        $this->description = $this->category->description;
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
    ];

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
{{-- @script --}}
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
{{-- @endscript --}}
