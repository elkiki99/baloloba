@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'text-gray-900 text-start text-base hover:blur-xs block w-full ps-3 pe-4 py-2 hover:text-gray-800'
            : 'block w-full ps-3 pe-4 py-2 border-transparent text-start text-base font-medium text-gray-900 hover:blur-xs hover:border-gray-300 focus:text-gray-800 hover:text-gray-800 focus:outline-none focus:text-gray-800 focus:bg-transparent focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>