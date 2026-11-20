@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#2C1810] mb-2']) }}>
    {{ $value ?? $slot }}
</label>