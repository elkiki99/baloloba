<?php

use Livewire\Volt\Component;
use App\Models\Section;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public $section;
    public $title;
    public $sub_title;
    public $description;
    public $button_text;
    public $button_link;
    public $new_image;

    public function mount($id)
    {
        $this->section = Section::findOrFail($id);

        $this->title = $this->section->title;
        $this->sub_title = $this->section->sub_title;
        $this->description = $this->section->description;
        $this->button_text = $this->section->button_text;
        $this->button_link = $this->section->button_link;
    }

    protected $rules = [
        'title' => 'required|string|max:255',
        'sub_title' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:500',
        'button_text' => 'nullable|string|max:255',
        'button_link' => 'nullable|string|max:255',
        'new_image' => 'nullable|image|max:10240',
    ];

    public function updateSection()
    {
        if (!Gate::allows('modify-page')) {
            abort(403);
        }

        $this->validate();

        $sectionFolder = '/components/sections';
        $sectionImageName = 'section_' . Str::random($length = 10);

        if ($this->new_image) {
            if ($this->section->image) {
                Storage::disk('s3')->delete($this->section->image);
            }
            $imagePath = $this->new_image->storeAs($sectionFolder, $sectionImageName, 's3');
        } else {
            $imagePath = $this->section->image;
        }

        $this->section->update([
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'description' => $this->description,
            'image' => $imagePath,
            'button_text' => $this->button_text,
            'button_link' => $this->button_link,
        ]);

        // Dispatch toast notification
        $this->dispatch('sectionUpdatedToast');
    }
}; ?>

<form class="mt-6 space-y-6">
    <div class="space-y-6">
        <!-- Título -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="title" :value="__('Título')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input placeholder="Título del encabezado" wire:model="title" class="block w-full mt-1" type="text"
                required autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Subtítulo -->
        <div>
            <x-input-label for="sub_title" :value="__('Subtítulo')" />
            <x-text-input placeholder="Subtítulo del encabezado" wire:model="sub_title" class="block w-full mt-1"
                type="text" required autocomplete="sub_title" />
            <x-input-error :messages="$errors->get('sub_title')" class="mt-2" />
        </div>

        <!-- Section Photo -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="new_image" :value="__('Imágen de la sección')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input wire:model="new_image" class="block w-full mt-1" type="file" accept="image/*" />

            @if (!$new_image)
                <img src="{{ Storage::disk('s3')->url($section->image) }}" alt="Foto de la sección" class="mt-4">
            @elseif ($new_image)
                <img src="{{ $new_image->temporaryUrl() }}" alt="New section Photo" class="mt-4">
            @endif

            <x-input-error :messages="$errors->get('new_image')" class="mt-2" />
        </div>

        <!-- Descripción -->
        <div>
            <x-input-label for="description" :value="__('Descripción')" />
            <textarea placeholder="Descripción breve del encabezado" wire:model="description"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-500 focus:ring-yellow-500 dark:focus:ring-yellow-500"
                rows="4" autocomplete="description"></textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Texto del botón -->
        <div>
            <x-input-label for="button_text" :value="__('Texto del Botón')" />
            <x-text-input placeholder="Agendate" wire:model="button_text" class="block w-full mt-1" type="text"
                autocomplete="button_text" />
            <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
        </div>

        <!-- Enlace del botón -->
        <div>
            <x-input-label for="button_link" :value="__('Enlace del Botón')" />
            <x-text-input placeholder="contacto" wire:model="button_link" class="block w-full mt-1" type="url"
                autocomplete="button_link" />
            <x-input-error :messages="$errors->get('button_link')" class="mt-2" />
        </div>
    </div>

    <div class="flex">
        <div class="ml-auto">

        </div>
    </div>

    <div class="flex items-center justify-between mt-4">
        <!-- Spinner -->
        <div wire:loading wire:target="updateSection" class="">
            <x-spinner :text="__('Actualizando sección...')" />
        </div>

        <!-- Maintaining button to right-->
        <div></div>

        <div>
            <x-primary-button wire:click.prevent='updateSection'>
                {{ __('Actualizar') }}
            </x-primary-button>
        </div>
    </div>
</form>

<!-- section updated toast -->
{{-- @script --}}
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('sectionUpdatedToast', () => {
            toast('Actualizado', {
                type: 'success',
                position: 'bottom-right',
                description: 'Sección actualizada correctamente.'
            });
        });
    });
</script>
{{-- @endscript --}}
