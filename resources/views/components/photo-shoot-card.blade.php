<a href="{{ route('photoshoot.show', $photoshoot->slug) }}" class="relative block w-full h-full group">
    <div class="w-full h-full overflow-hidden">
        <img class="object-cover w-full h-full" src="{{ 
                // Str::startsWith($photoshoot->cover_photo, ['http://', 'https://']) ? $photoshoot->cover_photo : 
                Storage::disk('s3')->url($photoshoot->cover_photo) }}"
            alt="{{ $photoshoot->name }}"
            >
    </div>

    <!-- Hover card information -->
    <div
        class="absolute inset-0 space-y-2 transition duration-300 bg-black opacity-0 hover:backdrop-blur-sm bg-opacity-30 group-hover:opacity-100">
        <div class="absolute bottom-0 left-0 right-0 p-4">
            <h3 class="text-3xl font-bold text-white">{{ $photoshoot->name }}</h3>
            <p class="text-xl text-gray-100">{{ $photoshoot->location }}</p>
            <span class="block text-gray-200 text-md">{{ $photoshoot->photos->count() }}
                {{ $photoshoot->photos->count() == 1 ? 'fotografia,' : 'fotografías,' }}
                {{ $photoshoot->category->name }}</span>
            <span
                class="block text-sm text-gray-300">{{ \Carbon\Carbon::parse($photoshoot->date)->toFormattedDateString() }}</span>
        </div>
    </div>
</a>
