@extends('layouts.admin-layout')

@section('title', 'View Meal Details')

@section('content')
<div class="max-w-5xl mx-auto animate-fade-in-up">

    <!-- Back Button -->
    <a href="{{ route('meals.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-gold-500 transition-colors mb-6 group">
        <div class="w-8 h-8 rounded-full bg-white dark:bg-royal-800 border border-gray-200 dark:border-gold-500/20 flex items-center justify-center group-hover:border-gold-500 transition-colors">
            <i class="fas fa-arrow-left text-sm"></i>
        </div>
        <span class="text-sm font-medium">Back to Menu</span>
    </a>

    <div class="bg-white dark:bg-royal-900 rounded-3xl shadow-xl border border-gray-100 dark:border-gold-500/10 overflow-hidden">
        <div class="flex flex-col md:flex-row">

            <!-- Image Section -->
            <div class="w-full md:w-1/2 relative h-72 md:h-auto min-h-[400px] bg-gray-100 dark:bg-royal-800">
                @if($meal->image_url)
                    <img src="{{ $meal->image_url }}" alt="{{ $meal->name }}" class="absolute inset-0 w-full h-full object-cover">
                @else
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-utensils text-6xl text-gray-300 dark:text-gold-500/20"></i>
                    </div>
                @endif

                <!-- Overlay & Badge -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent md:bg-gradient-to-r md:from-transparent md:to-white/10 dark:md:to-royal-900/50"></div>
                <div class="absolute top-6 left-6">
                    <span class="bg-white/90 dark:bg-royal-800/90 backdrop-blur-md text-gold-600 dark:text-gold-500 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full shadow-lg">
                        {{ $meal->category->name }}
                    </span>
                </div>
            </div>

            <!-- Details Section -->
            <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-between">
                <div>
                    <h1 class="text-4xl md:text-5xl font-serif text-gray-800 dark:text-white leading-tight mb-4">{{ $meal->name }}</h1>

                    <div class="flex items-center gap-4 mb-8">
                        <span class="text-3xl font-bold text-gold-600 dark:text-gold-500">${{ number_format($meal->price, 2) }}</span>
                        <span class="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-600"></span>
                        <span class="text-sm font-medium {{ $meal->is_available ? 'text-green-500' : 'text-red-500' }} flex items-center gap-1">
                            <i class="fas {{ $meal->is_available ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                            {{ $meal->is_available ? 'Available' : 'Unavailable' }}
                        </span>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3 flex items-center gap-2">
                            <i class="fas fa-info-circle text-gold-500"></i> Description
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            {{ $meal->description ?? 'A delicious dish prepared with the finest ingredients.' }}
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3 pt-6 border-t border-gray-100 dark:border-gold-500/10">
                    <a href="{{ route('meals.edit', $meal->id) }}" class="w-full bg-gradient-to-r from-gold-600 to-gold-500 text-royal-900 py-3.5 rounded-xl font-bold text-sm uppercase tracking-wider text-center block hover:shadow-[0_0_20px_rgba(212,175,55,0.4)] transition-all transform hover:-translate-y-0.5">
                        <i class="fas fa-edit mr-2"></i> Edit Meal
                    </a>
                    <form action="{{ route('meals.destroy', $meal->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 py-3.5 rounded-xl font-bold text-sm uppercase tracking-wider hover:bg-red-100 dark:hover:bg-red-500/20 transition-all">
                            <i class="fas fa-trash mr-2"></i> Delete Meal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection