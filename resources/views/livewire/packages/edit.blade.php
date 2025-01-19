<?php

use Livewire\Volt\Component;
use App\Models\Package;
use Livewire\Attributes\Validate;

new class extends Component {
    public $package;

    #[Validate('required|string|max:255', as: 'nombre')]
    public $name;

    #[Validate('required|numeric|min:0', as: 'precio extendido')]
    public $basic_price;

    #[Validate('required|numeric|min:0', as: 'precio extendido')]
    public $extended_price;

    #[Validate('nullable|string|max:500', as: 'descripción')]
    public $description;

    #[Validate('required|string', as: 'características báscias')]
    public $basic_features;

    #[Validate('required|string|max:500', as: 'características extendidas')]
    public $extended_features;

    public function mount($id)
    {
        $this->package = Package::findOrFail($id);
        $this->name = $this->package->name;
        $this->basic_price = $this->package->basic_price;
        $this->extended_price = $this->package->extended_price;
        $this->description = $this->package->description;
        $this->basic_features = implode(', ', json_decode($this->package->basic_features, true));
        $this->extended_features = implode(', ', json_decode($this->package->extended_features, true));
    }

    public function updatePackage()
    {
        if (!Gate::allows('modify-page')) {
            abort(403);
        }

        $this->validate();

        $basic_features_array = array_map('trim', explode(',', $this->basic_features));
        $basic_features_json = json_encode($basic_features_array);

        $extended_features_array = array_map('trim', explode(',', $this->extended_features));
        $extended_features_json = json_encode($extended_features_array);

        $this->package->update([
            'name' => $this->name,
            'basic_price' => $this->basic_price,
            'before_basic_price' => round($this->basic_price / 0.85, 2),
            'extended_price' => $this->extended_price,
            'before_extended_price' => round($this->extended_price / 0.85, 2),
            'description' => $this->description,
            'basic_features' => $basic_features_json,
            'extended_features' => $extended_features_json,
        ]);

        // Package updated toast
        $this->dispatch('packageUpdatedToast');
    }
}; ?>

<form class="mt-6 space-y-6">
    <x-package-form :package="$package" />

    <div class="flex">
        <div class="ml-auto">
            <x-primary-button wire:click.prevent='updatePackage'>
                {{ __('Actualizar') }}
            </x-primary-button>
        </div>
    </div>
</form>

<!-- Package updated toast -->
@script
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('packageUpdatedToast', () => {
                toast('Actualizado', {
                    type: 'success',
                    position: 'bottom-right',
                    description: 'Paquete actualizado correctamente.'
                });
            });
        });
    </script>
@endscript
