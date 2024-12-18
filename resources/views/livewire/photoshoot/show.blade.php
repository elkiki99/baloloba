<?php

use Livewire\Volt\Component;
use App\Models\PhotoShoot;

new class extends Component {
    public $id;
    public $photo;
    public $photos;
    public $liked = false;
    public $photoshoot;

    public function mount($id)
    {
        $this->photoshoot = PhotoShoot::findOrFail($id);

        $this->photos = $this->photoshoot
            ->photos()
            ->orderBy('position', 'asc')
            ->get()
            ->map(function ($photo) {
                return [
                    'id' => $photo->id,
                    'photo' => Storage::disk('s3')->url($photo->filename),
                    'alt' => $photo->filename,
                ];
            });
    }

    public function toggleLike($photoId)
    {
        dd($photoId);
        // $liked = ClientPhotoQuantity::where('client_photo_shoot_id', $this->photoshoot->id)->where('photo_id', $photoId);

        // if ($liked->exists()) {
        //     $liked->delete();
        // } else {
        //     ClientPhotoQuantity::create([
        //         'client_photo_shoot_id' => $this->photoshoot->id,
        //         'photo_id' => $photoId,
        //         'quantity' => 1,
        //     ]);
        // }

        // $this->dispatch('$refresh');
    }
}; ?>

<div x-data="{
    imageGalleryOpened: false,
    imageGalleryActiveUrl: null,
    imageGalleryImageIndex: null,
    imageGallery: {{ $photos }},
    {{-- likedImages: @entangle('liked'), --}}
    imageGalleryOpen(event) {
        this.imageGalleryImageIndex = event.target.dataset.index;
        this.imageGalleryActiveUrl = event.target.src;
        this.imageGalleryOpened = true;
    },
    imageGalleryClose() {
        this.imageGalleryOpened = false;
        setTimeout(() => this.imageGalleryActiveUrl = null, 300);
    },
    imageGalleryNext() {
        this.imageGalleryImageIndex = (this.imageGalleryImageIndex == this.imageGallery.length) ? 1 : (parseInt(this.imageGalleryImageIndex) + 1);
        this.imageGalleryActiveUrl = this.$refs.gallery.querySelector('[data-index=\'' + this.imageGalleryImageIndex + '\']').src;
    },
    imageGalleryPrev() {
        this.imageGalleryImageIndex = (this.imageGalleryImageIndex == 1) ? this.imageGallery.length : (parseInt(this.imageGalleryImageIndex) - 1);
        this.imageGalleryActiveUrl = this.$refs.gallery.querySelector('[data-index=\'' + this.imageGalleryImageIndex + '\']').src;

    }
}" @image-gallery-next.window="imageGalleryNext()"
    @image-gallery-prev.window="imageGalleryPrev()" @keyup.right.window="imageGalleryNext();"
    @keyup.left.window="imageGalleryPrev();" class="w-full h-full select-none">
    <div class="duration-1000 delay-300 opacity-0 select-none ease animate-fade-in-view"
        style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
        <ul x-ref="gallery" id="gallery" class="grid gap-1 sm:grid-cols-2 md:grid-cols-3">
            <template x-for="(image, index) in imageGallery" :key="image.id">
                <li><img x-on:click="imageGalleryOpen" :src="image.photo" :alt="image.alt"
                        :data-index="index"
                        class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]">
                </li>
            </template>
        </ul>
    </div>

    <!-- Modal -->
    <template x-teleport="body">
        <div x-show="imageGalleryOpened" x-transition:enter="transition ease-in-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:leave="transition ease-in-in duration-300"
            x-transition:leave-end="opacity-0" @click="imageGalleryClose" @keydown.window.escape="imageGalleryClose"
            x-trap.inert.noscroll="imageGalleryOpened"
            class="fixed inset-0 py-2 flex items-center justify-center bg-black bg-opacity-90 select-none z-[150] cursor-zoom-out"
            x-cloak>
            <div class="relative flex items-center justify-center w-full h-full px-4">
                <!-- Botón para imagen anterior -->
                <div @click="$event.stopPropagation(); imageGalleryPrev()"
                    class="absolute left-0 z-10 flex items-center justify-center text-white translate-x-5 rounded-full cursor-pointer xl:translate-x-12 2xl:translate-x-16 bg-white/10 w-14 h-14 hover:bg-white/20">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </div>

                <!-- Imagen central -->
                <img x-show="imageGalleryOpened" x-transition:enter="transition ease-in-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-50"
                    x-transition:leave="transition ease-in-in duration-300"
                    x-transition:leave-end="opacity-0 transform scale-50"
                    class="object-contain max-w-full max-h-full select-none cursor-zoom-out"
                    :src="imageGalleryActiveUrl" alt="">

                <!-- Like button for photoshoot client -->
                <div class="absolute z-10 top-4 right-4">
                    @can('like-photoshoot-photos', $photoshoot)
                        <button x-on:click="$wire.toggleLike(imageGallery[imageGalleryImageIndex].id)"
                            class="flex items-center justify-center">
                            <svg :class="{ 'fill-red-500': likedImages.includes(image.id) }"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="text-white size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>
                    @endcan
                </div>

                <!-- Botón para imagen siguiente -->
                <div @click="$event.stopPropagation(); imageGalleryNext();"
                    class="absolute right-0 z-10 flex items-center justify-center text-white -translate-x-5 rounded-full cursor-pointer xl:-translate-x-12 2xl:-translate-x-16 bg-white/10 w-14 h-14 hover:bg-white/20">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </div>
        </div>
    </template>
</div>
