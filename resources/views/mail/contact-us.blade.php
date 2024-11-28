<x-mail::message>
    <x-mail::panel>
        # 🎉 Nuevo mensaje de contacto
    </x-mail::panel>

    -Nombre: {{ $name }}
    -Email: {{ $email }}
    -Teléfono: {{ $phone }}

    Mensaje:
    {{ $message }}

    {{ now()->translatedFormat('j \d\e F \d\e Y \a \l\a\s g:i A') }}
</x-mail::message>
