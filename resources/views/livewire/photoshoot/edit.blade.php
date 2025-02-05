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

    public $photoshoot;

    #[Validate('required|string|max:48', as: 'nombre')]
    public $name;

    #[Validate('nullable|string|max:500', as: 'descripcion')]
    public $description;
    
    public $cover_photo;
    public $new_cover_photo;
    public $header_photo;
    public $new_header_photo;

    #[Validate('required|date', as: 'fecha')]
    public $date;

    #[Validate('required|string|in:published,draft,client_preview', as: 'estado')]
    public $status;
    
    #[Validate('required|exists:categories,id', as: 'categoría')]
    public $category_id;

    #[Validate('nullable|numeric|min:0', as: 'precio')]
    public $price;

    #[Validate('required|string|max:255', as: 'ubicación')]
    public $location;

    #[Validate('nullable|integer|min:1', as: 'duración')]
    public $duration;
    
    public $slug;

    #[Validate('nullable', as: 'fotos')]
    public $new_photos = [];
    
    public $existing_photos = [];
    public $existing_deleted_photos = [];
    public $categories = [];

    protected function rules()
    {
        $rules = [
            'existing_photos' => [
                function ($attribute, $value, $fail) {
                    $remainingExistingPhotos = count(
                        array_filter($this->existing_photos, function ($photo) {
                            return !in_array($photo['id'], $this->existing_deleted_photos);
                        }),
                    );

                    $totalPhotosAfterChanges = $remainingExistingPhotos + count($this->new_photos);

                    if ($totalPhotosAfterChanges < 1) {
                        $fail('Debe haber al menos una foto en el photoshoot.');
                    }
                },
            ],
        ];

        return $rules;
    }

    protected $listeners = [
        'existingFileRemoved' => 'removeExistingFile',
        'photosUpdated' => 'syncPhotos',
    ];

    public function mount($id)
    {
        $this->photoshoot = Photoshoot::findOrFail($id);
        $this->name = $this->photoshoot->name;
        $this->description = $this->photoshoot->description;
        $this->date = $this->photoshoot->date;
        $this->status = $this->photoshoot->status;
        $this->category_id = $this->photoshoot->category_id;
        $this->header_photo = $this->photoshoot->header_photo;
        $this->cover_photo = $this->photoshoot->cover_photo;
        $this->price = $this->photoshoot->price;
        $this->location = $this->photoshoot->location;
        $this->duration = $this->photoshoot->duration;
        $this->slug = $this->photoshoot->slug;

        $this->existing_photos = Photo::where('photo_shoot_id', $this->photoshoot->id)
            ->orderBy('position', 'asc')
            ->get()
            ->toArray();

        $this->categories = Category::all();
    }

    public function updatePhotoShoot()
    {
        if (!Gate::allows('modify-page')) {
            abort(403);
        }

        $this->validate();

        $photoshootFolder = 'photoshoots/' . $this->slug;

        if ($this->new_cover_photo) {
            if ($this->photoshoot->cover_photo) {
                Storage::disk('s3')->delete($this->photoshoot->cover_photo);
            }
            $uniqueCoverFileName = 'cover_' . uniqid() . '.' . $this->new_cover_photo->getClientOriginalExtension();
            $coverPhotoUrl = $this->new_cover_photo->storeAs($photoshootFolder, $uniqueCoverFileName, 's3');
        } else {
            $coverPhotoUrl = $this->photoshoot->cover_photo;
        }

        if ($this->new_header_photo) {
            if ($this->photoshoot->header_photo) {
                Storage::disk('s3')->delete($this->photoshoot->header_photo);
            }
            $uniqueHeaderFileName = 'header_' . uniqid() . '.' . $this->new_header_photo->getClientOriginalExtension();
            $headerPhotoUrl = $this->new_header_photo->storeAs($photoshootFolder, $uniqueHeaderFileName, 's3');
        } else {
            $headerPhotoUrl = $this->photoshoot->header_photo;
        }

        $this->checkForExistingDeletedPhotos();
        $this->checkForNewPhotos();

        $this->photoshoot->update([
            'name' => $this->name,
            'description' => $this->description,
            'header_photo' => $headerPhotoUrl,
            'cover_photo' => $coverPhotoUrl,
            'date' => $this->date,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'location' => $this->location,
            'duration' => $this->duration,
            'slug' => $this->slug,
        ]);

        // Photoshoot updated toast
        $this->dispatch('photoshootUpdatedToast');
    }

    public function updateExistingPhotos($photos)
    {
        $this->existing_photos = $photos;
    }

    public function updateExistingPhotosOrder($orderedPhotos)
    {
        $this->existing_photos = collect($orderedPhotos)->map(function ($photo, $index) {
            // Encuentra la imagen en el arreglo actual
            $updatedPhoto = collect($this->existing_photos)->firstWhere('id', $photo['value']);

            // Actualiza la posición en la base de datos
            \App\Models\Photo::where('id', $photo['value'])->update(['position' => $index + 1]);

            return $updatedPhoto;

            $this->dispatch('photosUpdated', $this->existing_photos);
        })->toArray();
    }

    public function checkForNewPhotos()
    {
        $photoshootId = $this->photoshoot->id;
        $photoshootFolder = 'photoshoots/' . $this->photoshoot->slug;
        $maxPosition = Photo::where('photo_shoot_id', $photoshootId)->max('position') ?? 0;

        foreach ($this->new_photos as $new_photo) {
            $temporaryPath = $new_photo['path'];
            $extension = $new_photo['extension'];
            $fileName = uniqid() . '.' . $extension;

            // Store on public (local storage)
            // $storedPath = Storage::disk('public')->putFileAs($photoshootFolder, new \Illuminate\Http\File($temporaryPath), $fileName);

            // Store on s3
            $storedPath = Storage::disk('s3')->putFileAs($photoshootFolder, new \Illuminate\Http\File($temporaryPath), $fileName);

            Photo::create([
                'photo_shoot_id' => $photoshootId,
                'filename' => $storedPath,
                'position' => ++$maxPosition,
            ]);
        }

        $this->updatePhotosOnEditForm();
        $this->new_photos = [];
    }

    public function updatePhotosOnEditForm()
    {
        $this->existing_photos = Photo::where('photo_shoot_id', $this->photoshoot->id)
            ->orderBy('position', 'asc')
            ->get()
            ->toArray();

        $this->dispatch('updateExistingPhotos', $this->existing_photos);
    }

    #[On('existingFileRemoved')]
    public function removeExistingFile($photoId)
    {
        $this->existing_photos = array_filter($this->existing_photos, function ($photo) use ($photoId) {
            return $photo['id'] !== $photoId;
        });
        $this->existing_deleted_photos[] = $photoId;
    }

    public function checkForExistingDeletedPhotos()
    {
        if ($this->existing_deleted_photos !== null) {
            foreach ($this->existing_deleted_photos as $photoId) {
                $photo = Photo::find($photoId);
                if ($photo) {
                    Storage::disk('s3')->delete($photo->filename);
                    $photo->delete();
                }
            }
        }
        $this->existing_deleted_photos = [];
    }

    public function syncPhotos($updatedPhotos)
    {
        $this->existing_photos = $updatedPhotos;
    }
}; ?>

