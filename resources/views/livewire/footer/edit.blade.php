<?php

use Livewire\Volt\Component;
use App\Models\Footer;
use Illuminate\Support\Facades\Gate;

new class extends Component {
    public $footer;
    public $title;
    public $description;

    public function mount()
    {
        $this->footer = Footer::findOrFail(1);
        $this->title = $this->footer->title;
        $this->description = $this->footer->description;
    }

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:500',
    ];

    public function updateFooter()
    {
        if (!Gate::allows('modify-page')) {
            abort(403);
        }

        $this->validate();

        $this->footer->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        // Footer updated toast
        $this->dispatch('footerUpdatedToast');
        $this->dispatch('footerUpdatedSuccessfully');
    }
}; ?>

<form class="mt-6 space-y-6">
    <div class="space-y-6 ">
        <!-- Title -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="title" :value="__('Título')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input placeholder="Título del pie de página" wire:model="title" class="block w-full mt-1" type="text"
                required autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Description -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label class="" for="description" :value="__('Descripción')" />
                <span class="text-yellow-600">*</span>
            </div>
            <textarea placeholder="Fotografías instantáneas clásicas" wire:model="description"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-500 focus:ring-yellow-500 dark:focus:ring-yellow-500"
                rows="4" autocomplete="description"></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>
    </div>

    <div class="flex">
        <div class="ml-auto">
            <x-primary-button wire:click.prevent='updateFooter'>
                {{ __('Actualizar') }}
            </x-primary-button>
        </div>
    </div>
</form>

<!-- Footer updated toast -->
{{-- @script --}}
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('footerUpdatedToast', () => {
            toast('Actualizado', {
                type: 'success',
                position: 'bottom-right',
                description: 'Footer actualizado correctamente.'
            });
        });
    });
</script>
{{-- @endscript --}}
