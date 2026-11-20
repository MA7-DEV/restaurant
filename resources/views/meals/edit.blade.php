@extends('layouts.admin-layout')

@section('title', 'Edit Meal: ' . $meal->name)
@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Debug Section - Add This -->
    @if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <h3 class="font-semibold text-red-700">Please fix the following errors:</h3>
        </div>
        <ul class="list-disc pl-5 text-red-600">
            @foreach ($errors->all() as $error)
                <li class="py-1">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="text-green-700">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if (session('error'))
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span class="text-red-700">{{ session('error') }}</span>
        </div>
    </div>
    @endif
    <!-- End Debug Section -->

    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('meals.index') }}" class="text-[#D4A574] hover:text-[#BC8A53] transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-[#2C1810]">Edit Meal</h1>
        </div>
        <p class="text-gray-600">Update meal information</p>
    </div>

    <!-- Form Card -->
    <div class="card-restaurant overflow-hidden">
        <form action="{{ route('meals.update', $meal->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Form Header -->
            <div class="border-b border-[#E8C39E]/20 px-6 py-4 bg-[#FAF7F2]">
                <h2 class="text-lg font-semibold text-[#2C1810]">Edit Meal: {{ $meal->name }}</h2>
            </div>

            <!-- Form Body -->
            <div class="p-6 space-y-6">
                <!-- Image Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Current Image -->
                    <div class="space-y-3">
                        <label class="block text-sm font-medium text-[#2C1810]">
                            Current Image
                        </label>
                        <div class="border border-[#E8C39E]/20 rounded-xl p-4 bg-[#FAF7F2]">
                            @if($meal->image)
                                <img src="{{ asset('storage/' . $meal->image) }}"
                                     alt="{{ $meal->name }}"
                                     class="w-full h-48 object-cover rounded-lg">
                            @else
                                <div class="h-48 flex items-center justify-center rounded-lg bg-gradient-gold">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="mt-2 text-sm text-white">No image</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- New Image Upload -->
                    <div class="space-y-3">
                        <label for="image" class="block text-sm font-medium text-[#2C1810]">
                            Change Image (Optional)
                        </label>
                        <label for="image" class="cursor-pointer block">
                            <div class="border-2 border-dashed border-[#E8C39E]/50 rounded-xl p-6 hover:border-[#D4A574] transition-colors text-center h-48 flex flex-col items-center justify-center bg-[#FAF7F2]">
                                <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                <p class="mt-3 text-sm font-medium text-[#2C1810]">Upload new image</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 5MB</p>
                            </div>
                            <input id="image" name="image" type="file" class="hidden"
                                   accept="image/*" onchange="previewNewImage(event)">
                        </label>
                        <div id="new-image-preview" class="hidden">
                            <p class="text-sm text-[#2C1810] mb-2">New image preview:</p>
                            <img id="new-preview" class="w-full h-48 object-cover rounded-lg border border-[#E8C39E]/20">
                        </div>
                        @error('image')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Basic Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Meal Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-[#2C1810]">
                            Meal Name *
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $meal->name) }}"
                               class="input-restaurant w-full px-4 py-2.5 rounded-lg bg-white text-[#2C1810] focus:ring-2 focus:ring-[#D4A574] focus:border-[#D4A574] transition-colors"
                               placeholder="e.g., Grilled Salmon" required autofocus>
                        @error('name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="space-y-2">
                        <label for="category_id" class="block text-sm font-medium text-[#2C1810]">
                            Category *
                        </label>
                        <select id="category_id" name="category_id"
                                class="input-restaurant w-full px-4 py-2.5 rounded-lg bg-white text-[#2C1810] focus:ring-2 focus:ring-[#D4A574] focus:border-[#D4A574] transition-colors" required>
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $meal->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="space-y-2">
                        <label for="price" class="block text-sm font-medium text-[#2C1810]">
                            Price *
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">$</span>
                            </div>
                            <input type="number" id="price" name="price" value="{{ old('price', $meal->price) }}" step="0.01" min="0.01"
                                   class="input-restaurant w-full pl-8 px-4 py-2.5 rounded-lg bg-white text-[#2C1810] focus:ring-2 focus:ring-[#D4A574] focus:border-[#D4A574] transition-colors"
                                   placeholder="0.00" required>
                        </div>
                        @error('price')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Availability -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-[#2C1810]">
                            Availability
                        </label>
                        <div class="flex items-center h-12">
                            <label class="inline-flex items-center cursor-pointer">
                                <input id="is_available" name="is_available" type="checkbox" value="1"
                                       class="rounded border-[#E8C39E] text-[#D4A574] shadow-sm focus:ring-[#D4A574] focus:border-[#D4A574]"
                                       {{ old('is_available', $meal->is_available) ? 'checked' : '' }}>
                                <span class="ml-3 text-sm font-medium text-[#2C1810]">
                                    Available for ordering
                                </span>
                            </label>
                        </div>
                        @error('is_available')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-[#2C1810]">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="4"
                              class="input-restaurant w-full px-4 py-2.5 rounded-lg bg-white text-[#2C1810] focus:ring-2 focus:ring-[#D4A574] focus:border-[#D4A574] transition-colors resize-none"
                              placeholder="Describe your meal...">{{ old('description', $meal->description) }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Meal Stats -->
                <div class="border border-[#E8C39E]/20 rounded-xl p-4 bg-[#FAF7F2]">
                    <h3 class="text-sm font-semibold text-[#2C1810] mb-3">Meal Information</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center">
                            <div class="text-xs text-gray-500">Created</div>
                            <div class="text-sm font-medium text-[#2C1810]">{{ $meal->created_at->format('M d, Y') }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xs text-gray-500">Last Updated</div>
                            <div class="text-sm font-medium text-[#2C1810]">{{ $meal->updated_at->format('M d, Y') }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xs text-gray-500">Category</div>
                            <div class="text-sm font-medium text-[#2C1810]">{{ $meal->category->name }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xs text-gray-500">Current Price</div>
                            <div class="text-sm font-bold text-[#2C1810]">${{ number_format($meal->price, 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Footer -->
            <div class="border-t border-[#E8C39E]/20 px-6 py-4 bg-[#FAF7F2]">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xs text-gray-500">Meal ID: {{ $meal->id }}</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('meals.index') }}"
                           class="inline-flex items-center px-6 py-3 border border-[#D4A574]/30 rounded-xl font-semibold text-xs text-[#2C1810] uppercase tracking-widest hover:bg-white transition-all duration-300">
                            Cancel
                        </a>
                        <button type="submit"
                                class="btn-restaurant inline-flex items-center gap-2 px-6 py-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update Meal
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewNewImage(event) {
    const input = event.target;
    const previewContainer = document.getElementById('new-image-preview');
    const preview = document.getElementById('new-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// Optional: Form validation feedback
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        // Simple validation
        const name = form.querySelector('#name').value.trim();
        const price = form.querySelector('#price').value;
        const category = form.querySelector('#category_id').value;

        if (!name || !price || !category) {
            e.preventDefault();
            alert('Please fill in all required fields (Name, Price, and Category).');
            return false;
        }

        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Updating Meal...';
    });
});
</script>
@endsection