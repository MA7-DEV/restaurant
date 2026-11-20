<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>GustoBite | Modern Restaurant</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            .hero-gradient {
                background: linear-gradient(135deg, #FAF7F2 0%, #F5EFE6 100%);
            }

            .feature-card {
                transition: all 0.3s ease;
            }

            .feature-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 30px rgba(212, 165, 116, 0.1);
            }

            .restaurant-logo {
                animation: float 3s ease-in-out infinite;
            }

            @keyframes float {
                0%, 100% {
                    transform: translateY(0);
                }
                50% {
                    transform: translateY(-10px);
                }
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased hero-gradient">
        <!-- Navigation -->
        <header class="w-full">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4 p-6">
                    @auth
                        <a href="{{ url('/home') }}"
                           class="inline-block px-6 py-2.5 text-sm font-medium text-[#2C1810] border border-[#D4A574]/30 rounded-xl hover:border-[#D4A574] hover:bg-[#FAF7F2] transition-all duration-300">
                            Go to Menu
                        </a>
                        <a href="{{ url('/dashboard') }}"
                           class="btn-restaurant px-6 py-2.5 text-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-block px-6 py-2.5 text-sm font-medium text-[#2C1810] border border-[#D4A574]/30 rounded-xl hover:border-[#D4A574] hover:bg-[#FAF7F2] transition-all duration-300">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="btn-restaurant px-6 py-2.5 text-sm">
                                Get Started
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Hero Section -->
        <main class="flex items-center justify-center min-h-[80vh] px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Logo -->
                <div class="restaurant-logo mb-8">
                    <div class="w-32 h-32 rounded-full bg-gradient-to-r from-[#D4A574] to-[#E8C39E] flex items-center justify-center mx-auto shadow-2xl mb-6">
                        <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-.891.552L3.236 6H2a1 1 0 00-1 1v2a1 1 0 001 1h1l2 6h10l2-6h1a1 1 0 001-1V7a1 1 0 00-1-1h-1.236L14.89 2.552A1 1 0 0014 2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-bold text-[#2C1810] mb-4 font-['Playfair_Display']">
                        Gusto<span class="text-[#D4A574]">Bite</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8">Modern Dining Experience</p>
                </div>

                <!-- Tagline -->
                <div class="mb-12">
                    <p class="text-2xl md:text-3xl text-gray-700 mb-6 leading-relaxed max-w-3xl mx-auto">
                        Where <span class="text-[#D4A574] font-semibold">flavor</span> meets
                        <span class="text-[#2C5530] font-semibold">perfection</span> in every bite
                    </p>
                </div>

                <!-- Features -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="feature-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/50 shadow-lg">
                        <div class="w-12 h-12 rounded-full bg-gradient-gold flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-[#2C1810] mb-2">Personalized Experience</h3>
                        <p class="text-sm text-gray-600">Create an account for personalized recommendations</p>
                    </div>

                    <div class="feature-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/50 shadow-lg">
                        <div class="w-12 h-12 rounded-full bg-gradient-gold flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-.891.552L3.236 6H2a1 1 0 00-1 1v2a1 1 0 001 1h1l2 6h10l2-6h1a1 1 0 001-1V7a1 1 0 00-1-1h-1.236L14.89 2.552A1 1 0 0014 2H6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-[#2C1810] mb-2">Exquisite Menu</h3>
                        <p class="text-sm text-gray-600">Browse our carefully crafted selection of dishes</p>
                    </div>

                    <div class="feature-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/50 shadow-lg">
                        <div class="w-12 h-12 rounded-full bg-gradient-gold flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-[#2C1810] mb-2">Secure & Reliable</h3>
                        <p class="text-sm text-gray-600">Your data is protected with enterprise-grade security</p>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <a href="{{ url('/home') }}"
                           class="btn-restaurant px-8 py-3 text-lg inline-flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                            </svg>
                            Explore Menu
                        </a>
                        <a href="{{ url('/dashboard') }}"
                           class="inline-flex items-center px-8 py-3 border-2 border-[#D4A574] rounded-xl font-semibold text-[#D4A574] hover:bg-[#FAF7F2] transition-all duration-300 text-lg">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="btn-restaurant px-8 py-3 text-lg inline-flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Sign In
                        </a>
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center px-8 py-3 border-2 border-[#D4A574] rounded-xl font-semibold text-[#D4A574] hover:bg-[#FAF7F2] transition-all duration-300 text-lg">
                            Create Account
                        </a>
                    @endauth
                </div>

                <!-- Additional Info -->
                <div class="mt-12 pt-8 border-t border-[#E8C39E]/30">
                    <p class="text-gray-600 mb-4">Already loving GustoBite? Join thousands of satisfied customers</p>
                    <div class="flex items-center justify-center gap-6 text-sm text-gray-500">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>No credit card required</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Free forever plan</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>24/7 support</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="mt-20 py-8 border-t border-[#E8C39E]/30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-gray-600 text-sm">
                    &copy; {{ date('Y') }} GustoBite Restaurant. All rights reserved.
                    <span class="mx-2">•</span>
                    <a href="#" class="text-[#D4A574] hover:text-[#BC8A53]">Privacy Policy</a>
                    <span class="mx-2">•</span>
                    <a href="#" class="text-[#D4A574] hover:text-[#BC8A53]">Terms of Service</a>
                </p>
            </div>
        </footer>
    </body>
</html>