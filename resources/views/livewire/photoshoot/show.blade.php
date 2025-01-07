<?php

use Livewire\Volt\Component;
use App\Models\PhotoShoot;
use App\Models\ClientPhotoQuantity;
use App\Models\ClientPhotoShoot;
use App\Notifications\AdminNotifiedOfReviewApproval;
use App\Notifications\UserApprovedReview;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

new class extends Component {
    public $photoshoot;
    public $photos = [];
    public $photo;
    public $likedImages = [];
    public $quantities = [];

    public $clientPhotoShootId;

    public function mount($id)
    {
        $this->photoshoot = PhotoShoot::findOrFail($id);
        $this->clientPhotoShootId = ClientPhotoShoot::where('photo_shoot_id', $this->photoshoot->id)->first();

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

        if (isset($this->clientPhotoShootId)) {
            $clientPhotoQuantities = ClientPhotoQuantity::where('client_photo_shoot_id', $this->clientPhotoShootId->id)->get();

            $this->likedImages = $clientPhotoQuantities->pluck('photo_id')->toArray();
            $this->quantities = $clientPhotoQuantities->pluck('quantity', 'photo_id')->toArray();
        }
    }

    public function toggleLike($photoId)
    {
        if (!Gate::allows('like-photoshoot-photos', $this->photoshoot)) {
            abort(403);
        }

        if (in_array($photoId, $this->likedImages)) {
            ClientPhotoQuantity::where('client_photo_shoot_id', $this->clientPhotoShootId->id)
                ->where('photo_id', $photoId)
                ->delete();
        } else {
            ClientPhotoQuantity::create([
                'client_photo_shoot_id' => $this->clientPhotoShootId->id,
                'photo_id' => $photoId,
            ]);
        }

        $this->likedImages = ClientPhotoQuantity::where('client_photo_shoot_id', $this->clientPhotoShootId->id)
            ->pluck('photo_id')
            ->toArray();
    }

    public function addPhotoQuantity($photoId)
    {
        $clientPhotoQuantity = ClientPhotoQuantity::where('client_photo_shoot_id', $this->clientPhotoShootId->id)
            ->where('photo_id', $photoId)
            ->first();

        if ($clientPhotoQuantity) {
            $clientPhotoQuantity->update(['quantity' => $clientPhotoQuantity->quantity + 1]);
        } else {
            ClientPhotoQuantity::create([
                'client_photo_shoot_id' => $this->clientPhotoShootId->id,
                'photo_id' => $photoId,
                'quantity' => 1,
            ]);
        }
    }

    public function removePhotoQuantity($photoId)
    {
        $clientPhotoQuantity = ClientPhotoQuantity::where('client_photo_shoot_id', $this->clientPhotoShootId->id)
            ->where('photo_id', $photoId)
            ->first();

        if ($clientPhotoQuantity) {
            if ($clientPhotoQuantity->quantity > 1) {
                $clientPhotoQuantity->update(['quantity' => $clientPhotoQuantity->quantity - 1]);
            }
        }
    }

    public function userApprovedReview()
    {
        $this->photoshoot->status = 'draft';
        $this->photoshoot->save();

        Notification::sendNow(Auth::user(), new UserApprovedReview($this->photoshoot));

        $admin = User::where('isAdmin', true)->first();
        if ($admin) {
            Notification::sendNow($admin, new AdminNotifiedOfReviewApproval($this->photoshoot, Auth::user()));
        }

        return redirect()->route('client.photoshoots')->with('photoshoot-approved', 'Photoshoot aprobado exitosamente');
    }
}; ?>

