@props(['active'])

@php
    $classes = 
        'inline-flex text-gray-800 px-3 py-1 items-center text-sm hover:blur-xs font-medium leading-5 focus:outline-none transition duration-150 ease-in-out ' .
        ($active
            ? 'text-white bg-gray-900 rounded-2xl px-4 py-1' 
            : '');
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>