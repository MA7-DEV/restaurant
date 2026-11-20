<x-layouts.app title="Our Menu - GustoBite">

    <!-- Page Header -->
    <div class="bg-royal-900 py-16 md:py-24 text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-gold-500 rounded-full blur-[100px]"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-gold-500 rounded-full blur-[100px]"></div>
        </div>
        <div class="relative z-10 px-4 animate-fade-in-up">
            <h1 class="font-serif text-4xl md:text-6xl text-white mb-4">Our <span class="text-gold-500 italic">Menu</span></h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-sm md:text-base">Explore our carefully crafted selection of dishes, prepared with the finest ingredients.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-cream dark:bg-royal-800 py-12 md:py-16 transition-colors duration-300 min-h-screen">
        <div class="container mx-auto px-4 md:px-6">

            <!-- Categories Filter -->
            <div class="mb-10 md:mb-16 animate-fade-in-up delay-100">
                <div class="flex flex-wrap justify-center gap-3 md:gap-4">
                    <a href="{{ route('menu') }}" class="px-6 py-2.5 md:px-8 md:py-3 rounded-full border text-sm font-semibold transition-all duration-300
                       {{ !request('category') ? 'bg-gold-500 border-gold-500 text-royal-900 shadow-[0_0_20px_rgba(212,175,55,0.4)] scale-105' : 'bg-transparent border-gold-500/30 text-brown dark:text-gray-300 hover:border-gold-500 hover:text-gold-500 hover:scale-105' }}">
                        All Dishes
                    </a>

                    @foreach($categories as $category)
                    <a href="{{ route('menu', ['category' => $category->id]) }}" class="px-6 py-2.5 md:px-8 md:py-3 rounded-full border text-sm font-semibold transition-all duration-300 flex items-center gap-2
                       {{ request('category') == $category->id ? 'bg-gold-500 border-gold-500 text-royal-900 shadow-[0_0_20px_rgba(212,175,55,0.4)] scale-105' : 'bg-transparent border-gold-500/30 text-brown dark:text-gray-300 hover:border-gold-500 hover:text-gold-500 hover:scale-105' }}">
                        {{ $category->name }}
                        <span class="text-xs px-2 py-0.5 rounded-full {{ request('category') == $category->id ? 'bg-royal-900/20 text-royal-900' : 'bg-gold-500/10 text-gold-500' }}">
                            {{ $category->meals_count }}
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Meals Grid -->
            @if($meals->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                @foreach($meals as $meal)
                <div class="group bg-white dark:bg-royal-900 rounded-2xl overflow-hidden border border-gold-500/10 hover:border-gold-500/30 shadow-lg hover:shadow-[0_15px_40px_rgba(212,175,55,0.15)] transition-all duration-500 flex flex-col animate-fade-in-up delay-200">

                    <div class="relative h-48 md:h-56 overflow-hidden">
                        @if($meal->image_url)
                            <img src="{{ $meal->image_url }}" alt="{{ $meal->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-royal-800 to-royal-900 flex items-center justify-center">
                                <i class="fas fa-utensils text-4xl text-gold-500/30"></i>
                            </div>
                        @endif

                        <div class="absolute top-4 right-4">
                            @if($meal->is_available)
                                <span class="w-3 h-3 bg-green-500 rounded-full block shadow-[0_0_10px_rgba(34,197,94,0.6)]"></span>
                            @else
                                <span class="w-3 h-3 bg-red-500 rounded-full block shadow-[0_0_10px_rgba(239,68,68,0.6)]"></span>
                            @endif
                        </div>
                    </div>

                    <div class="p-5 md:p-6 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-serif text-xl text-brown dark:text-white group-hover:text-gold-500 transition-colors">{{ $meal->name }}</h3>
                            <span class="text-lg font-bold text-gold-600 dark:text-gold-500">${{ number_format($meal->price, 2) }}</span>
                        </div>

                        <p class="text-brown/60 dark:text-gray-400 text-sm mb-6 flex-1 line-clamp-2">
                            {{ $meal->description ?? 'A delicious dish prepared with the finest ingredients.' }}
                        </p>

                        <!-- ✅ منطق الزرار الذكي -->
                        @auth
                            @if(auth()->user()->isAdmin())
                                <!-- الأدمن ميشوفش زرار -->
                                <button disabled class="w-full py-3 rounded-xl border border-gray-300 dark:border-royal-700 text-gray-400 dark:text-gray-600 font-semibold cursor-not-allowed flex items-center justify-center gap-2">
                                    <i class="fas fa-user-shield"></i> Admin View
                                </button>
                            @else
                                <!-- العميل يشوف زرار الإضافة -->
                                <button onclick="addToCart({{ $meal->id }})"
                                        class="w-full py-3 rounded-xl border border-gold-500/30 text-gold-600 dark:text-gold-500 font-semibold hover:bg-gold-500 hover:text-royal-900 transition-all duration-300 flex items-center justify-center gap-2"
                                        {{ !$meal->is_available ? 'disabled' : '' }}>
                                    <i class="fas fa-cart-plus"></i>
                                    {{ $meal->is_available ? 'Add to Cart' : 'Unavailable' }}
                                </button>
                            @endif
                        @else
                            <!-- الزائر يتوجه للوجين -->
                            <a href="{{ route('login') }}"
                               class="w-full py-3 rounded-xl border border-gold-500/30 text-gold-600 dark:text-gold-500 font-semibold hover:bg-gold-500 hover:text-royal-900 transition-all duration-300 flex items-center justify-center gap-2 text-center">
                                <i class="fas fa-sign-in-alt"></i> Login to Order
                            </a>
                        @endauth
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-20 animate-fade-in-up">
                <div class="w-24 h-24 rounded-full bg-gold-500/10 flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-utensils text-gold-500 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-serif text-brown dark:text-white mb-2">No Meals Available</h3>
                <p class="text-brown/60 dark:text-gray-400">We are updating our menu. Please check back later.</p>
            </div>
            @endif
        </div>
    </div>

    <!-- JavaScript (خاص بس بضيف للسلة عن طريق السيرفر) -->
    <script>
        function addToCart(mealId) {
            fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ meal_id: mealId, quantity: 1 })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // تحديث العداد في الـ Navbar
                    const countEl = document.getElementById('cart-count');
                    const countElMobile = document.getElementById('cart-count-mobile');
                    if(countEl) { countEl.textContent = data.cart_count; countEl.style.display = 'flex'; }
                    if(countElMobile) { countElMobile.textContent = data.cart_count; countElMobile.style.display = 'flex'; }

                    showNotification(data.message);
                }
            })
            .catch(err => console.error(err));
        }

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed bottom-4 right-4 z-[200] px-6 py-3 rounded-xl shadow-2xl font-semibold text-sm transform transition-all duration-300 translate-y-10 opacity-0 ${
                type === 'success' ? 'bg-gold-500 text-royal-900' : 'bg-red-500 text-white'
            }`;
            notification.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>${message}`;
            document.body.appendChild(notification);
            setTimeout(() => notification.classList.remove('translate-y-10', 'opacity-0'), 10);
            setTimeout(() => {
                notification.classList.add('translate-y-10', 'opacity-0');
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
    </script>

</x-layouts.app>