<div class="space-y-6">
    @if ($photoshoot->status === 'client_preview')
        <div class="flex items-center gap-2 px-4 mx-auto text-3xl underline max-w-7xl sm:px-6 lg:px-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
            </svg>
            <h2 class="underline decoration-yellow-500">Photoshoot en
                revisión...</h2>
        </div>
    @endif

    <div x-data="{
        imageGalleryOpened: false,
        imageGalleryActiveUrl: null,
        imageGalleryImageIndex: null,
        imageGallery: {{ $photos }},
        likedImages: @entangle('likedImages'),
        imageGalleryOpen(event) {
            this.imageGalleryImageIndex = parseInt(event.target.dataset.index);
            this.imageGalleryActiveUrl = this.imageGallery[this.imageGalleryImageIndex].photo;
            this.imageGalleryOpened = true;
        },
        imageGalleryClose() {
            this.imageGalleryOpened = false;
            setTimeout(() => this.imageGalleryActiveUrl = null, 300);
        },
        imageGalleryNext() {
            this.imageGalleryImageIndex = (this.imageGalleryImageIndex + 1) % this.imageGallery.length;
            this.imageGalleryActiveUrl = this.imageGallery[this.imageGalleryImageIndex].photo;
        },
        imageGalleryPrev() {
            this.imageGalleryImageIndex = (this.imageGalleryImageIndex - 1 + this.imageGallery.length) % this.imageGallery.length;
            this.imageGalleryActiveUrl = this.imageGallery[this.imageGalleryImageIndex].photo;
        },
        toggleLikedImage(imageId) {
            @this.call('toggleLike', imageId);
        },
        addPhotoQuantity(imageId) {
            @this.call('addPhotoQuantity', imageId);
        },
        removePhotoQuantity(imageId) {
            @this.call('removePhotoQuantity', imageId);
        }
    
    }" @image-gallery-next.window="imageGalleryNext()"
        @image-gallery-prev.window="imageGalleryPrev()" @keyup.right.window="imageGalleryNext();"
        @keyup.left.window="imageGalleryPrev();" @like-toggled.window="toggleLikedImage($event.detail)"
        class="w-full h-full select-none">

        <div class="duration-1000 delay-300 opacity-0 select-none ease animate-fade-in-view"
            style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
            <ul x-ref="gallery" id="gallery" class="grid gap-1 sm:grid-cols-2 md:grid-cols-3">
                <template x-for="(image, index) in imageGallery">
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
                    <!-- Prev image -->
                    <div @click="$event.stopPropagation(); imageGalleryPrev()"
                        class="absolute left-0 z-10 flex items-center justify-center text-white translate-x-5 rounded-full cursor-pointer xl:translate-x-12 2xl:translate-x-16 bg-white/10 w-14 h-14 hover:bg-white/20">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </div>

                    <!-- Central image -->
                    <img x-show="imageGalleryOpened" x-transition:enter="transition ease-in-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-50"
                        x-transition:leave="transition ease-in-in duration-300"
                        x-transition:leave-end="opacity-0 transform scale-50"
                        class="object-contain max-w-full max-h-full select-none cursor-zoom-out"
                        :src="imageGalleryActiveUrl" alt="">

                    <!-- Like button for photoshoot client -->
                    <div class="absolute z-10 top-4 right-4">
                        @can('like-photoshoot-photos', $photoshoot)
                            <button
                                x-on:click="$event.stopPropagation(); toggleLikedImage(imageGallery[imageGalleryImageIndex].id)"
                                class="flex items-center justify-center">
                                <svg :fill="likedImages.includes(imageGallery[imageGalleryImageIndex].id) ? 'red' : 'none'"
                                    :stroke="likedImages.includes(imageGallery[imageGalleryImageIndex].id) ? 'none' : 'white'"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="transition-all duration-200 ease-in-out size-12">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </button>
                        @endcan
                    </div>

                    <!-- Next image -->
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

    @if ($photoshoot->status === 'client_preview')
        <!-- Liked photoshoot photos -->
        <div class="px-4 pt-12 mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="">
                <div class="flex items-center gap-2 text-3xl ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>

                    @can('like-photoshoot-photos', $photoshoot)
                        <div class="flex flex-col">
                            <h2 class="underline decoration-yellow-500">Tus me gusta</h2>
                        </div>
                    @endcan

                    @can('modify-page')
                        <h2 class="underline decoration-yellow-500">Me gustas del cliente</h2>
                    @endcan
                </div>

                @can('like-photoshoot-photos', $photoshoot)
                    <p class="mt-2 text-sm text-gray-700">Aquí puedes ver tus fotografías favoritas. ¿Tu
                        paquete cuenta con fotos impresas? Elige también la cantidad.</p>
                @endcan

                <div x-data="{
                    likedImages: @entangle('likedImages'),
                    imageGallery: @js($photos),
                    quantities: @entangle('quantities')
                }" class="grid grid-cols-4 gap-1 space-y-6 md:grid-cols-6">
                    <template x-for="image in likedImages" :key="image">
                        <div class="relative">
                            <img :src="imageGallery.find(photo => photo.id === image)?.photo"
                                :alt="imageGallery.find(photo => photo.id === image)?.alt"
                                class="object-cover w-full h-full" />
                            @can('like-photoshoot-photos', $photoshoot)
                                <button @click="$wire.call('toggleLike', image)"
                                    class="absolute p-1 text-white bg-transparent rounded-full top-2 right-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <div
                                    class="absolute bottom-0 left-0 flex items-center justify-center w-full p-2 space-x-4 bg-black bg-opacity-50">
                                    <!-- Remove photo quantity -->
                                    <button
                                        @click="$wire.call('removePhotoQuantity', image); if (quantities[image] > 1) { quantities[image] -= 1 }"
                                        class="text-white ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                        </svg>
                                    </button>

                                    <!-- Show photo quantity -->
                                    <div class="w-6 text-lg font-bold text-center text-white">
                                        <span class="text-sm" x-text="quantities[image] ?? 1"></span>
                                    </div>

                                    <!-- Add photo quantity -->
                                    <button
                                        @click="$wire.call('addPhotoQuantity', image); quantities[image] = (quantities[image] ?? 1) + 1"
                                        class="text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </button>
                                </div>
                            @endcan

                            @can('modify-page', $photoshoot)
                                <div class="absolute p-1 text-white bg-transparent rounded-full top-2 right-2">
                                    <div class="w-6 text-lg font-bold text-center text-white">
                                        <span class="text-sm" x-text="quantities[image] ?? 1"></span>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </template>

                    @can('modify-page')
                        <p class="absolute text-sm text-gray-600" x-show="!likedImages.length">
                            El cliente no ha marcado ninguna foto como me gusta
                        </p>
                    @endcan
                </div>

                @can('like-photoshoot-photos', $photoshoot)
                    <x-primary-button class="mt-6"
                        x-on:click.prevent="$dispatch('open-modal', 'approve-photoshoot-review')">Aprobar
                        revisión</x-primary-button>
                @endcan

                <x-modal name="approve-photoshoot-review">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('¿Aprobar esta revisión?') }}
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Una vez aprobada esta revisión, no podrás modificar más este photoshoot y se notificará al administrador para que lo apruebe.') }}
                        </p>

                        <div class="flex justify-end gap-2 mt-6">
                            <x-secondary-button class="px-4 py-2" x-on:click="$dispatch('close')">
                                {{ __('Cancelar') }}
                            </x-secondary-button>

                            <x-primary-button wire:click='userApprovedReview'>Aprobar</x-primary-button>
                        </div>
                    </div>
                </x-modal>
            </div>
        </div>
    @elseif($photoshoot->status === 'draft')
        @can('modify-page', $photoshoot)
            <div class="px-4 mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8 {{ !$likedImages ? 'hidden pt-0' : 'pt-12 ' }}">
                <div class="">
                    <div class="flex items-center gap-2 text-3xl ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>

                        <h2 class="underline decoration-yellow-500">Me gustas del cliente</h2>
                    </div>

                    <div x-data="{
                        likedImages: @entangle('likedImages'),
                        imageGallery: @js($photos),
                        quantities: @entangle('quantities')
                    }" class="grid grid-cols-4 gap-1 space-y-6 md:grid-cols-6">
                        <template x-for="image in likedImages" :key="image">
                            <div class="relative">
                                <img :src="imageGallery.find(photo => photo.id === image)?.photo"
                                    :alt="imageGallery.find(photo => photo.id === image)?.alt"
                                    class="object-cover w-full h-full" />

                                <div class="absolute p-1 text-white bg-transparent rounded-full top-2 right-2">
                                    <div class="w-6 text-lg font-bold text-center text-white">
                                        <span class="text-sm" x-text="quantities[image] ?? 1"></span>
                                    </div>
                                </div>
                            </div>
                        </template>
                        
                        <p class="absolute text-sm text-gray-600" x-show="!likedImages.length">
                            El cliente no ha marcado ninguna foto como me gusta
                        </p>
                    </div>
                </div>
            </div>
        @endcan
    @endif
</div>
