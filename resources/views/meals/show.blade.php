@extends('layouts.admin-layout')

@section('title', $meal->name)
@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-[#2C1810]">{{ $meal->name }}</h1>
            <p class="text-gray-600">Meal details and information</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('meals.edit', $meal->id) }}"
               class="btn-restaurant inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Meal
            </a>
            <a href="{{ route('meals.index') }}"
               class="inline-flex items-center px-6 py-3 border border-[#D4A574]/30 rounded-xl font-semibold text-xs text-[#2C1810] uppercase tracking-widest hover:bg-[#FAF7F2] transition-all duration-300">
                Back to List
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Image & Basic Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Image Card -->
            <div class="card-restaurant overflow-hidden">
                @if($meal->image)
                <img src="{{ asset('storage/' . $meal->image) }}"
                     alt="{{ $meal->name }}"
                     class="w-full h-96 object-cover">
                @else
                <div class="w-full h-96 bg-gradient-gold flex items-center justify-center">
                    <svg class="w-24 h-24 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-[#2C1810]">{{ $meal->name }}</h2>
                        <span class="text-2xl font-bold text-[#D4A574]">${{ number_format($meal->price, 2) }}</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#2C5530]/10 text-[#2C5530]">
                            {{ $meal->category->name }}
                        </span>
                        @if($meal->is_available)
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Available
                        </span>
                        @else
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Unavailable
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Description Card -->
            <div class="card-restaurant p-6">
                <h3 class="text-lg font-semibold text-[#2C1810] mb-4">Description</h3>
                <p class="text-gray-700 leading-relaxed">
                    {{ $meal->description ?: 'No description provided.' }}
                </p>
            </div>
        </div>

        <!-- Right Column - Details & Actions -->
        <div class="space-y-6">
            <!-- Details Card -->
            <div class="card-restaurant p-6">
                <h3 class="text-lg font-semibold text-[#2C1810] mb-4">Details</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Category</p>
                        <p class="font-medium text-[#2C1810]">{{ $meal->category->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Price</p>
                        <p class="text-2xl font-bold text-[#D4A574]">${{ number_format($meal->price, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        @if($meal->is_available)
                        <div class="flex items-center gap-2 text-green-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Available</span>
                        </div>
                        @else
                        <div class="flex items-center gap-2 text-red-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <span>Unavailable</span>
                        </div>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Created</p>
                        <p class="font-medium text-[#2C1810]">{{ $meal->created_at->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Last Updated</p>
                        <p class="font-medium text-[#2C1810]">{{ $meal->updated_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card-restaurant p-6">
                <h3 class="text-lg font-semibold text-[#2C1810] mb-4">Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('meals.edit', $meal->id) }}"
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 border border-[#D4A574]/30 rounded-xl font-medium text-[#D4A574] hover:bg-[#FAF7F2] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Meal
                    </a>

                    <form action="{{ route('meals.destroy', $meal->id) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this meal?');"
                          class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 border border-red-200 rounded-xl font-medium text-red-600 hover:bg-red-50 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Meal
                        </button>
                    </form>

                    <a href="{{ route('meals.index') }}"
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 border border-gray-200 rounded-xl font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Meals
                    </a>
                </div>
            </div>

            <!-- Category Info -->
            <div class="card-restaurant p-6">
                <h3 class="text-lg font-semibold text-[#2C1810] mb-4">Category Information</h3>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#2C5530] to-[#6BAF6B] flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-[#2C1810]">{{ $meal->category->name }}</p>
                        <p class="text-sm text-gray-500 truncate max-w-xs">{{ $meal->category->description }}</p>
                    </div>
                </div>
                <a href="{{ route('categories.show', $meal->category->id) }}"
                   class="mt-4 inline-flex items-center text-sm text-[#D4A574] hover:text-[#BC8A53]">
                    View Category Details
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection