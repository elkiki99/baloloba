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

<section class="mt-12 space-y-6">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="text-5xl font-bold underline md:text-7xl decoration-yellow-500">Sobre mi</h1>

        <div class="items-center justify-between gap-10 mx-auto mt-6 lg:flex lg:flex-row-reverse max-w-7xl">
            <div class="lg:w-1/2">
                <img class="object-contain w-full h-auto rounded-3xl"
                    src="{{ Storage::disk('s3')->url($section->image) }}" alt="{{ $section->title }}">
            </div>

            <div
                class="lg:w-1/2 mt-6 space-y-6 lg:mt-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-yellow-500 via-white to-white">

                <h2 class="text-6xl font-bold lg:text-8xl">{{ $section->title }}</h2>

                <div class="">
                    <p class="text-xl text-gray-800">{{ $section->sub_title }}
                    </p>
                    <p class="text-base text-gray-700">{{ $section->description }}
                    </p>
                </div>

                <!-- Button -->
                <div
                    class="items-center inline-block px-10 py-2 text-2xl font-medium text-center transition duration-300 ease-in-out bg-transparent border border-gray-900 rounded-full hover:blur-xs hover:cursor-pointer sm:w-auto backdrop-blur-md hover:backdrop-blur-lg hover:bg-yellow-100">
                    <a href="{{ $section->button_link }}" wire:navigate
                        class="flex items-center text-gray-800 hover:text-gray-900">
                        {{ $section->button_text }}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="ml-2 size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
