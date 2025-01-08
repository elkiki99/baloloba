<x-mail::message>
    <x-mail::panel>
        # 🎉 Photoshoot {{ $photoshoot->name }} aprobado
    </x-mail::panel>

    -Nombre: {{ $user->name }}
    -Email: {{ $user->email }}

    Ver photoshoot - {{ $url }}

    {{-- {{ now()->translatedFormat('j \d\e F \d\e Y \a \l\a\s g:i A') }} --}}
</x-mail::message>
