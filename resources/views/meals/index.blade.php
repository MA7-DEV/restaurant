@extends('layouts.admin-layout')

@section('title', 'Manage Meals')

@section('content')
<div class="space-y-6 animate-fade-in-up">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white dark:bg-royal-900 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gold-500/10">
        <div>
            <h2 class="text-2xl font-serif text-gray-800 dark:text-white">All Meals</h2>
            <p class="text-sm text-gray-500">Manage your restaurant's menu items.</p>
        </div>
        <a href="{{ route('meals.create') }}" class="bg-gradient-to-r from-gold-600 to-gold-500 text-royal-900 px-6 py-3 rounded-xl font-bold hover:shadow-lg transition-all flex items-center gap-2">
            <i class="fas fa-plus"></i> Add New Meal
        </a>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-400 p-4 rounded-r-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white dark:bg-royal-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gold-500/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-royal-800 text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">
                        <th class="p-4 font-semibold">Meal</th>
                        <th class="p-4 font-semibold">Category</th>
                        <th class="p-4 font-semibold">Price</th>
                        <th class="p-4 font-semibold">Status</th>
                        <th class="p-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gold-500/10">
                    @forelse($meals as $meal)
                    <tr class="hover:bg-gray-50 dark:hover:bg-royal-800/50 transition-colors">
                        <!-- Meal Info -->
                        <td class="p-4 flex items-center gap-4">
                            <!-- ✅ هنا استخدام image_url -->
                            @if($meal->image_url)
                                <img src="{{ $meal->image_url }}" alt="{{ $meal->name }}" class="w-14 h-14 rounded-xl object-cover shadow-sm border border-gray-100 dark:border-gold-500/20">
                            @else
                                <div class="w-14 h-14 rounded-xl bg-gray-100 dark:bg-royal-800 flex items-center justify-center border border-gray-200 dark:border-gold-500/20">
                                    <i class="fas fa-utensils text-gray-400"></i>
                                </div>
                            @endif
                            <div>
                                <h4 class="font-bold text-gray-800 dark:text-white">{{ $meal->name }}</h4>
                                <p class="text-xs text-gray-500 truncate max-w-[200px]">{{ Str::limit($meal->description, 50) }}</p>
                            </div>
                        </td>

                        <!-- Category -->
                        <td class="p-4 text-sm text-gray-600 dark:text-gray-300">
                            {{ $meal->category->name }}
                        </td>

                        <!-- Price -->
                        <td class="p-4 font-bold text-gold-600 dark:text-gold-500">
                            ${{ number_format($meal->price, 2) }}
                        </td>

                        <!-- Status -->
                        <td class="p-4">
                            @if($meal->is_available)
                                <span class="px-3 py-1 bg-green-100 dark:bg-green-500/10 text-green-700 dark:text-green-400 text-xs font-bold rounded-full">Available</span>
                            @else
                                <span class="px-3 py-1 bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 text-xs font-bold rounded-full">Unavailable</span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="p-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('meals.show', $meal->id) }}" class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-500 flex items-center justify-center hover:bg-blue-500 hover:text-white transition-all" title="View">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                                <a href="{{ route('meals.edit', $meal->id) }}" class="w-8 h-8 rounded-lg bg-gold-500/10 text-gold-600 flex items-center justify-center hover:bg-gold-500 hover:text-white transition-all" title="Edit">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form action="{{ route('meals.destroy', $meal->id) }}" method="POST" onsubmit="return confirm('Delete this meal?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 dark:bg-red-500/10 text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all" title="Delete">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-10 text-center text-gray-500">
                            <i class="fas fa-utensils text-4xl mb-3 opacity-20"></i>
                            <p>No meals found. Start by adding one!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t border-gray-100 dark:border-gold-500/10">
            {{ $meals->links() }}
        </div>
    </div>

</div>
@endsection