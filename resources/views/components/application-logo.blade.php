{{-- Logo تصميم مخصص لمطعم GustoBite --}}
<div {{ $attributes->merge(['class' => 'flex items-center gap-3']) }}>
    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#D4A574] to-[#E8C39E] flex items-center justify-center shadow-lg">
        <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
        </svg>
    </div>
    <div class="hidden md:block">
        <div class="text-xl font-bold text-[#2C1810]">GustoBite</div>
        <div class="text-xs text-[#D4A574] font-medium">Restaurant</div>
    </div>
</div>