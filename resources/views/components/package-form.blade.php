<div class="space-y-6 ">
    <!-- Name -->
    <div>
        <div class="flex items-center gap-1">
            <x-input-label for="name" :value="__('Nombre')" />
            <span class="text-yellow-600">*</span>
        </div>
        <x-text-input placeholder="Nombre del paquete" wire:model="name" class="block w-full mt-1" type="text" required
            autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Description -->
    <div>
        <x-input-label class="" for="description" :value="__('Descripción')" />
        <textarea placeholder="Este paquete es ideal para..." wire:model="description"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-500 focus:ring-yellow-500 dark:focus:ring-yellow-500"
            rows="2" autocomplete="description"></textarea>
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>

    <div class="flex items-center gap-4">
        <!-- Basic price -->
        <div class="w-1/2">
            <div class="flex items-center gap-1">
                <x-input-label for="basic_price" :value="__('Precio básico (pesos)')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input wire:model="basic_price" class="block w-full mt-1" type="number" step="0.01"
                autocomplete="basic_price" />
            <x-input-error :messages="$errors->get('basic_price')" class="mt-2" />
        </div>

        <!-- Extended price -->
        <div class="w-1/2">
            <div class="flex items-center gap-1">
                <x-input-label for="extended_price" :value="__('Precio extendido (pesos)')" />
                <span class="text-yellow-600">*</span>
            </div>
            <x-text-input wire:model="extended_price" class="block w-full mt-1" type="number" step="0.01"
                autocomplete="extended_price" />
            <x-input-error :messages="$errors->get('extended_price')" class="mt-2" />
        </div>
    </div>

    <!-- Basic features -->
    <div>
        <div class="flex items-center gap-1">
            <x-input-label for="basic_features" :value="__('Características básicas (separadas por coma)')" />
            <span class="text-yellow-600">*</span>
        </div>
        <textarea placeholder="15 fotografías digitales" wire:model="basic_features"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-500 focus:ring-yellow-500 dark:focus:ring-yellow-500"
            rows="3" autocomplete="basic_features"></textarea>
        <x-input-error :messages="$errors->get('basic_features')" class="mt-2" />
    </div>

    <!-- Extended features -->
    <div>
        <div class="flex items-center gap-1">
            <x-input-label for="extended_features" :value="__('Características extendidas (separadas por coma)')" />
            <span class="text-yellow-600">*</span>
        </div>
        <textarea placeholder="30 fotografías digitales" wire:model="extended_features"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-500 focus:ring-yellow-500 dark:focus:ring-yellow-500"
            rows="3" autocomplete="extended_features"></textarea>
        <x-input-error :messages="$errors->get('extended_features')" class="mt-2" />
    </div>
</div>
