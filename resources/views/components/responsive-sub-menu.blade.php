@props(['active', 'href', 'icon'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center text-white bg-red-500 rounded-lg p-2 tracking-wide'
            : 'flex items-center text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 tracking-wide transition-all';
@endphp

<a {{ $attributes->merge(['href' => $href, 'class' => $classes]) }}>
    <i class="{{ $icon ?? 'fas fa-link' }} mr-3"></i> <!-- Default icon -->
    {{ $slot }}
</a>
