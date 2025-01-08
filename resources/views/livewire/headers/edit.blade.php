<?php

use Livewire\Volt\Component;
use App\Models\Header;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public $header;
    public $title;
    public $sub_title;
    public $description;
    public $button_text;
    public $button_link;
    public $new_image;

    public function mount($id)
    {
        $this->header = Header::findOrFail($id);

        $this->title = $this->header->title;
        $this->sub_title = $this->header->sub_title;
        $this->description = $this->header->description;
        $this->button_text = $this->header->button_text;
        $this->button_link = $this->header->button_link;
    }

    protected $rules = [
        'title' => 'required|string|max:255',
        'sub_title' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'button_text' => 'nullable|string|max:255',
        'button_link' => 'nullable|string|max:255',
        'new_image' => 'nullable|image|max:10240',
    ];

    public function updateHeader()
    {
        if (!Gate::allows('modify-page')) {
            abort(403);
        }

        $this->validate();

        // if ($this->new_image) {
        if ($this->new_image) {
            $headerFolder = '/components/headers';
            $headerImageName = 'header_' . now()->timestamp . '.' . $this->new_image->extension();
            // }

            if ($this->header->image && Storage::disk('s3')->exists($this->header->image)) {
                Storage::disk('s3')->delete($this->header->image);
            }

            $imagePath = $this->new_image->storeAs($headerFolder, $headerImageName, 's3');
        } else {
            $imagePath = $this->header->image;
        }

        $this->header->update([
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'description' => $this->description,
            'image' => $imagePath,
            'button_text' => $this->button_text,
            'button_link' => $this->button_link,
        ]);

        // Dispatch toast notification
        $this->dispatch('headerUpdatedToast');
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
                autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Subtítulo -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="sub_title" :value="__('Subtítulo')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input rows="2" placeholder="Subtítulo del encabezado" wire:model="sub_title" class="block w-full mt-1"
                type="text" autocomplete="sub_title" />
            <x-input-error :messages="$errors->get('sub_title')" class="mt-2" />
        </div>

        <!-- Header Photo -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="new_image" :value="__('Header')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input wire:model="new_image" class="block w-full mt-1" type="file" accept="image/*" />

            @if (!$new_image)
                <img src="{{ Storage::disk('s3')->url($header->image) }}" alt="Header Photo" class="mt-4">
            @elseif ($new_image)
                <img src="{{ $new_image->temporaryUrl() }}" alt="New Header Photo" class="mt-4">
            @endif

            <x-input-error :messages="$errors->get('new_image')" class="mt-2" />
        </div>

        <!-- Descripción -->
        <div>
            <x-input-label for="description" :value="__('Descripción')" />
            <textarea placeholder="Descripción breve del encabezado" wire:model="description"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-500 focus:ring-yellow-500 dark:focus:ring-yellow-500"
                rows="2" autocomplete="description"></textarea>
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
        <div wire:loading wire:target="updateHeader" class="">
            <x-spinner :text="__('Actualizando header...')" />
        </div>

        <!-- Maintaining button to right-->
        <div></div>

        <div>
            <x-primary-button wire:click.prevent='updateHeader'>
                {{ __('Actualizar') }}
            </x-primary-button>
        </div>
    </div>
</form>

<!-- Header updated toast -->
{{-- @script --}}
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('headerUpdatedToast', () => {
            toast('Actualizado', {
                type: 'success',
                position: 'bottom-right',
                description: 'Header actualizado correctamente.'
            });
        });
    });
</script>
{{-- @endscript --}}
