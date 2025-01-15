<x-app-layout>
    <div class="flex flex-col pt-12 space-y-32 sm:pt-0">
        <!-- Header -->
        @php
            $header = \App\Models\Header::where('id', 2)->first() ?? null;
        @endphp

        @if ($header)
            <livewire:headers.show :header="$header" />
        @endif

        <!-- Photoshoots -->
        <livewire:photoshoot.portfolio />
    </div>
</x-app-layout>
