<?php

use Livewire\Volt\Component;
use App\Models\Testimonial;

new class extends Component {
    public function with()
    {
        return [
            'testimonials' => Testimonial::all(),
        ];
    }
}; ?>

<section class="mt-12 space-y-6">
    <div class="mx-auto max-w-7xl">
        <h1 class="px-4 text-5xl font-bold underline md:text-7xl sm:px-6 lg:px-8 decoration-yellow-500">
            Testimonios</h1>

        <div class="grid-cols-2 gap-6 px-0 mt-6 space-y-4 md:space-y-0 md:grid sm:px-6 lg:px-8">
            <!-- Testimonials -->
            @forelse ($testimonials as $testimonial)
                <blockquote
                    class="relative w-full max-w-3xl p-4 pb-6 mx-auto border-b border-gray-200 rounded shadow md:p-8">
                    <footer class="pb-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <img class="rounded-full size-24"
                                    src="{{ Storage::disk('s3')->url($testimonial->profile_image) }}"
                                    alt="Valentina Camejo">
                            </div>
                            <div class="ml-4">
                                <div x-data="{
                                    hoverCardHovered: false,
                                    hoverCardDelay: 600,
                                    hoverCardLeaveDelay: 500,
                                    hoverCardTimout: null,
                                    hoverCardLeaveTimeout: null,
                                    hoverCardEnter() {
                                        clearTimeout(this.hoverCardLeaveTimeout);
                                        if (this.hoverCardHovered) return;
                                        clearTimeout(this.hoverCardTimout);
                                        this.hoverCardTimout = setTimeout(() => {
                                            this.hoverCardHovered = true;
                                        }, this.hoverCardDelay);
                                    },
                                    hoverCardLeave() {
                                        clearTimeout(this.hoverCardTimout);
                                        if (!this.hoverCardHovered) return;
                                        clearTimeout(this.hoverCardLeaveTimeout);
                                        this.hoverCardLeaveTimeout = setTimeout(() => {
                                            this.hoverCardHovered = false;
                                        }, this.hoverCardLeaveDelay);
                                    }
                                }" class="relative" @mouseover="hoverCardEnter()"
                                    @mouseleave="hoverCardLeave()">
                                    <div
                                        class="text-2xl font-semibold text-gray-800 hover:underline hover:cursor-pointer">
                                        {{ $testimonial->name }}</div>
                                    <div x-show="hoverCardHovered"
                                        class="absolute top-0 w-[365px] max-w-lg mt-5 z-30 -translate-x-1/2 translate-y-3 left-1/2"
                                        x-cloak>
                                        <div x-show="hoverCardHovered"
                                            class="w-[full] h-auto bg-white space-x-3 p-5 flex items-start rounded-md shadow-sm border border-neutral-200/70"
                                            x-transition>
                                            <img src="{{ Storage::disk('s3')->url($testimonial->profile_image) }}" alt="{{ $testimonial->name }}"
                                                class="rounded-full w-14 h-14" />
                                            <div class="relative">
                                                <p class="mb-1 font-bold">{{ $testimonial->username }}</p>
                                                <p class="mb-1 text-sm text-gray-600">{{ $testimonial->bio }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-lg text-gray-500">{{ $testimonial->headline }}</div>
                                </div>
                            </div>
                    </footer>

                    <div class="relative z-10">
                        <p class="text-gray-800 sm:text-xl"><em>
                                “{{ $testimonial->quote }}”
                            </em></p>
                    </div>
                </blockquote>
            @empty
                <p>No hay testimonios disponibles</p>
            @endforelse
        </div>
    </div>
</section>
