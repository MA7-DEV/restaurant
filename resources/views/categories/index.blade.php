
@extends('layouts.admin-layout')

@section('title', 'Categories')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-[#2C1810]">Categories</h1>
            <p class="text-gray-600">Manage your menu categories</p>
        </div>

        <a href="{{ route('categories.create') }}" class="btn-restaurant inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
            </svg>
            Add Category
        </a>
    </div>

    <!-- Categories Table -->
    <div class="card-restaurant overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#E8C39E]/20">
                <thead class="bg-[#FAF7F2]">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#2C1810] uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#2C1810] uppercase tracking-wider">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#2C1810] uppercase tracking-wider">
                            Meals Count
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#2C1810] uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-[#E8C39E]/10">
                    @forelse ($categories as $category)
                    <tr class="hover:bg-[#FAF7F2]/50 transition-colors">
                        <!-- Name -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-gradient-gold flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                    </svg>
                                </div>

                                <div>
                                    <div class="font-medium text-gray-900">
                                        {{ $category->name }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        Created {{ $category->created_at?->diffForHumans() ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Description -->
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-700 max-w-xs truncate">
                                {{ $category->description }}
                            </div>
                        </td>

                        <!-- Meals Count -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#2C5530]/10 text-[#2C5530]">
                                {{ $category->meals_count ?? 0 }} meals
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('categories.edit', $category->id) }}"
                                   class="inline-flex items-center px-3 py-2 border border-[#D4A574]/30 rounded-lg text-[#D4A574] hover:bg-[#FAF7F2] transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>

                                <form action="{{ route('categories.destroy', $category->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-2 border border-red-200 rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A.997.997 0 006.586 13H4"/>
                                </svg>

                                <p class="text-lg font-medium">No categories found</p>
                                <p class="mt-1">Get started by creating your first category</p>

                                <a href="{{ route('categories.create') }}" class="mt-4 btn-restaurant">
                                    Create Category
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($categories->hasPages())
        <div class="px-6 py-4 border-t border-[#E8C39E]/20 bg-[#FAF7F2]/50">
            {{ $categories->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
