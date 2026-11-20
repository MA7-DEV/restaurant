<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-restaurant']) }}>
    {{ $slot }}
</button>