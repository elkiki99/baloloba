<?php

use Livewire\Volt\Component;
use App\Models\Package;

new class extends Component {
    public $polaroidsPackage;
    public $name;
    public $basic_price;
    public $extended_price;
    public $description;
    public $basic_features;
    public $extended_features;

    protected $rules = [
        'name' => 'required|string|max:255',
        'basic_price' => 'required|numeric|min:0',
        'extended_price' => 'required|numeric|min:0',
        'description' => 'nullable|string|max:500',
        'basic_features' => 'required|string',
        'basic_features.*' => 'string|max:255',
        'extended_features' => 'required|string',
        'extended_features.*' => 'string|max:255',
    ];

    public function mount()
    {
        $this->polaroidsPackage = Package::where('id', 1)->first();
        $this->name = $this->polaroidsPackage->name;
        $this->basic_price = $this->polaroidsPackage->basic_price;
        $this->extended_price = $this->polaroidsPackage->extended_price;
        $this->description = $this->polaroidsPackage->description;
        $this->basic_features = implode(', ', json_decode($this->polaroidsPackage->basic_features, true));
        $this->extended_features = implode(', ', json_decode($this->polaroidsPackage->extended_features, true));
    }

    public function updatePolaroidsPackage()
    {
        $this->validate();

        $basic_features_array = array_map('trim', explode(',', $this->basic_features));
        $basic_features_json = json_encode($basic_features_array);

        $extended_features_array = array_map('trim', explode(',', $this->extended_features));
        $extended_features_json = json_encode($extended_features_array);

        $this->polaroidsPackage->update([
            'name' => $this->name,
            'basic_price' => $this->basic_price,
            'before_basic_price' => round($this->basic_price / 0.85, 2),
            'extended_price' => $this->extended_price,
            'before_extended_price' => round($this->extended_price / 0.85, 2),
            'description' => $this->description,
            'basic_features' => $basic_features_json,
            'extended_features' => $extended_features_json,
        ]);

        $this->dispatch('polaroidsPackageUpdatedToast');
    }
}; ?>

<form class="mt-6 space-y-6">
    <x-package-form :package="$polaroidsPackage" />

    <div class="flex">
        <div class="ml-auto">
            <x-primary-button wire:click.prevent='updatePolaroidsPackage'>
                {{ __('Actualizar') }}
            </x-primary-button>
        </div>
    </div>
</form>

<!-- Polaroids package updated toast -->
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('polaroidsPackageUpdatedToast', (event) => {
            toast('Actualizado', {
                type: 'success',
                position: 'bottom-right',
                description: 'Paquete de polaroids actualizado correctamente.'
            });
        });
    });
</script>
