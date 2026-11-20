@extends('layouts.admin-layout')

@section('title', 'Dashboard')
@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="card-restaurant p-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-bold text-[#2C1810] mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-gray-600">Here's what's happening with your restaurant today.</p>
            </div>
            <div class="w-16 h-16 rounded-full bg-gradient-gold flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Categories Card -->
        <div class="card-restaurant p-6 hover:transform hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl bg-[#FAF7F2]">
                    <svg class="w-6 h-6 text-[#D4A574]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-[#2C1810]">{{ $categoriesCount ?? '0' }}</span>
            </div>
            <h3 class="font-semibold text-gray-700 mb-1">Categories</h3>
            <p class="text-sm text-gray-500">Menu categories</p>
            <a href="{{ route('categories.index') }}" class="mt-4 inline-flex items-center text-sm text-[#D4A574] hover:text-[#BC8A53]">
                View all
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

        <!-- Meals Card -->
        <div class="card-restaurant p-6 hover:transform hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl bg-[#FAF7F2]">
                    <svg class="w-6 h-6 text-[#D4A574]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-[#2C1810]">{{ $mealsCount ?? '0' }}</span>
            </div>
            <h3 class="font-semibold text-gray-700 mb-1">Total Meals</h3>
            <p class="text-sm text-gray-500">Available dishes</p>
            <a href="{{ route('meals.index') }}" class="mt-4 inline-flex items-center text-sm text-[#D4A574] hover:text-[#BC8A53]">
                View all
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

        <!-- Revenue Card -->
        <div class="card-restaurant p-6 hover:transform hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl bg-[#FAF7F2]">
                    <svg class="w-6 h-6 text-[#D4A574]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-[#2C1810]">${{ $totalRevenue ?? '0' }}</span>
            </div>
            <h3 class="font-semibold text-gray-700 mb-1">Total Revenue</h3>
            <p class="text-sm text-gray-500">This month</p>
            <div class="mt-4 flex items-center text-sm text-green-600">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                </svg>
                +12.5%
            </div>
        </div>

        <!-- Orders Card -->
        <div class="card-restaurant p-6 hover:transform hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl bg-[#FAF7F2]">
                    <svg class="w-6 h-6 text-[#D4A574]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-[#2C1810]">{{ $ordersCount ?? '0' }}</span>
            </div>
            <h3 class="font-semibold text-gray-700 mb-1">Orders</h3>
            <p class="text-sm text-gray-500">Today's orders</p>
            <div class="mt-4 flex items-center text-sm text-blue-600">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                +8 new
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card-restaurant p-8">
        <h2 class="text-xl font-bold text-[#2C1810] mb-6">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('categories.create') }}"
               class="flex items-center gap-4 p-4 rounded-xl border border-[#E8C39E]/30 hover:border-[#D4A574] hover:bg-[#FAF7F2] transition-all duration-300 group">
                <div class="w-12 h-12 rounded-full bg-gradient-gold flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700">Add Category</h3>
                    <p class="text-sm text-gray-500">Create new menu category</p>
                </div>
            </a>

            <a href="{{ route('meals.create') }}"
               class="flex items-center gap-4 p-4 rounded-xl border border-[#E8C39E]/30 hover:border-[#D4A574] hover:bg-[#FAF7F2] transition-all duration-300 group">
                <div class="w-12 h-12 rounded-full bg-gradient-gold flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700">Add Meal</h3>
                    <p class="text-sm text-gray-500">Add new dish to menu</p>
                </div>
            </a>

            <a href="{{ route('meals.index') }}"
               class="flex items-center gap-4 p-4 rounded-xl border border-[#E8C39E]/30 hover:border-[#D4A574] hover:bg-[#FAF7F2] transition-all duration-300 group">
                <div class="w-12 h-12 rounded-full bg-gradient-gold flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700">View Orders</h3>
                    <p class="text-sm text-gray-500">Check recent orders</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection