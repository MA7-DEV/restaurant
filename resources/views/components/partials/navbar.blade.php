<nav id="navbar" class="bg-cream/80 dark:bg-royal-900/80 backdrop-blur-md border-b border-gold-500/10 sticky top-0 z-50 transition-colors duration-300">
    <div class="container mx-auto px-4 md:px-6 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo (لينك للصفحة الرئيسية) -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 rounded-full border border-gold-500/30 flex items-center justify-center group-hover:bg-gold-500/10 transition-all">
                    <i class="fas fa-utensils text-gold-500"></i>
                </div>
                <div>
                    <h1 class="font-serif text-lg md:text-xl text-brown dark:text-white tracking-wider">Gusto<span class="text-gold-500">Bite</span></h1>
                    <p class="hidden md:block text-[10px] text-gold-500/60 uppercase tracking-[0.2em]">Luxury Dining</p>
                </div>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-6 text-sm tracking-wide">
                @guest
                    <a href="{{ route('home') }}" class="text-brown/80 dark:text-gray-300 hover:text-gold-500 transition-colors">Home</a>
                @endguest

                <a href="{{ route('menu') }}" class="text-brown/80 dark:text-gray-300 hover:text-gold-500 transition-colors">Menu</a>

                @auth
                    @if(!auth()->user()->isAdmin())
                        <!-- Cart Icon (Desktop) -->
                        <div class="relative">
                            <a href="{{ route('cart.index') }}" class="text-brown/80 dark:text-gray-300 hover:text-gold-500 transition-colors relative">
                                <i class="fas fa-shopping-cart text-lg"></i>
                                <span id="cart-count" class="absolute -top-2 -right-2 bg-gold-500 text-royal-900 text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center {{ session('cart') ? '' : 'hidden' }}">
                                    {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
                                </span>
                            </a>
                        </div>
                    @endif
                    <a href="{{ route('dashboard') }}" class="text-brown/80 dark:text-gray-300 hover:text-gold-500 transition-colors">Dashboard</a>
                    <div class="h-4 w-px bg-gold-500/20"></div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-brown/60 dark:text-gray-400 hover:text-red-400 transition-colors"><i class="fas fa-sign-out-alt"></i></button>
                    </form>
                @else
                    <div class="h-4 w-px bg-gold-500/20"></div>
                    <a href="{{ route('login') }}" class="text-brown/80 dark:text-gray-300 hover:text-gold-500 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-gold-600 to-gold-500 text-royal-900 px-5 py-2 rounded-full font-semibold hover:shadow-[0_0_15px_rgba(212,175,55,0.4)] transition-all">Register</a>
                @endauth

                <button id="theme-toggle" class="w-10 h-10 rounded-full border border-gold-500/30 flex items-center justify-center text-gold-500 hover:bg-gold-500/10 transition-all ml-4">
                    <i id="theme-icon" class="fas fa-moon"></i>
                </button>
            </div>

            <!-- Mobile Buttons -->
            <div class="flex items-center space-x-4 md:hidden">
                @auth
                    @if(!auth()->user()->isAdmin())
                        <a href="{{ route('cart.index') }}" class="text-brown dark:text-white relative">
                            <i class="fas fa-shopping-cart text-xl"></i>
                            <span id="cart-count-mobile" class="absolute -top-2 -right-2 bg-gold-500 text-royal-900 text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center {{ session('cart') ? '' : 'hidden' }}">
                                {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
                            </span>
                        </a>
                    @endif
                @endauth
                <button id="theme-toggle-mobile" class="w-10 h-10 rounded-full border border-gold-500/30 flex items-center justify-center text-gold-500 hover:bg-gold-500/10 transition-all">
                    <i id="theme-icon-mobile" class="fas fa-moon"></i>
                </button>
                <button id="mobile-menu-btn" class="text-brown dark:text-white text-2xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 space-y-4 border-t border-gold-500/10 pt-4">
            @guest
                <a href="{{ route('home') }}" class="block text-brown dark:text-gray-300 hover:text-gold-500">Home</a>
            @endguest

            <a href="{{ route('menu') }}" class="block text-brown dark:text-gray-300 hover:text-gold-500">Menu</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block text-brown dark:text-gray-300 hover:text-gold-500">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left text-red-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block text-brown dark:text-gray-300 hover:text-gold-500">Login</a>
                <a href="{{ route('register') }}" class="block bg-gradient-to-r from-gold-600 to-gold-500 text-royal-900 px-5 py-2 rounded-full font-semibold text-center">Register</a>
            @endauth
        </div>
    </div>

    <!-- Scroll Progress Bar -->
    <div class="absolute bottom-0 left-0 h-[2px] bg-gradient-to-r from-gold-600 via-gold-400 to-gold-600 w-0 transition-all duration-150 ease-out" id="scroll-progress"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            if(mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            const themeToggles = [
                { btn: document.getElementById('theme-toggle'), icon: document.getElementById('theme-icon') },
                { btn: document.getElementById('theme-toggle-mobile'), icon: document.getElementById('theme-icon-mobile') }
            ];

            function updateIcons() {
                const isDark = document.documentElement.classList.contains('dark');
                themeToggles.forEach(t => {
                    if (t.icon) {
                        t.icon.classList.toggle('fa-moon', isDark);
                        t.icon.classList.toggle('fa-sun', !isDark);
                    }
                });
            }
            updateIcons();

            themeToggles.forEach(t => {
                if (t.btn) {
                    t.btn.addEventListener('click', function() {
                        document.documentElement.classList.toggle('dark');
                        const isDark = document.documentElement.classList.contains('dark');
                        localStorage.setItem('theme', isDark ? 'dark' : 'light');
                        updateIcons();
                    });
                }
            });

            const scrollProgress = document.getElementById('scroll-progress');
            window.addEventListener('scroll', function() {
                const scrollTop = window.scrollY;
                const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrollPercent = (scrollTop / docHeight) * 100;
                scrollProgress.style.width = scrollPercent + '%';
            });
        });
    </script>
</nav>