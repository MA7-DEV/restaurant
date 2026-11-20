@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 border-b-2 border-[#D4A574] text-sm font-medium leading-5 text-[#2C1810] focus:outline-none focus:border-[#BC8A53] transition-all duration-300 ease-in-out'
            : 'inline-flex items-center px-3 py-2 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-[#D4A574] hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition-all duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>