<?php

use Livewire\Volt\Component;
use App\Models\Package;

new class extends Component {
    public $fashionPackage;

    public function mount()
    {
        $this->fashionPackage = Package::where('id', 2)->first();
    }
}; ?>

<!-- Fashion -->
<div class="max-w-[500px] mx-auto min-h-[50vh] md:min-h-[75vh] flex flex-col my-10 p-6 text-center transition bg-gray-100 border rounded-lg shadow-lg md:w-1/3 md:hover:scale-[1.02]"
    x-data="{
        basicFeatures: {{ $fashionPackage->basic_features }},
        extendedFeatures: {{ $fashionPackage->extended_features }},
        basicPrice: '{{ number_format($fashionPackage->basic_price, 0, ',', '.') }}',
        extendedPrice: '{{ number_format($fashionPackage->extended_price, 0, ',', '.') }}',
        beforeBasicPrice: '{{ number_format($fashionPackage->before_basic_price, 0, ',', '.') }}',
        beforeExtendedPrice: '{{ number_format($fashionPackage->before_extended_price, 0, ',', '.') }}'
    }">
    <div class="justify-between pb-2 flex text-start">
        <div class="">
            <h2 class="text-xl lg:text-2xl font-semibold">{{ $fashionPackage->name }}</h2>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-16 lg:size-20">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
            </svg>
        </div>
        <div class="flex flex-col items-end gap-2">
            <span class="text-3xl lg:text-4xl font-bold underline decoration-yellow-500"
                x-text="isExtended ? extendedPrice : basicPrice"></span>
            <span class="text-md text-gray-500 lg:text-xl font-bold line-through"
                x-text="isExtended ? beforeExtendedPrice : beforeBasicPrice"></span>
        </div>
    </div>

    <!-- Features: Moda -->
    <ul class="flex-grow my-4">
        <template x-for="(feature, index) in (isExtended ? extendedFeatures : basicFeatures)" :key="index">
            <li class="flex mb-2 text-start text-sm lg:text-base" x-text="'✔ ' + feature"></li>
        </template>
    </ul>

    {{-- @guest --}}
        <a :href="isExtended ? annualMasterUrl : monthlyMasterUrl"
            class="flex items-center justify-center w-full px-4 py-2 text-gray-100 rounded-lg hover:blur-xs hover:cursor-pointer bg-gray-950">Obtener
            sesión
        </a>
    {{-- @endguest --}}
</div>
