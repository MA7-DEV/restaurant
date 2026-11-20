<!DOCTYPE html>
<html lang="en">
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

        .btn-restaurant {
            background: linear-gradient(135deg, #2C5530, #4A7C59);
            color: white;
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            display: inline-block;
        }

        .btn-restaurant:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(44, 85, 48, 0.3);
        }

        .btn-outline-restaurant {
            border: 2px solid #D4A574;
            color: #D4A574;
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-restaurant:hover {
            background: #FAF7F2;
        }

        .bg-gradient-gold {
            background: linear-gradient(135deg, #D4A574, #E8C39E);
        }
    </style>
</head>

<body class="font-sans antialiased hero-gradient">
    <!-- Navigation -->
    <header class="w-full">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4 p-6">
                @auth
                    @if(auth()->user()->email === 'admin@restaurant.com' || auth()->user()->email === 'admin@laravel.com')
                        <!-- Admin User -->
                        <a href="{{ route('categories.index') }}"
                           class="inline-block px-6 py-2.5 text-sm font-medium text-[#2C1810] border border-[#D4A574]/30 rounded-xl hover:border-[#D4A574] hover:bg-[#FAF7F2] transition-all duration-300">
                            Admin Dashboard
                        </a>
                    @else
                        <!-- Regular Customer -->
                        <a href="{{ route('customer.dashboard') }}"
                           class="inline-block px-6 py-2.5 text-sm font-medium text-[#2C1810] border border-[#D4A574]/30 rounded-xl hover:border-[#D4A574] hover:bg-[#FAF7F2] transition-all duration-300">
                            My Account
                        </a>
                    @endif

                    <a href="{{ route('menu') }}"
                       class="btn-restaurant px-6 py-2.5 text-sm">
                        View Menu
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="inline-block px-6 py-2.5 text-sm font-medium text-red-600 border border-red-200 rounded-xl hover:bg-red-50 transition-all duration-300">
                            Logout
                        </button>
                    </form>
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
                    @if(auth()->user()->email === 'admin@restaurant.com' || auth()->user()->email === 'admin@laravel.com')
                        <!-- Admin CTA -->
                        <a href="{{ route('categories.index') }}"
                           class="btn-restaurant px-8 py-3 text-lg inline-flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Admin Dashboard
                        </a>
                    @else
                        <!-- Customer CTA -->
                        <a href="{{ route('menu') }}"
                           class="btn-restaurant px-8 py-3 text-lg inline-flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                            </svg>
                            Explore Menu
                        </a>
                    @endif

                    <a href="{{ route('customer.dashboard') }}"
                       class="btn-outline-restaurant px-8 py-3 text-lg inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        My Account
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
                       class="btn-outline-restaurant px-8 py-3 text-lg inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Create Account
                    </a>
                @endauth
            </div>

            <!-- Additional Info -->
            <div class="mt-12 pt-8 border-t border-[#E8C39E]/30">
                <p class="text-gray-600 mb-4">Already loving GustoBite? Join thousands of satisfied customers</p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6 text-sm text-gray-500">
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
            <div class="mt-4 flex justify-center space-x-4">
                <a href="#" class="text-gray-400 hover:text-[#D4A574]">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-[#D4A574]">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-[#D4A574]">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                </a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Simple animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add fade-in animation to cards
            const cards = document.querySelectorAll('.feature-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('animate-fadeIn');
            });

            // Add hover effect to buttons
            const buttons = document.querySelectorAll('.btn-restaurant, .btn-outline-restaurant');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>