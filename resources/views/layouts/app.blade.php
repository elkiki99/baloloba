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

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white">
        <div class="relative flex items-center justify-center">
            <livewire:layout.navigation />
        </div>
{{-- 
        <!-- Page Heading -->
        @if (isset($header))
            <header class="shadow dark:bg-gray-800">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif --}}

        <!-- Page Content -->
        {{-- <div class="relative z-40 bg-white "> --}}

            <main class="flex-grow">
                {{ $slot }}
            </main>
            
        {{-- </div> --}}
        
        <div class="z-10">
            <x-footer />
        </div>
    </div>
</body>

</html>
