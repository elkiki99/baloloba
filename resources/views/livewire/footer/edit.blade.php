<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Validate;
use App\Models\Footer;

new class extends Component {
    public $footer;

    #[Validate('required|string|max:255', as: 'título')]
    public $title;

    #[Validate('required|string|max:500', as: 'descripción')]
    public $description;

    #[Validate('required|string|max:255', as: 'dirección')]
    public $address;

    #[Validate('required|url|max:255', as: 'enlace de LinkedIn')]
    public $linkedin;

    #[Validate('required|url|max:255', as: 'enlace de Instagram')]
    public $instagram;

    #[Validate('required|string|max:20', as: 'telefono')]
    public $phone;

    #[Validate('required|email|max:255', as: 'email')]
    public $email;

    public function mount()
    {
        $this->footer = Footer::findOrFail(1);
        $this->title = $this->footer->title;
        $this->description = $this->footer->description;
        $this->address = $this->footer->address;
        $this->linkedin = $this->footer->linkedin;
        $this->instagram = $this->footer->instagram;
        $this->phone = $this->footer->phone;
        $this->email = $this->footer->email;
    }

    public function updateFooter()
    {
        if (!Gate::allows('modify-page')) {
            abort(403);
        }

        $this->validate();

        $this->footer->update([
            'title' => $this->title,
            'description' => $this->description,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'linkedin' => $this->linkedin,
            'instagram' => $this->instagram
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
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                rows="4" autocomplete="description"></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>
        
        <!-- Address -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="address" :value="__('Dirección')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input placeholder="Dirección del estudio fotográfico" wire:model="address" class="block w-full mt-1" type="text"
                required autofocus autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>
        
        <!-- Phone -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="phone" :value="__('Número de teléfono')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input placeholder="Número de teléfono" wire:model="phone" class="block w-full mt-1" type="text"
                required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        
        <!-- Email -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="email" :value="__('Email')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input placeholder="Tu correo electrónico" wire:model="email" class="block w-full mt-1" type="email"
                required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <!-- Linkedin -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="linkedin" :value="__('Linkedin')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input placeholder="Tu dirección de linkedin" wire:model="linkedin" class="block w-full mt-1" type="url"
                required autofocus autocomplete="linkedin" />
            <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
        </div>
        
        <!-- Instagram -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="instagram" :value="__('Instagram')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input placeholder="Tu dirección de instagram" wire:model="instagram" class="block w-full mt-1" type="url"
                required autofocus autocomplete="instagram" />
            <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
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
