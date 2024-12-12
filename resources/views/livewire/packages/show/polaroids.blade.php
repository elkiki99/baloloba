<?php

use Livewire\Volt\Component;
use App\Models\Package;

new class extends Component {
    public $polaroidsPackage;

    public function mount()
    {
        $this->polaroidsPackage = Package::where('id', 1)->first();
    }
}; ?>

<!-- Polaroids (Center Highlighted) -->
<div class="max-w-[500px] mx-auto min-h-[50vh] flex flex-col my-10 p-6 text-center transition transform md:scale-110 bg-gray-950 border rounded-lg shadow-lg md:w-1/3 md:hover:scale-[1.12]"
    x-data="{
        basicFeatures: {{ $polaroidsPackage->basic_features }},
        extendedFeatures: {{ $polaroidsPackage->extended_features }},
        basicPrice: '{{ number_format($polaroidsPackage->basic_price, 0, ',', '.') }}',
        extendedPrice: '{{ number_format($polaroidsPackage->extended_price, 0, ',', '.') }}',
        beforeBasicPrice: '{{ number_format($polaroidsPackage->before_basic_price, 0, ',', '.') }}',
        beforeExtendedPrice: '{{ number_format($polaroidsPackage->before_extended_price, 0, ',', '.') }}'
    }">
    <div class="flex justify-between pb-2 text-start">
        <div class="">
            <h2 class="text-xl font-semibold text-white lg:text-2xl">{{ $polaroidsPackage->name }}</h2>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="text-white size-16 lg:size-20">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
            </svg>
        </div>
        <div class="flex flex-col items-end gap-2 text-gray-100">
            <span class="text-3xl font-bold underline lg:text-4xl decoration-yellow-500"
                x-text="isExtended ? extendedPrice : basicPrice"></span>
            <span class="font-bold text-gray-500 line-through text-md lg:text-xl"
                x-text="isExtended ? beforeExtendedPrice : beforeBasicPrice"></span>
        </div>
    </div>

    <!-- Features: Polaroids -->
    <ul class="flex-grow my-4">
        <template x-for="(feature, index) in (isExtended ? extendedFeatures : basicFeatures)" :key="index">
            <li class="flex mb-2 text-sm text-gray-200 text-start lg:text-base" x-text="'✔ ' + feature"></li>
        </template>
    </ul>

    {{-- @guest --}}
    <a :href="isExtended ? annualStructuralUrl : monthlyStructuralUrl"
        class="flex items-center justify-center w-full px-4 py-2 my-2 mt-auto text-gray-900 bg-yellow-500 rounded-lg hover:blur-xs hover:cursor-pointer">Obtener
        sesión
    </a>
    {{-- @endguest --}}
</div>
