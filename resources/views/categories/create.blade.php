@extends('layouts.admin-layout')

@section('title', 'Add Category')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-[#2C1810]">Add New Category</h1>
        <p class="text-gray-600">Create a new menu category</p>
    </div>

    <div class="card-restaurant p-8">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <!-- Category Name -->
            <div class="mb-6">
                <x-input-label for="name" :value="__('Category Name')" />
                <x-text-input id="name" name="name" type="text" class="block mt-2 w-full"
                            :value="old('name')" required autofocus
                            placeholder="e.g., Appetizers, Main Course, Desserts" />
                @error('name')
                    <x-input-error :messages="[$message]" class="mt-2" />
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-8">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description" rows="4"
                         class="input-restaurant w-full resize-none"
                         placeholder="Brief description of this category">{{ old('description') }}</textarea>
                @error('description')
                    <x-input-error :messages="[$message]" class="mt-2" />
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-[#E8C39E]/20">
                <a href="{{ route('categories.index') }}"
                   class="inline-flex items-center px-6 py-3 border border-[#D4A574]/30 rounded-xl font-semibold text-xs text-[#2C1810] uppercase tracking-widest hover:bg-[#FAF7F2] transition-all duration-300">
                    Cancel
                </a>
                <x-primary-button class="px-8">
                    Save Category
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection