<x-app-layout>
    <section class="pt-12 pb-[20vh] sm:px-6 md:px-8 px-0">
        <div class="space-y-6 md:mx-auto sm:mt-10 max-w-7xl">
            <h1 class="px-4 pt-10 text-5xl font-bold underline md:text-7xl decoration-yellow-500">Crear photoshoot</h1>

            <div
                class="max-w-2xl p-8 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))]
                    from-gray-200
                    via-gray-100
                    to-gray-50 sm:rounded-md shadow-xl">
                <header>
                    <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">
                        {{ __('Nuevo photoshoot') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Crea una nueva sesión fotográfica.') }}
                    </p>
                </header>

                <form wire:submit="sendMessage" class="mt-6 space-y-6">
                    <!-- Name -->
                    <div>
                        <div class="flex items-center gap-1">
                            <x-input-label for="name" :value="__('Nombre')" />
                            <span class="text-yellow-600">*</span>
                        </div>
                        <x-text-input wire:model="name" id="name" class="block w-full mt-1" type="text"
                            name="name" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div>
                        <x-input-label for="description" :value="__('Descripción')" />
                        <x-text-input wire:model="description" id="description" class="block w-full mt-1" type="text"
                            type="text" name="description" required autocomplete="description" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Cover Photo -->
                    <div>
                        <div class="flex items-center gap-1">
                            <x-input-label for="cover_photo" :value="__('Portada')" />
                            <span class="text-yellow-600">*</span>
                        </div>
                        <x-text-input wire:model="cover_photo" id="cover_photo" class="block w-full mt-1" type="file"
                            name="cover_photo" accept="image/*" />
                        <x-input-error :messages="$errors->get('cover_photo')" class="mt-2" />
                    </div>

                    <!-- Date -->
                    <div>
                        <div class="flex items-center gap-1">
                            <x-input-label for="date" :value="__('Fecha')" />
                            <span class="text-yellow-600">*</span>
                        </div>
                        <x-text-input wire:model="date" id="date" class="block w-full mt-1" type="date"
                            name="date" required />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div>
                        <div class="flex items-center gap-1">
                            <x-input-label for="status" :value="__('Estado')" />
                            <span class="text-yellow-600">*</span>
                        </div>

                        <select wire:model="status" id="status" name="status" class="block w-full mt-1">
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
                        <select wire:model="category_id" id="category_id" name="category_id" class="block w-full mt-1">
                            <!-- Populate options dynamically -->
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <!-- Price -->
                    <div>
                        <x-input-label for="price" :value="__('Precio')" />
                        <x-text-input wire:model="price" id="price" class="block w-full mt-1" type="number"
                            name="price" step="0.01" required autocomplete="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <!-- Location -->
                    <div>
                        <div class="flex items-center gap-1">
                            <x-input-label for="location" :value="__('Ubicación')" />
                            <span class="text-yellow-600">*</span>
                        </div>
                        <x-text-input wire:model="location" id="location" class="block w-full mt-1" type="text"
                            name="location" required autocomplete="location" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <!-- Duration -->
                    <div>
                        <x-input-label for="duration" :value="__('Duración')" />
                        <x-text-input wire:model="duration" id="duration" class="block w-full mt-1" type="number"
                            name="duration" required step="0.5" />
                        <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>
                            {{ __('Crear') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