<div>
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
                <x-input-label for="new_header_photo" :value="__('Header')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input wire:model="new_header_photo" class="block w-full mt-1" type="file" accept="image/*" />

            @if (!$new_header_photo)
                <img src="{{ Storage::disk('s3')->url($header_photo) }}" alt="Header Photo" class="mt-4">
            @elseif ($new_header_photo)
                <img src="{{ $new_header_photo->temporaryUrl() }}" alt="New Header Photo" class="mt-4">
            @endif

            <x-input-error :messages="$errors->get('new_header_photo')" class="mt-2" />
        </div>

        <!-- Cover Photo -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="new_cover_photo" :value="__('Portada')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input wire:model="new_cover_photo" class="block w-full mt-1" type="file" accept="image/*" />

            @if (!$new_cover_photo)
                <img src="{{ Storage::disk('s3')->url($cover_photo) }}" alt="Cover Photo" class="mt-4">
            @elseif ($new_cover_photo)
                <img src="{{ $new_cover_photo->temporaryUrl() }}" alt="New Cover Photo" class="mt-4">
            @endif

            <x-input-error :messages="$errors->get('new_cover_photo')" class="mt-2" />
        </div>

        <!-- Photos -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="new_photos" :value="__('Fotos')" />
                <span class="text-yellow-600">*</span>
            </div>

            <livewire:dropzone :$existing_photos wire:model="new_photos" :rules="['image', 'mimes:png,jpeg,webp,jpg', 'max:10240']" :multiple="true" />

            @if (isset($existing_photos) && count($existing_photos) > 0)
                <div wire:sortable="updateExistingPhotosOrder"
                    class="dz-flex dz-flex-wrap dz-gap-x-10 dz-gap-y-2 dz-justify-start dz-w-full dz-mt-5">
                    @foreach ($existing_photos as $photo)
                        <div wire:sortable.item="{{ $photo['id'] }}"
                            class="dz-flex dz-items-center dz-justify-between dz-gap-2 dz-border dz-rounded dz-border-gray-200 dz-w-full dz-h-auto dz-overflow-hidden hover:scale-[102%] hover:shadow-md hover:transition-transform hover:duration-200 max-w-[38rem]"
                            wire:key='{{ $photo['id'] }}'>

                            <div wire:sortable.handle
                                class="flex-1 dz-flex dz-items-center dz-gap-3 dz-w-full dz-h-full dz-p-2 hover:cursor-grab">
                                <div class="dz-flex-none dz-w-14 dz-h-14">
                                    <img src="{{ Storage::disk('s3')->url($photo['filename']) }}"
                                        class="dz-object-fill dz-w-full dz-h-full" alt="{{ $photo['filename'] }}">
                                </div>
                                <div class="dz-flex dz-flex-col dz-items-start dz-gap-1">
                                    <div class="dz-text-center dz-text-slate-900 dz-text-sm dz-font-medium">
                                        {{ basename($photo['filename']) }}
                                    </div>
                                </div>
                            </div>

                            <div class="dz-flex dz-items-center dz-mr-3">
                                <button type="button" wire:click="removeExistingFile({{ $photo['id'] }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="dz-w-6 dz-h-6 dz-text-black">
                                        <path fill-rule="evenodd"
                                            d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <x-input-error :messages="$errors->get('new_photos')" class="mt-2" />
            <x-input-error :messages="$errors->get('existing_photos')" class="mt-2" />
        </div>

        <div class="items-center gap-4 space-y-6 sm:space-y-0 sm:flex">
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
                x-bind:max="today" id="date-input" />
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

        <!-- Status -->
        <div x-data="{ status: @entangle('status') }">
            <div class="flex items-center gap-1">
                <x-input-label for="status" :value="__('Estado')" />
                <span class="text-yellow-600">*</span>
            </div>

            <select x-model="status"
                class="block w-full mt-1 border-2 border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                <option value="published">{{ __('Publicado') }}</option>
                <option value="draft">{{ __('Borrador') }}</option>
                <option value="client_preview">{{ __('En revisión') }}</option>
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />

            <!-- Client search for client preview -->
            <div x-show="status === 'client_preview'" x-cloak>
                <livewire:components.search-client :id="$photoshoot->id" />
            </div>
        </div>

        <!-- Category -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="category_id" :value="__('Categoría')" />
                <span class="text-yellow-600">*</span>
            </div>
            <select wire:model="category_id"
                class="block w-full mt-1 border-2 border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                <!-- Populate options dynamically -->
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <x-danger-button x-on:click.prevent="$dispatch('open-modal', 'confirm-photoshoot-deletion')">
                {{ __('Eliminar') }}
            </x-danger-button>

            <x-primary-button wire:click.prevent='updatePhotoShoot'>
                {{ __('Actualizar') }}
            </x-primary-button>
        </div>

        <div wire:loading wire:target="updatePhotoShoot" class="">
            <x-spinner :text="__('Actualizando photoshoot...')" />
        </div>
    </form>

    <x-modal name="confirm-photoshoot-deletion">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900">
                {{ __('¿Segura que queres eliminar este photoshoot?') }}
            </h3>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Una vez eliminado, este photoshoot no podrá ser recuperado.') }}
            </p>

            <div class="flex justify-end mt-6">
                <x-secondary-button class="px-4 py-2" x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <livewire:photoshoot.delete :photoshootId="$photoshoot->id" />
            </div>
        </div>
    </x-modal>
</div>

<!-- Photoshoot updated toast -->
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('photoshootUpdatedToast', () => {
            toast('Actualizado', {
                type: 'success',
                position: 'bottom-right',
                description: 'Photoshoot actualizado correctamente.'
            });
        });
    });
</script>
