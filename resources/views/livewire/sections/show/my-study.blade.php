<?php

use Livewire\Volt\Component;
use App\Models\Section;

new class extends Component {
    public $section;

    public function mount($section)
    {
        $this->section = $section;
    }
}; ?>

<section class="mt-12 pb-[20vh] space-y-6">
    <div class="mx-auto max-w-7xl">
        <h1 class="px-4 text-5xl font-bold underline md:text-7xl sm:px-6 md:px-8 decoration-yellow-500">Mi
            estudio</h1>
    </div>

    <div class="px-0 sm:px-6 md:px-8">
        <div class="relative flex items-center justify-center w-full min-h-screen bg-center bg-cover rounded-3xl"
            style="background-image: url('{{ Storage::disk('s3')->url($section->image) }}');" alt="{{ $section->title }}">

            <div class="flex flex-col items-start space-y-6">
                @php
                    // Divide el título en palabras
                    $words = explode(' ', $section->title);
                    // Separa la última palabra
                    $lastWord = array_pop($words);
                    // Une las palabras restantes
                    $remainingWords = implode(' ', $words);
                @endphp

                <h2 class="inline-block text-xl font-bold text-gray-900 sm:text-3xl md:text-5xl typing-effect">
                    {{ $remainingWords }} <span class="font-black underline decoration-yellow-500">{{ $lastWord }}</span>
                </h2>

                <!-- CTA -->
                <div
                    class="inline-block px-10 py-2 text-2xl font-medium text-center transition duration-300 ease-in-out bg-transparent border border-gray-700 rounded-full hover:cursor-pointer sm:w-auto backdrop-blur-md hover:backdrop-blur-lg hover:bg-yellow-100/50">
                    <a href="{{ $section->button_link }}" wire:navigate
                        class="flex items-center text-black hover:text-gray-800">
                        {{ $section->button_text }}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="ml-2 size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
