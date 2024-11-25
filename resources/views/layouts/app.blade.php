<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="icon" href="{{ asset('dark_favicon.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Asul:wght@400;700&family=Gabarito:wght@400..900&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: "Gabarito", serif;
            font-optical-sizing: auto;
            font-weight: normal;
            font-style: normal;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased ">
    <div class="z-40 min-h-screen">
        <div class="relative flex items-center justify-center">
            <livewire:layout.navigation />
        </div>

        <main class="relative z-40 flex-grow bg-white">
            {{ $slot }}
        </main>

        <div class="sticky bottom-0 z-10">
            <x-footer />
        </div>
    </div>
</body>

</html>
