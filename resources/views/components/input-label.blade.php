@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm ' . ($attributes->get('class') ? '' : 'text-gray-700')]) }}>
    {{ $value ?? $slot }}
</label>