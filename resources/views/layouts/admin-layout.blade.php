<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - GustoBite</title>

    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 dark:bg-royal-800 font-sans antialiased transition-colors duration-300">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-royal-900 border-r border-gray-200 dark:border-gold-500/10 hidden md:flex flex-col">
            <div class="p-6 border-b border-gray-200 dark:border-gold-500/10">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gold-500 flex items-center justify-center">
                        <i class="fas fa-utensils text-white"></i>
                    </div>
                    <span class="font-serif text-xl text-gray-800 dark:text-white">Gusto<span class="text-gold-500">Bite</span></span>
                </a>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-gold-500/10 text-gold-600 font-semibold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-royal-800' }}">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
                <a href="{{ route('meals.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('meals.*') ? 'bg-gold-500/10 text-gold-600 font-semibold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-royal-800' }}">
                    <i class="fas fa-utensils"></i> Meals
                </a>
                <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('categories.*') ? 'bg-gold-500/10 text-gold-600 font-semibold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-royal-800' }}">
                    <i class="fas fa-tags"></i> Categories
                </a>
                <a href="{{ route('menu') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-royal-800">
                    <i class="fas fa-external-link-alt"></i> View Site
                </a>
            </nav>
            <div class="p-4 border-t border-gray-200 dark:border-gold-500/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white dark:bg-royal-900 border-b border-gray-200 dark:border-gold-500/10 p-4 flex justify-between items-center">
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">@yield('title', 'Dashboard')</h1>
                <div class="flex items-center gap-4">
                    <button id="theme-toggle" class="text-gray-500 hover:text-gold-500"><i class="fas fa-moon"></i></button>
                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ auth()->user()->name }}</span>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 flex-1">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Theme Toggle Script -->
    <script>
        document.getElementById('theme-toggle')?.addEventListener('click', function() {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            this.querySelector('i').classList.toggle('fa-moon', isDark);
            this.querySelector('i').classList.toggle('fa-sun', !isDark);
        });
    </script>

</body>
</html>