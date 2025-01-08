<x-mail::message>
    <x-mail::panel>
        # 🎉 Has aprobado el photoshoot {{ $photoshoot->name }} 
    </x-mail::panel>

    Le notificaremos al administrador.

    {{-- {{ now()->translatedFormat('j \d\e F \d\e Y \a \l\a\s g:i A') }} --}}

    Gracias, {{ config('app.name') }}
</x-mail::message>
