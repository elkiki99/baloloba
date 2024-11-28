<x-mail::message>
    <x-mail::panel>
        # ¡Hola {{ $userName }}!
    </x-mail::panel>

    Gracias por contactarte con nosotros. He recibido tu mensaje y te responderé a la brevedad.

    Si tenes más consultas, no dudes en contactarme nuevamente.

    {{ now()->translatedFormat('j \d\e F \d\e Y \a \l\a\s g:i A') }}

    Gracias, {{ config('app.name') }}
</x-mail::message>
