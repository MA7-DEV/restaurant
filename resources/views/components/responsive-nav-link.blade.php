@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-4 pe-4 py-3 border-l-4 border-[#D4A574] text-start text-base font-medium text-[#2C1810] bg-[#FAF7F2] focus:outline-none focus:text-[#BC8A53] focus:bg-[#F5EFE6] focus:border-[#BC8A53] transition-all duration-300 ease-in-out rounded-r-xl'
            : 'block w-full ps-4 pe-4 py-3 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-[#D4A574] hover:bg-[#FAF7F2] hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-[#F5EFE6] focus:border-gray-300 transition-all duration-300 ease-in-out rounded-r-xl';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>