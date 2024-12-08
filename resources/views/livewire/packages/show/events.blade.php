<?php

use Livewire\Volt\Component;
use App\Models\Package;

new class extends Component {
    public $eventsPackage;

    public function mount()
    {
        $this->eventsPackage = Package::where('id', 3)->first();
    }
}; ?>

<!-- Events -->
<div class="max-w-[500px] mx-auto min-h-[50vh] md:min-h-[75vh] flex flex-col my-10 p-6 text-center transition bg-gray-100 border rounded-lg shadow-lg md:w-1/3 md:hover:scale-[1.02]"
    x-data="{
        basicFeatures: {{ $eventsPackage->basic_features }},
        extendedFeatures: {{ $eventsPackage->extended_features }},
        basicPrice: '{{ number_format($eventsPackage->basic_price, 0, ',', '.') }}',
        extendedPrice: '{{ number_format($eventsPackage->extended_price, 0, ',', '.') }}',
        beforeBasicPrice: '{{ number_format($eventsPackage->before_basic_price, 0, ',', '.') }}',
        beforeExtendedPrice: '{{ number_format($eventsPackage->before_extended_price, 0, ',', '.') }}'
    }">
    <div class="justify-between pb-2 flex text-start">
        <div class="">
            <h2 class="text-xl lg:text-2xl font-semibold">{{ $eventsPackage->name }}</h2>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-16 lg:size-20">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
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
