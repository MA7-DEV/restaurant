@props(['disabled' => false])

<input {{ $attributes->merge(['class' => 'input-restaurant']) }} @disabled($disabled)>