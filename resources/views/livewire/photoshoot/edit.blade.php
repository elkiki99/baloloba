<?php

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File as HttpFile;
use Livewire\Volt\Component;
use Illuminate\Support\Str;
use App\Models\PhotoShoot;
use App\Models\Category;
use App\Models\Photo;

new class extends Component {
    use WithFileUploads;

    public $photoshoot;
    public $name;
    public $description;
    public $cover_photo;
    public $new_cover_photo;
    public $header_photo;
    public $new_header_photo;
    public $date;
    public $status;
    public $category_id;
    public $price;
    public $location;
    public $duration;
    public $slug;

    public $new_photos = [];
    public $existing_photos = [];
    public $existing_deleted_photos = [];
    public $categories = [];

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:48',
            'description' => 'nullable|string|max:500',
            'date' => 'required|date',
            'status' => 'required|string|in:published,draft',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'duration' => 'nullable|integer|min:1',
            'new_photos.*' => 'nullable',
            'new_photos' => 'nullable',
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

    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'name.string' => 'El nombre debe ser una cadena de texto.',
        'name.max' => 'El nombre no puede superar los 48 caracteres.',
        'description.string' => 'La descripción debe ser una cadena de texto.',
        'description.max' => 'La descripción no puede superar los 500 caracteres.',
        'cover_photo.required' => 'La foto de portada es obligatoria.',
        'cover_photo.image' => 'La foto de portada debe ser una imagen válida.',
        'cover_photo.max' => 'La foto de portada no debe superar los 10 MB.',
        'header_photo.required' => 'La foto del encabezado es obligatoria.',
        'header_photo.image' => 'La foto del encabezado debe ser una imagen válida.',
        'header_photo.max' => 'La foto del encabezado no debe superar los 10 MB.',
        'date.required' => 'La fecha es obligatoria.',
        'date.date' => 'La fecha debe ser válida.',
        'status.required' => 'El estado es obligatorio.',
        'status.in' => 'El estado debe ser "Publicado" o "Borrador".',
        'category_id.required' => 'La categoría es obligatoria.',
        'category_id.exists' => 'La categoría seleccionada no es válida.',
        'price.required' => 'El precio es obligatorio.',
        'price.numeric' => 'El precio debe ser un número.',
        'price.min' => 'El precio debe ser mayor o igual a 0.',
        'location.string' => 'La ubicación debe ser una cadena de texto.',
        'location.max' => 'La ubicación no puede superar los 255 caracteres.',
        'duration.integer' => 'La duración debe ser un número entero.',
        'duration.min' => 'La duración debe ser al menos de 1 minuto.',

        'new_photos.*.image' => 'Cada foto debe ser una imagen válida.',
        'new_photos.*.mimes' => 'Cada foto debe tener una extensión válida (png, jpeg, jpg, webp).',
        'new_photos.*.max' => 'Cada foto no debe superar los 10 MB.',
    ];

    protected $listeners = [
        'existingFileRemoved' => 'removeExistingFile',
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
            ->get()
            ->toArray();

        $this->categories = Category::all();
    }

    public function updatePhotoShoot()
    {
        $this->validate();

        $photoshootFolder = 'photoshoots/' . $this->slug;

        if ($this->new_cover_photo) {
            if ($this->photoshoot->cover_photo) {
                Storage::disk('s3')->delete($this->photoshoot->cover_photo);
            }
            $uniqueCoverFileName = uniqid() . '.' . $this->new_cover_photo->getClientOriginalExtension();
            $coverPhotoUrl = $this->new_cover_photo->storeAs($photoshootFolder, $uniqueCoverFileName, 's3');
        } else {
            $coverPhotoUrl = $this->photoshoot->cover_photo;
        }

        if ($this->new_header_photo) {
            if ($this->photoshoot->header_photo) {
                Storage::disk('s3')->delete($this->photoshoot->header_photo);
            }
            $uniqueHeaderFileName = uniqid() . '.' . $this->new_header_photo->getClientOriginalExtension();
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

    public function checkForNewPhotos()
    {
        $photoshootId = $this->photoshoot->id;
        $photoshootFolder = 'photoshoots/' . $this->photoshoot->slug;

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
            ]);
        }

        $this->updatePhotosOnEditForm();
        $this->new_photos = [];
    }

    public function updatePhotosOnEditForm()
    {
        $this->existing_photos = Photo::where('photo_shoot_id', $this->photoshoot->id)
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
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-500 focus:ring-yellow-500 dark:focus:ring-yellow-500"
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

            <livewire:dropzone :existing_photos="$existing_photos" wire:model="new_photos" :rules="['image', 'mimes:png,jpeg,webp,jpg', 'max:10240']" :multiple="true" />

            {{-- <div class="flex flex-wrap justify-start w-full mt-5 gap-x-10 gap-y-2">
                @foreach ($existing_photos as $photo)
                    <div class="flex items-center justify-between w-full h-auto gap-2 overflow-hidden border border-gray-200 rounded dark:border-gray-700"
                        wire:key='{{ $photo['id'] }}'>
                        <div class="flex items-center gap-3" wire:remove>
                            <div class="flex-none w-14 h-14">
                                <img src="{{ Storage::disk('s3')->url($photo['filename']) }}"
                                    class="object-fill w-full h-full" alt="{{ $photo['filename'] }}">
                            </div>
                            <div class="flex flex-col items-start gap-1">
                                <div class="text-sm font-medium text-center text-slate-900 dark:text-slate-100">
                                    {{ basename($photo['filename']) }}
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mr-3">
                            <button type="button" wire:click="removeExistingFile({{ $photo['id'] }})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6 text-black dark:text-white">
                                    <path fill-rule="evenodd"
                                        d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div> --}}

            <!-- Check for Existing Photos in the Photoshoot -->
            <x-input-error :messages="$errors->get('new_photos')" class="mt-2" />
            <x-input-error :messages="$errors->get('existing_photos')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <!-- Price -->
            <div class="w-1/2">
                <x-input-label for="price" :value="__('Precio (pesos)')" />
                <x-text-input wire:model="price" class="block w-full mt-1" type="number" step="0.01"
                    autocomplete="price" />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <!-- Duration -->
            <div class="w-1/2">
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
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="status" :value="__('Estado')" />
                <span class="text-yellow-600">*</span>
            </div>

            <select wire:model="status" class="block w-full mt-1">
                <option value="published">{{ __('Publicado') }}</option>
                <option value="draft">{{ __('Borrador') }}</option>
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <!-- Category -->
        <div>
            <div class="flex items-center gap-1">
                <x-input-label for="category_id" :value="__('Categoría')" />
                <span class="text-yellow-600">*</span>
            </div>
            <select wire:model="category_id" class="block w-full mt-1">
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
                {{ __('No se puede revertir') }}
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
@script
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
@endscript
