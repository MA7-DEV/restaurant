@props(['href' => '#'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'block w-full px-4 py-3 text-start text-sm leading-5 text-gray-700 hover:text-[#D4A574] hover:bg-[#FAF7F2] focus:outline-none focus:bg-[#F5EFE6] transition-all duration-300 ease-in-out']) }}>
    {{ $slot }}
</a>