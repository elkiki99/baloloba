<?php

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File as HttpFile;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use Illuminate\Support\Str;
use App\Models\PhotoShoot;
use App\Models\Category;
use App\Models\Photo;

new class extends Component {
    use WithFileUploads;

    #[Validate('required|string|max:48', as: 'nombre')]
    public $name;

    #[Validate('nullable|string|max:500', as: 'descripcion')]
    public $description;

    #[Validate('required|image|max:10240', as: 'foto de portada')]
    public $cover_photo;

    #[Validate('required|image|max:10240', as: 'foto de cabecera')]
    public $header_photo;

    #[Validate('required|date', as: 'fecha')]
    public $date;

    #[Validate('required|string|in:published,draft,client_preview', as: 'estado')]
    public $status = 'published';

    #[Validate('required|exists:categories,id', as: 'categoría')]
    public $category_id = 1;

    #[Validate('nullable|numeric|min:0', as: 'precio')]
    public $price;

    #[Validate('required|string|max:255', as: 'ubicación')]
    public $location;

    #[Validate('nullable|integer|min:1', as: 'duración')]
    public $duration;
        
    #[Validate('required', as: 'fotos')]
    public $photos = [];
    
    public $slug;
    public $categories = [];


    public function mount()
    {
        $this->categories = Category::all();
        $this->date = now()->toDateString();
    }

    public function generateSlug()
    {
        $slug = Str::slug($this->name);
        $originalSlug = $slug;
        $i = 1;

        while (PhotoShoot::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }

        $this->slug = $slug;
    }

    public function createPhotoShoot()
    {
        if (!Gate::allows('modify-page')) {
            abort(403);
        }

        $this->validate();
        
        $this->generateSlug();

        $photoshoot = PhotoShoot::create([
            'name' => $this->name,
            'description' => $this->description,
            'cover_photo' => $this->cover_photo,
            'header_photo' => $this->header_photo,
            'date' => $this->date,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'location' => $this->location,
            'duration' => $this->duration,
            'slug' => $this->slug,
        ]);

        $photoshootFolder = 'photoshoots/' . $this->slug;
        $uniqueCoverFileName = 'cover_' . uniqid() . '.' . $this->cover_photo->getClientOriginalExtension();
        $uniqueHeaderFileName = 'header_' . uniqid() . '.' . $this->header_photo->getClientOriginalExtension();

        // Store on public (local storage)
        // $coverPhotoPath = $this->cover_photo->storeAs($photoshootFolder, $uniqueFileName, 'public');
        // Store on s3
        $coverPhotoUrl = $this->cover_photo->storeAs($photoshootFolder, $uniqueCoverFileName, 's3');

        // Store on public (local storage)
        // $headerPhotoPath = $this->header_photo->storeAs($photoshootFolder, $uniqueHeaderFileName, 'public');

        // Store on s3
        $headerPhotoUrl = $this->header_photo->storeAs($photoshootFolder, $uniqueHeaderFileName, 's3');

        $photoshoot->update([
            'cover_photo' => $coverPhotoUrl,
            'header_photo' => $headerPhotoUrl,
        ]);

        $this->uploadPhotos($photoshoot);

        $this->dispatch('photoshootCreatedToast', ['slug' => $this->slug]);

        $this->reset(['name', 'description', 'cover_photo', 'header_photo', 'date', 'status', 'category_id', 'price', 'location', 'duration', 'photos']);
    }

    public function uploadPhotos(PhotoShoot $photoshoot)
    {
        $photoshootId = $photoshoot->id;
        $photoshootFolder = 'photoshoots/' . $photoshoot->slug;
        $position = 1;

        foreach ($this->photos as $photo) {
            $temporaryPath = $photo['path'];
            $extension = $photo['extension'];
            $fileName = uniqid() . '.' . $extension;

            // Store on public (local storage)
            // $storedPath = Storage::disk('public')->putFileAs($photoshootFolder, new \Illuminate\Http\File($temporaryPath), $fileName);

            // Store on s3
            $storedPath = Storage::disk('s3')->putFileAs($photoshootFolder, new \Illuminate\Http\File($temporaryPath), $fileName);

            Photo::create([
                'photo_shoot_id' => $photoshootId,
                'filename' => $storedPath,
                'position' => $position,
            ]);

            $position++;
        }

        $this->reset('photos');
    }
}; ?>

