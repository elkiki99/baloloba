<?php

use Livewire\Volt\Component;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public $testimonial;
    public $name;
    public $new_profile_image;
    public $headline;
    public $quote;
    public $username;
    public $bio;

    public function mount($id)
    {
        $this->testimonial = Testimonial::findOrFail($id);

        $this->name = $this->testimonial->name;
        $this->new_profile_image = $this->testimonial->new_profile_image;
        $this->headline = $this->testimonial->headline;
        $this->quote = $this->testimonial->quote;
        $this->username = $this->testimonial->username;
        $this->bio = $this->testimonial->bio;
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'new_profile_image' => 'nullable|image|max:10240',
        'headline' => 'required|string|max:255',
        'quote' => 'required|string|max:1000',
        'username' => 'required|string|max:255',
        'bio' => 'required|string|max:1000',
    ];

    public function updateTestimonial()
    {
        if (!Gate::allows('modify-page')) {
            abort(403);
        }

        $this->validate();

        $testimonialFolder = '/components/testimonials';
        $testimonialImageName = 'testimonial_' . now()->timestamp . '_' . Str::random(10);

        if ($this->new_profile_image) {
            if ($this->testimonial->profile_image && Storage::disk('s3')->exists($this->testimonial->profile_image)) {
                Storage::disk('s3')->delete($this->testimonial->profile_image);
            }

            $imagePath = $this->new_profile_image->storeAs($testimonialFolder, $testimonialImageName, 's3');
        } else {
            $imagePath = $this->testimonial->profile_image;
        }

        $slug = Str::slug($this->name);

        $this->testimonial->update([
            'name' => $this->name,
            'slug' => $slug,
            'new_profile_image' => $imagePath,
            'headline' => $this->headline,
            'quote' => $this->quote,
            'username' => $this->username,
            'bio' => $this->bio,
        ]);

        // Dispatch toast notification
        $this->dispatch('testimonialUpdatedToast');
    }
}; ?>

<form class="mt-6 space-y-6">
    <div class="space-y-6">
        <!-- Nombre -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="name" :value="__('Nombre')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input placeholder="Nombre del testimonio" wire:model="name" class="block w-full mt-1" type="text"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Titular -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="headline" :value="__('Titular')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input placeholder="Titular del testimonio" wire:model="headline" class="block w-full mt-1"
                type="text" required autocomplete="headline" />
            <x-input-error :messages="$errors->get('headline')" class="mt-2" />
        </div>

        <!-- Testimonial Photo -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="new_profile_image" :value="__('Foto del testimonio')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input wire:model="new_profile_image" class="block w-full mt-1" type="file" accept="image/*" />

            @if (!$new_profile_image)
                <img src="{{ Storage::disk('s3')->url($testimonial->profile_image) }}" alt="Foto del testimonio" class="mt-4 rounded-full ">
            @elseif ($new_profile_image)
                <img src="{{ $new_profile_image->temporaryUrl() }}" alt="Nueva foto del testimonio" class="mt-4 rounded-full ">
            @endif

            <x-input-error :messages="$errors->get('new_profile_image')" class="mt-2" />
        </div>

        <!-- Cita -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="quote" :value="__('Cita del testimonio')" />
                <span class="text-yellow-600">*</span>
            </div>
            <textarea placeholder="Cita breve del testimonio" wire:model="quote"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                rows="3" autocomplete="quote"></textarea>
            <x-input-error :messages="$errors->get('quote')" class="mt-2" />
        </div>

        <!-- Nombre de usuario -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="username" :value="__('Nombre de usuario (instagram)')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input placeholder="@balo_loba" wire:model="username" class="block w-full mt-1" type="text"
                autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Biografía -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="bio" :value="__('Breve biografía del testimonio')" />
                <span class="text-yellow-600">*</span>
            </div>
            <textarea placeholder="Biografía breve del testimonio" wire:model="bio"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                rows="2" autocomplete="bio"></textarea>
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>

    </div>

    <div class="flex">
        <div class="ml-auto">

        </div>
    </div>

    <div class="flex items-center justify-between mt-4">
        <!-- Spinner -->
        <div wire:loading wire:target="updateTestimonial" class="">
            <x-spinner :text="__('Actualizando testimonio...')" />
        </div>

        <!-- Maintaining button to right-->
        <div></div>

        <div>
            <x-primary-button wire:click.prevent='updateTestimonial'>
                {{ __('Actualizar') }}
            </x-primary-button>
        </div>
    </div>
</form>

<!-- Testimonial updated toast -->
{{-- @script --}}
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('testimonialUpdatedToast', () => {
            toast('Actualizado', {
                type: 'success',
                position: 'bottom-right',
                description: 'Testimonio actualizado correctamente.'
            });
        });
    });
</script>
{{-- @endscript --}}
