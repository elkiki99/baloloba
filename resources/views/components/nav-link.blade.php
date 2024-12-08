@props(['active'])

@php
    $classes = 
        'inline-flex text-gray-800 px-3 py-1 items-center text-xs sm:text-sm hover:blur-xs font-medium leading-5 focus:outline-none transition duration-150 ease-in-out ' .
        ($active
            ? 'sm:text-white text-orange-600 sm:bg-gray-900 sm:rounded-2xl sm:px-4 sm:py-1' 
            : '');
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>