<div class="">
    <form class="mt-6 space-y-6">
        <!-- Name -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="name" :value="__('Nombre')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input placeholder="Polaroids en estudio" wire:model="name" class="block w-full mt-1" type="text"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Description -->
        <div>
            <x-input-label class="" for="description" :value="__('Descripción')" />
            <textarea placeholder="Capturando momentos únicos en escenarios naturales con un toque artístico"
                wire:model="description"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                rows="4" autocomplete="description"></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <!-- Header Photo -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="header_photo" :value="__('Header')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input wire:model="header_photo" class="block w-full mt-1" type="file" accept="image/*" />

            @if ($header_photo)
                <img class="mt-4" src="{{ $header_photo->temporaryUrl() }}">
            @endif

            <x-input-error :messages="$errors->get('header_photo')" class="mt-2" />
        </div>


        <!-- Cover Photo -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="cover_photo" :value="__('Portada')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input wire:model="cover_photo" class="block w-full mt-1" type="file" accept="image/*" />

            @if ($cover_photo)
                <img class="mt-4" src="{{ $cover_photo->temporaryUrl() }}">
            @endif

            <x-input-error :messages="$errors->get('cover_photo')" class="mt-2" />
        </div>

        <!-- Photos -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="photos" :value="__('Fotos')" />
                <span class="text-yellow-600">*</span>
            </div>
            <livewire:dropzone wire:model="photos" :rules="['image', 'mimes:png,jpeg,webp,jpg', 'max:10240']"
                :multiple="true" />
            <x-input-error :messages="$errors->get('photos')" class="mt-2" />
        </div>

        <div class="items-center gap-4 space-y-6 sm:flex sm:space-y-0">
            <!-- Price -->
            <div class="w-full sm:w-1/2">
                <x-input-label for="price" :value="__('Precio (pesos)')" />
                <x-text-input wire:model="price" class="block w-full mt-1" type="number" step="0.01"
                    autocomplete="price" />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <!-- Duration -->
            <div class="w-full sm:w-1/2">
                <x-input-label for="duration" :value="__('Duración (minutos)')" />
                <x-text-input wire:model="duration" class="block w-full mt-1" type="number" step="0.5" />
                <x-input-error :messages="$errors->get('duration')" class="mt-2" />
            </div>
        </div>

        <!-- Date -->
        <div x-data="{ today: new Date().toISOString().split('T')[0] }">
            <div class="flex items-center gap-1">
                <x-input-label for="date" :value="__('Fecha')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input wire:model="date" class="block w-full mt-1" type="date" required
                x-bind:value="today" x-bind:max="today" id="date-input" />
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
        </div>

        <!-- Location -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="location" :value="__('Ubicación')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input placeholder="Ciudad Vieja, Uruguay" wire:model="location" class="block w-full mt-1"
                type="text" required autocomplete="location" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <div x-data="{ status: '' }">
            <!-- Status -->
            <div>
                <div class="flex items-center gap-1">
                    <x-input-label for="status" :value="__('Estado')" />
                    <span class="text-yellow-600">*</span>
                </div>

                <select x-model="status" wire:model="status" class="block w-full mt-1 border-2 border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                    <option value="published">{{ __('Publicado') }}</option>
                    <option value="draft">{{ __('Borrador') }}</option>
                    <option value="client_preview">{{ __('En revisión') }}</option>
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>

            <!-- Mensaje dinámico -->
            <template x-if="status === 'client_preview'">
                <p class="my-2 text-sm text-gray-500">Crea el photoshoot para poder asignarle un cliente.</p>
            </template>
        </div>

        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="category_id" :value="__('Categoría')" />
                <span class="text-yellow-600">*</span>
            </div>
            <select wire:model="category_id" class="block w-full mt-1 border-2 border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                <!-- Populate options dynamically -->
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <!-- Spinner -->
            <div wire:loading wire:target="createPhotoShoot" class="">
                <x-spinner :text="__('Creando photoshoot...')" />
            </div>

            <!-- Maintaining button to right-->
            <div></div>

            <div>
                <x-primary-button wire:click.prevent='createPhotoShoot'>
                    {{ __('Crear') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</div>

<!-- Photoshoot created toast -->
@script
    <script>
        $wire.on('photoshootCreatedToast', (event) => {

            const slug = event[0].slug;
            const link = `/photoshoot/${slug}`;

            toast('Creado', {
                html: `
                                <div class="p-4">
                                    <div class="flex items-center">
                                        <svg class="w-[18px] h-[18px] text-green-500 mr-1.5 -ml-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM16.7744 9.63269C17.1238 9.20501 17.0604 8.57503 16.6327 8.22559C16.2051 7.87615 15.5751 7.93957 15.2256 8.36725L10.6321 13.9892L8.65936 12.2524C8.24484 11.8874 7.61295 11.9276 7.248 12.3421C6.88304 12.7566 6.92322 13.3885 7.33774 13.7535L9.31046 15.4903C10.1612 16.2393 11.4637 16.1324 12.1808 15.2547L16.7744 9.63269Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <p class="text-[13px] font-medium leading-none text-gray-800">Creado</p>
                                    </div>
                                    
                                    <div class="pl-5">
                                        <p class="mt-1.5 text-xs leading-none opacity-70">Photoshoot creado correctamente.</p>
                                        <a href="${link}" class="text-xs text-blue-500 underline">Ver photoshoot</a>
                                    </div>
                                </div>
                                `
            });
        });
    </script>
@endscript
