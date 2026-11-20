@extends('layouts.admin-layout')

@section('title', 'Meals')
@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-[#2C1810]">Meals</h1>
            <p class="text-gray-600">Manage your restaurant dishes</p>
        </div>
        <a href="{{ route('meals.create') }}" class="btn-restaurant inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
            </svg>
            Add Meal
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card-restaurant p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Meals</p>
                    <p class="text-2xl font-bold text-[#2C1810]">{{ $meals->total() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-gradient-gold flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card-restaurant p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Categories</p>
                    <p class="text-2xl font-bold text-[#2C1810]">{{ $categories->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-[#2C5530] to-[#6BAF6B] flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card-restaurant p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Avg. Price</p>
                    <p class="text-2xl font-bold text-[#2C1810]">${{ number_format($averagePrice ?? 0, 2) }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-[#C41E3A] to-[#D9455D] flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Meals Table -->
    <div class="card-restaurant overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#E8C39E]/20">
                <thead class="bg-[#FAF7F2]">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#2C1810] uppercase tracking-wider">
                            Meal
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#2C1810] uppercase tracking-wider">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#2C1810] uppercase tracking-wider">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#2C1810] uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#2C1810] uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#E8C39E]/10">
                    @forelse ($meals as $meal)
                    <tr class="hover:bg-[#FAF7F2]/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($meal->image)
                                <div class="w-12 h-12 rounded-xl overflow-hidden mr-3">
                                    <img src="{{ asset('storage/' . $meal->image) }}"
                                         alt="{{ $meal->name }}"
                                         class="w-full h-full object-cover">
                                </div>
                                @else
                                <div class="w-12 h-12 rounded-xl bg-gradient-gold flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-.891.552L3.236 6H2a1 1 0 00-1 1v2a1 1 0 001 1h1l2 6h10l2-6h1a1 1 0 001-1V7a1 1 0 00-1-1h-1.236L14.89 2.552A1 1 0 0014 2H6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                @endif
                                <div>
                                    <div class="font-medium text-gray-900">{{ $meal->name }}</div>
                                    <div class="text-sm text-gray-500 truncate max-w-xs">{{ $meal->description }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#2C5530]/10 text-[#2C5530]">
                                {{ $meal->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg font-bold text-[#2C1810]">${{ number_format($meal->price, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($meal->is_available)
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Available
                            </span>
                            @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Unavailable
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('meals.show', $meal->id) }}"
                                   class="inline-flex items-center px-3 py-2 border border-[#2C5530]/20 rounded-lg text-[#2C5530] hover:bg-[#2C5530]/5 transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    View
                                </a>
                                <a href="{{ route('meals.edit', $meal->id) }}"
                                   class="inline-flex items-center px-3 py-2 border border-[#D4A574]/30 rounded-lg text-[#D4A574] hover:bg-[#FAF7F2] transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('meals.destroy', $meal->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this meal?');">
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
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                                </svg>
                                <p class="text-lg font-medium">No meals found</p>
                                <p class="mt-1">Get started by adding your first dish</p>
                                <a href="{{ route('meals.create') }}" class="mt-4 btn-restaurant">
                                    Add Meal
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($meals->hasPages())
        <div class="px-6 py-4 border-t border-[#E8C39E]/20 bg-[#FAF7F2]/50">
            {{ $meals->links() }}
        </div>
        @endif
    </div>
</div>
@endsection