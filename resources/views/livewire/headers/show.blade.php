<?php

use Livewire\Volt\Component;
use App\Models\Header;

new class extends Component {
    public $header;

    public function mount($header)
    {
        $this->header = $header;
    }
}; ?>

<!-- Header -->
<section class="flex flex-col items-start justify-center w-full min-h-screen bg-center bg-cover"
    style="background-image: url('{{ Storage::disk('s3')->url($header->image) }}'); background-position: top;">
    <div class="absolute inset-0 bg-black {{ $header->id === 1 ? 'mt-[68px] sm:mt-5' : 'mt-0' }} h-screen bg-opacity-50">
    </div>

    <div class="relative z-10 w-full px-6 mx-auto space-y-6 max-w-7xl text-start">
        @php
            // Divide el título en palabras
            $words = explode(' ', $header->title);
            // Calcula el índice de división
            $splitIndex = ceil(count($words) / 2);
            // Separa las palabras en dos partes
            $firstPart = implode(' ', array_slice($words, 0, $splitIndex));
            $secondPart = implode(' ', array_slice($words, $splitIndex));
        @endphp
        <h1 class="text-6xl font-bold text-white uppercase md:text-9xl">
            {{ $firstPart }}
            <span class="super-thin">{{ $secondPart }}</span>
        </h1>

        <p class="max-w-2xl text-lg leading-relaxed text-gray-200 md:text-xl">{{ $header->sub_title }}</p>

        @if ($header->description)
            <p class="max-w-2xl text-sm leading-relaxed text-gray-300 md:text-base">
                {{ $header->description }}
            </p>
        @endif

        @if ($header->button_text && $header->button_link)
            <!-- CTA -->
            <div
                class="items-center inline-block px-10 py-2 text-2xl font-medium text-center transition duration-300 ease-in-out bg-transparent border border-gray-300 rounded-full hover:blur-xs hover:cursor-pointer sm:w-auto backdrop-blur-md hover:backdrop-blur-lg hover:bg-white/10">
                <a href="{{ route('contact') }}" wire:navigate class="flex items-center text-white hover:text-gray-200">
                    AGENDATE
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="ml-2 size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>
