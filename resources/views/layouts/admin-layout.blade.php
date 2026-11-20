<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GustoBite - Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .sidebar {
            background: linear-gradient(180deg, #FAF7F2 0%, #FFFFFF 100%);
        }
        .sidebar-link {
            @apply flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-[#D4A574]
                   hover:bg-white/80 rounded-xl transition-all duration-300;
        }
        .sidebar-link.active {
            @apply bg-gradient-to-r from-white to-white/80 text-[#D4A574]
                   border-l-4 border-[#D4A574] shadow-sm;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gradient-restaurant min-h-screen">

    <!-- Modern Dashboard Layout -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 sidebar border-r border-[#E8C39E]/20 shadow-soft">
            <!-- Logo -->
            <div class="p-6 border-b border-[#E8C39E]/20">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-gradient-gold
                                flex items-center justify-center shadow-medium">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-.891.552L3.236 6H2a1 1 0 00-1 1v2a1 1 0 001 1h1l2 6h10l2-6h1a1 1 0 001-1V7a1 1 0 00-1-1h-1.236L14.89 2.552A1 1 0 0014 2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-[#2C1810]">GustoBite</h1>
                        <p class="text-xs text-[#D4A574] font-medium">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-2">
                <a href="{{ route('dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <div class="pt-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                        Menu Management
                    </p>

                    <a href="{{ route('categories.index') }}"
                       class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                        <span>Categories</span>
                    </a>

                    <a href="{{ route('meals.index') }}"
                       class="sidebar-link {{ request()->routeIs('meals.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                        </svg>
                        <span>Meals</span>
                    </a>
                </div>
            </nav>

            <!-- Logout Button -->
            <div class="p-4 mt-auto border-t border-[#E8C39E]/20">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 text-gray-600
                                   hover:text-[#C41E3A] hover:bg-red-50 rounded-xl transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Page Header -->
            <header class="bg-white/80 backdrop-blur-sm border-b border-[#E8C39E]/20 shadow-soft">
                <div class="px-8 py-4">
                    <h1 class="text-2xl font-bold text-[#2C1810]">
                        @yield('title', 'Dashboard')
                    </h1>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-8">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

</body>
</html>