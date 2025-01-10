<div class="space-y-6 ">
    <!-- Name -->
    <div>
        <div class="flex items-center gap-1">
            <x-input-label for="name" :value="__('Nombre')" />
            <span class="text-yellow-600">*</span>
        </div>
        <x-text-input placeholder="Nombre de la categoría" wire:model="name" class="block w-full mt-1" type="text" required
            autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Slug -->
    <div>
        <div class="flex items-center gap-1">
            <x-input-label for="slug" :value="__('Slug')" />
            <span class="text-yellow-600">*</span>
        </div>
        <x-text-input placeholder="Slug de la categoría" wire:model="slug" class="block w-full mt-1" type="text"
            required autofocus autocomplete="slug" />
        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
    </div>

    <!-- Description -->
    <div>
        <x-input-label class="" for="description" :value="__('Descripción')" />
        <textarea placeholder="Fotografías instantáneas clásicas" wire:model="description"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
            rows="2" autocomplete="description"></textarea>
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>
</div>
