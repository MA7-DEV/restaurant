@extends('layouts.admin-layout')

@section('title', 'Edit Category: ' . $category->name)
@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('categories.index') }}" class="text-[#D4A574] hover:text-[#BC8A53] transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-[#2C1810]">Edit Category</h1>
        </div>
        <p class="text-gray-600">Update category information</p>
    </div>

    <!-- Form Card -->
    <div class="card-restaurant overflow-hidden">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Form Header -->
            <div class="border-b border-[#E8C39E]/20 px-6 py-4 bg-[#FAF7F2]">
                <h2 class="text-lg font-semibold text-[#2C1810]">Edit Category: {{ $category->name }}</h2>
            </div>

            <!-- Form Body -->
            <div class="p-6 space-y-6">
                <!-- Basic Information -->
                <div class="space-y-6">
                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-[#2C1810]">
                            Category Name *
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                               class="input-restaurant w-full px-4 py-2.5 rounded-lg bg-white text-[#2C1810] focus:ring-2 focus:ring-[#D4A574] focus:border-[#D4A574] transition-colors"
                               placeholder="e.g., Appetizers" required autofocus>
                        @error('name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-medium text-[#2C1810]">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="4"
                                  class="input-restaurant w-full px-4 py-2.5 rounded-lg bg-white text-[#2C1810] focus:ring-2 focus:ring-[#D4A574] focus:border-[#D4A574] transition-colors resize-none"
                                  placeholder="Describe the category...">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Stats -->
                    <div class="border border-[#E8C39E]/20 rounded-xl p-4 bg-[#FAF7F2]">
                        <h3 class="text-sm font-semibold text-[#2C1810] mb-3">Category Information</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-xs text-gray-500">Total Meals</p>
                                <p class="text-sm font-medium text-[#2C1810]">{{ $category->meals_count ?? 0 }} meals</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Created</p>
                                <p class="text-sm font-medium text-[#2C1810]">{{ $category->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Last Updated</p>
                                <p class="text-sm font-medium text-[#2C1810]">{{ $category->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Footer -->
            <div class="border-t border-[#E8C39E]/20 px-6 py-4 bg-[#FAF7F2]">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xs text-gray-500">Category ID: {{ $category->id }}</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('categories.index') }}"
                           class="inline-flex items-center px-6 py-3 border border-[#D4A574]/30 rounded-xl font-semibold text-xs text-[#2C1810] uppercase tracking-widest hover:bg-white transition-all duration-300">
                            Cancel
                        </a>
                        <button type="submit"
                                class="btn-restaurant inline-flex items-center gap-2 px-6 py-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update Category
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection