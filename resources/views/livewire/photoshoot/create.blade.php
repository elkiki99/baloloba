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

    public $name;
    public $description;
    public $cover_photo;
    public $header_photo;
    public $date;
    public $status = 'published';
    public $category_id = 1;
    public $price;
    public $location;
    public $duration;
    public $slug;

    public $photos = [];
    public $categories = [];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:48|',
            'description' => 'nullable|string|max:500',
            'cover_photo' => 'required|image|max:10240',
            'header_photo' => 'required|image|max:10240',
            'date' => 'required|date',
            'status' => 'required|string|in:published,draft',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'duration' => 'nullable|integer|min:1',
            'photos.*' => 'required',
            'photos' => 'required',
        ];
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

        'photos.required' => 'Las fotos son obligatorias.',
        'photos.*.required' => 'Las fotos son obligatorias.',
        'photos.*.image' => 'Cada foto debe ser una imagen válida.',
        'photos.*.mimes' => 'Cada foto debe tener una extensión válida (png, jpeg, jpg, webp).',
        'photos.*.max' => 'Cada foto no debe superar los 10 MB.',
    ];

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
        $uniqueCoverFileName = uniqid() . '.' . $this->cover_photo->getClientOriginalExtension();
        $uniqueHeaderFileName = uniqid() . '.' . $this->header_photo->getClientOriginalExtension();

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

        $this->reset(['name', 'description', 'cover_photo', 'header_photo', 'date', 'status', 'category_id', 'price', 'location', 'duration', 'photos']);

        Session::flash('status', 'photoshoot-created');
    }

    public function uploadPhotos(PhotoShoot $photoshoot)
    {
        $photoshootId = $photoshoot->id;
        $photoshootFolder = 'photoshoots/' . $photoshoot->slug;

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
            ]);
        }

        $this->reset('photos');
    }
}; ?>

<form wire:submit.prevent="createPhotoShoot" class="mt-6 space-y-6">
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
        <livewire:dropzone :key="'create-photoshoot'" wire:model="photos" :rules="['image', 'mimes:png,jpeg,webp,jpg', 'max:10240']" :multiple="true" />
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
            {{ __('Crear') }}
        </x-primary-button>
    </div>

    @if (session('status') === 'photoshoot-created')
        <p class="mt-5 text-sm font-medium text-green-600 dark:text-green-400">
            {{ __('¡Photoshoot creado exitosamente!') }}
        </p>
    @endif
</form>
