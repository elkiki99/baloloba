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
    public $existing_cover_photo;
    public $header_photo;
    public $existing_header_photo;
    public $date;
    public $status;
    public $category_id;
    public $price;
    public $location;
    public $duration;
    public $slug;

    public $photos = [];
    public $existingPhotos = [];
    public $categories = [];

    protected $rules = [
        'name' => 'required|string|max:48|',
        'description' => 'nullable|string|max:500',
        'cover_photo' => 'required|image|max:10240',
        'header_photo' => 'required|image|max:10240',
        'date' => 'required|date',
        'status' => 'required|in:published,draft',
        'category_id' => 'required|exists:categories,id',
        'location' => 'required|string|max:255',
        'price' => 'nullable|numeric|min:0',
        'duration' => 'nullable|integer|min:1',

        'photos.*' => 'required',
        'photos' => 'required',
    ];

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

        'photos.required' => 'Las fotos son obligatorias.',
        'photos.*.required' => 'Las fotos son obligatorias.',
        'photos.*.image' => 'Cada foto debe ser una imagen válida.',
        'photos.*.mimes' => 'Cada foto debe tener una extensión válida (png, jpeg, jpg, webp).',
        'photos.*.max' => 'Cada foto no debe superar los 10 MB.',
    ];

    public function mount($id)
    {
        $photoshoot = PhotoShoot::findOrFail($id);

        $this->id = $photoshoot->id;
        $this->name = $photoshoot->name;
        $this->description = $photoshoot->description;
        $this->date = $photoshoot->date;
        $this->status = $photoshoot->status;
        $this->category_id = $photoshoot->category_id;
        $this->existing_header_photo = $photoshoot->header_photo;
        $this->existing_cover_photo = $photoshoot->cover_photo;
        $this->price = $photoshoot->price;
        $this->location = $photoshoot->location;
        $this->duration = $photoshoot->duration;
        $this->slug = $photoshoot->slug;
        $this->existingPhotos = $photoshoot->photos;

        $this->existingPhotos = $photoshoot->photos
            ->pluck('filename')
            ->map(function ($filename) {
                return Storage::disk('s3')->url($filename);
            })
            ->toArray();

        $this->categories = Category::all();
    }

    // public function editPhotoShoot(Photoshoot $photoshoot)
    // {
    //     // Mapear las fotos a un formato compatible con el componente Dropzone
    //     $initialFiles = $photoshoot->photos
    //         ->map(function ($photo) {
    //             return [
    //                 'name' => $photo->filename,
    //                 'extension' => $photo->extension,
    //                 'path' => $photo->path,
    //                 'url' => asset('storage/' . $photo->path), // URL completa al archivo
    //                 'size' => $photo->size,
    //             ];
    //         })
    //         ->toArray();

    //     return view('photoshoot.edit', compact('photoshoot', 'initialFiles'));
    // }
}; ?>

<form wire:submit.prevent="editPhotoShoot" class="mt-6 space-y-6">
    <!-- Name -->
    <div>
        <div class="flex items-center gap-1">
            <x-input-label for="name" :value="__('Nombre')" />
            <span class="text-yellow-600">*</span>
        </div>
        <x-text-input placeholder="Polaroids en estudio" wire:model="name" class="block w-full mt-1" type="text" required
            autofocus autocomplete="name" />
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
            <x-input-label for="header_photo" :value="__('Header')" />
            <span class="text-yellow-600">*</span>
        </div>
        <x-text-input wire:model="header_photo" class="block w-full mt-1" type="file" accept="image/*" />

        @if ($existing_header_photo && !$header_photo)
            <img src="{{ Storage::disk('s3')->url($existing_header_photo) }}" alt="Header Photo" class="mt-4">
        @endif

        @if ($header_photo)
            <img src="{{ $header_photo->temporaryUrl() }}" alt="New Header Photo" class="mt-4">
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

        @if ($existing_cover_photo && !$cover_photo)
            <img src="{{ Storage::disk('s3')->url($existing_cover_photo) }}" alt="Cover Photo" class="mt-4">
        @endif

        @if ($cover_photo)
            <img src="{{ $cover_photo->temporaryUrl() }}" alt="New Cover Photo" class="mt-4">
        @endif

        <x-input-error :messages="$errors->get('cover_photo')" class="mt-2" />
    </div>

    <!-- Photos -->
    <div>
        <div class="flex items-center gap-1">
            <x-input-label for="photos" :value="__('Fotos')" />
            <span class="text-yellow-600">*</span>
        </div>

        <livewire:dropzone :existing-photos="$existingPhotos" wire:model="photos" :rules="['image', 'mimes:png,jpeg,webp,jpg', 'max:10240']" :multiple="true" />
        <x-input-error :messages="$errors->get('photos')" class="mt-2" />
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
        <x-text-input wire:model="date" class="block w-full mt-1" type="date" required x-bind:value="today"
            x-bind:max="today" id="date-input" />
        <x-input-error :messages="$errors->get('date')" class="mt-2" />
    </div>

    <!-- Location -->
    <div>
        <div class="flex items-center gap-1">
            <x-input-label for="location" :value="__('Ubicación')" />
            <span class="text-yellow-600">*</span>
        </div>
        <x-text-input placeholder="Ciudad Vieja, Uruguay" wire:model="location" class="block w-full mt-1" type="text"
            required autocomplete="location" />
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

    <div class="flex justify-end mt-4">
        <x-primary-button>
            {{ __('Actualizar') }}
        </x-primary-button>
    </div>

    @if (session('status') === 'photoshoot-updated')
        <p class="mt-5 text-sm font-medium text-green-600 dark:text-green-400">
            {{ __('¡Photoshoot actualizado exitosamente!') }}
        </p>
    @endif
</form>
