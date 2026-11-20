@extends('layouts.admin-layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-6 animate-fade-in-up">

    <!-- Welcome Banner (مش أسود اوي، تدرج لوني دافئ) -->
    <div class="bg-gradient-to-r from-[#2C1810] to-[#4A2C1A] rounded-2xl p-8 text-white shadow-xl relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-gold-500/10 rounded-full blur-[80px]"></div>
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
            <div>
                <h2 class="text-3xl font-serif mb-2">Welcome back, <span class="text-gold-500">{{ auth()->user()->name }}</span></h2>
                <p class="text-gray-300">Here's a quick overview of your restaurant today.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('meals.create') }}" class="bg-gold-500 text-royal-900 px-6 py-3 rounded-xl font-bold hover:bg-gold-400 transition-colors shadow-lg flex items-center gap-2">
                    <i class="fas fa-plus"></i> Add New Meal
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Grid (ألوان مريحة) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- إجمالي الأكلات -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Meals</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ \App\Models\Meal::count() }}</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center">
                    <i class="fas fa-utensils text-orange-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- الأقسام -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Categories</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ \App\Models\Category::count() }}</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-tags text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- المستخدمين -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Users</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ \App\Models\User::count() }}</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center">
                    <i class="fas fa-users text-green-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- متوسط السعر -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Avg Price</p>
                    <h3 class="text-3xl font-bold text-gray-800">${{ number_format(\App\Models\Meal::avg('price') ?? 0, 2) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Meals Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Recently Added Meals</h3>
            <a href="{{ route('meals.index') }}" class="text-sm text-gold-600 hover:text-gold-500 font-medium">View All →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <th class="p-4 font-semibold">Meal</th>
                        <th class="p-4 font-semibold">Category</th>
                        <th class="p-4 font-semibold">Price</th>
                        <th class="p-4 font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach(\App\Models\Meal::with('category')->latest()->take(5)->get() as $meal)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4 flex items-center gap-3">
                            @if($meal->image_url)
                                <img src="{{ $meal->image_url }}" class="w-10 h-10 rounded-lg object-cover">
                            @else
                                <div class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center"><i class="fas fa-utensils text-gray-400"></i></div>
                            @endif
                            <span class="font-medium text-gray-800">{{ $meal->name }}</span>
                        </td>
                        <td class="p-4 text-gray-600">{{ $meal->category->name }}</td>
                        <td class="p-4 font-semibold text-gray-800">${{ number_format($meal->price, 2) }}</td>
                        <td class="p-4">
                            @if($meal->is_available)
                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Available</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Unavailable</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection