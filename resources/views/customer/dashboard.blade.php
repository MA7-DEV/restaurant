<x-layouts.app title="My Account - GustoBite">

    <!-- الخلفية العامة -->
    <div class="min-h-screen bg-[#FAF7F2] dark:bg-[#0A0A0A] py-12 transition-colors duration-500 relative overflow-hidden">

        <!-- توهج خلفي (Glow) في الدارك مود -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-gold-500/5 dark:bg-gold-500/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up">

            <!-- 1. Welcome Banner (تأثير زجاجي مع تدرج) -->
            <div class="relative overflow-hidden rounded-3xl bg-white/60 dark:bg-royal-900/40 backdrop-blur-xl border border-gray-200/50 dark:border-gold-500/20 shadow-xl dark:shadow-[0_8px_30px_rgba(0,0,0,0.5)] mb-8 p-8 md:p-10">
                <!-- لمعة ذهبية -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-gold-500/20 to-transparent rounded-full blur-3xl -mr-16 -mt-16"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="text-center md:text-left">
                        <h1 class="text-3xl md:text-4xl font-serif text-gray-800 dark:text-white mb-2">
                            Hello, <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-600 to-gold-400 dark:from-gold-400 dark:to-gold-600">{{ auth()->user()->name }}</span>
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">Ready to order your favorite meal today?</p>
                    </div>
                    <a href="{{ route('menu') }}" class="group relative bg-gradient-to-r from-gold-600 to-gold-500 text-royal-900 px-8 py-3.5 rounded-2xl font-bold uppercase tracking-wide text-sm hover:shadow-[0_0_30px_rgba(212,175,55,0.4)] transition-all transform hover:-translate-y-1 flex items-center gap-2">
                        <i class="fas fa-utensils group-hover:rotate-12 transition-transform"></i> Order Now
                    </a>
                </div>
            </div>

            <!-- 2. Quick Stats (كروت بتأثير Glassmorphism) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <!-- Card 1 -->
                <div class="bg-white/60 dark:bg-royal-900/40 backdrop-blur-lg rounded-2xl p-6 border border-gray-200/50 dark:border-gold-500/10 hover:border-gold-500/40 dark:hover:border-gold-500/40 transition-all duration-300 group">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-shopping-bag text-blue-500 text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Orders</p>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">12</h3>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white/60 dark:bg-royal-900/40 backdrop-blur-lg rounded-2xl p-6 border border-gray-200/50 dark:border-gold-500/10 hover:border-gold-500/40 dark:hover:border-gold-500/40 transition-all duration-300 group">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-green-100 dark:bg-green-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-star text-green-500 text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Loyalty Points</p>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">450</h3>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white/60 dark:bg-royal-900/40 backdrop-blur-lg rounded-2xl p-6 border border-gray-200/50 dark:border-gold-500/10 hover:border-gold-500/40 dark:hover:border-gold-500/40 transition-all duration-300 group">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-purple-100 dark:bg-purple-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-heart text-purple-500 text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Favorite Dishes</p>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">5</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Recommended Meals -->
            <div class="mb-10">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-serif text-gray-800 dark:text-white">Recommended for You</h2>
                    <a href="{{ route('menu') }}" class="text-sm font-bold text-gold-600 hover:text-gold-500 uppercase tracking-wider transition-colors">View Menu →</a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach(\App\Models\Meal::with('category')->inRandomOrder()->take(4)->get() as $meal)
                    <div class="group relative bg-white/60 dark:bg-royal-900/40 backdrop-blur-lg rounded-2xl overflow-hidden border border-gray-200/50 dark:border-gold-500/10 hover:border-gold-500/40 dark:hover:border-gold-500/40 shadow-sm hover:shadow-xl dark:hover:shadow-[0_0_30px_rgba(212,175,55,0.15)] transition-all duration-300">

                        <!-- Image -->
                        <div class="relative h-40 overflow-hidden bg-gray-100 dark:bg-royal-800">
                            @if($meal->image_url)
                                <img src="{{ $meal->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="flex items-center justify-center h-full"><i class="fas fa-utensils text-gray-400 text-2xl"></i></div>
                            @endif
                            <!-- Gradient Overlay for Text readability -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <!-- Content -->
                        <div class="p-4 relative">
                            <h3 class="font-serif text-lg text-gray-800 dark:text-white truncate group-hover:text-gold-500 transition-colors">{{ $meal->name }}</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 mb-2">{{ $meal->category->name }}</p>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-lg font-bold text-gold-600 dark:text-gold-500">${{ number_format($meal->price, 2) }}</p>
                                <a href="{{ route('menu') }}" class="w-8 h-8 rounded-full bg-gold-500/10 text-gold-500 flex items-center justify-center hover:bg-gold-500 hover:text-royal-900 transition-colors">
                                    <i class="fas fa-plus text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- 4. Account Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Edit Profile -->
                <a href="{{ route('profile.edit') }}" class="group bg-white/60 dark:bg-royal-900/40 backdrop-blur-lg rounded-2xl p-6 border border-gray-200/50 dark:border-gold-500/10 hover:border-gold-500/40 transition-all duration-300 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gold-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-user-cog text-gold-500 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 dark:text-white group-hover:text-gold-500 transition-colors">Edit Profile</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Update your personal information</p>
                    </div>
                </a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full group bg-white/60 dark:bg-royal-900/40 backdrop-blur-lg rounded-2xl p-6 border border-gray-200/50 dark:border-red-500/10 hover:border-red-500/40 transition-all duration-300 flex items-center gap-4 text-left">
                        <div class="w-14 h-14 rounded-2xl bg-red-100 dark:bg-red-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-sign-out-alt text-red-500 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 dark:text-white group-hover:text-red-500 transition-colors">Logout</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Sign out of your account</p>
                        </div>
                    </button>
                </form>
            </div>

        </div>
    </div>

</x-layouts.app>