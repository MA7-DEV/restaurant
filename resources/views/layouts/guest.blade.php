<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>GustoBite | {{ config('app.name', 'Modern Restaurant') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-restaurant">

            <!-- Logo Section -->
            <div class="w-full text-center mb-8 px-4">
                <a href="/" class="inline-block restaurant-logo">
                    <div class="flex flex-col items-center justify-center gap-4">
                        <div class="w-20 h-20 rounded-full bg-gradient-gold
                                    flex items-center justify-center shadow-strong
                                    transform hover:scale-105 transition-all duration-300">
                            <!-- Fork & Knife Icon -->
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-.891.552L3.236 6H2a1 1 0 00-1 1v2a1 1 0 001 1h1l2 6h10l2-6h1a1 1 0 001-1V7a1 1 0 00-1-1h-1.236L14.89 2.552A1 1 0 0014 2H6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-[#2C1810] tracking-tight">GustoBite</h1>
                            <p class="text-sm text-[#D4A574] font-medium mt-1">Modern Dining Experience</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Form Card -->
            <div class="w-full sm:max-w-md mt-4 px-6 py-8 card-restaurant">
                {{ $slot }}
            </div>

            <!-- Back to Home Link -->
            <div class="mt-8 text-center">
                <a href="/" class="text-sm text-[#D4A574] hover:text-[#BC8A53] font-medium transition-colors">
                    ← Back to homepage
                </a>
            </div>
        </div>
    </body>
</html>