<x-layouts.app title="Welcome to GustoBite Luxury">

    <!-- Hero Section with Background Image -->
    <div class="relative min-h-screen flex items-center justify-center overflow-hidden">

        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=2070&auto=format&fit=crop"
                 alt="Luxury Restaurant"
                 class="w-full h-full object-cover opacity-30 dark:opacity-40">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-cream/90 via-cream/70 to-cream dark:from-royal-900/80 dark:via-royal-900/60 dark:to-royal-900 transition-colors duration-300"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center px-4 md:px-6 max-w-5xl mx-auto pt-20 md:pt-24">

            <!-- Badge -->
            <div class="inline-block mb-4 md:mb-6 px-3 md:px-4 py-1 border border-gold-500/30 rounded-full bg-gold-500/5 backdrop-blur-sm animate-fade-in-up">
                <span class="text-gold-500 text-[10px] md:text-xs font-semibold tracking-[0.2em] md:tracking-[0.3em] uppercase">Welcome to GustoBite</span>
            </div>

            <!-- Heading -->
            <h1 class="font-serif text-4xl sm:text-5xl md:text-7xl lg:text-8xl text-brown dark:text-white mb-4 md:mb-6 leading-tight drop-shadow-2xl animate-fade-in-up delay-100 transition-colors duration-300">
                Experience <br class="hidden md:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-600 via-gold-500 to-gold-400 dark:from-gold-300 dark:via-gold-500 dark:to-gold-600 italic">True Luxury</span>
            </h1>

            <!-- Subtitle -->
            <p class="text-brown/70 dark:text-gray-300 text-base sm:text-lg md:text-xl mb-8 md:mb-12 max-w-2xl mx-auto font-light leading-relaxed animate-fade-in-up delay-200 transition-colors duration-300">
                Indulge in a culinary masterpiece where every ingredient tells a story.
                Reserve your table and savor the finest flavors crafted by our world-class chefs.
            </p>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 md:gap-6 mb-12 md:mb-16 animate-fade-in-up delay-300">
                <a href="{{ route('menu') }}" class="w-full sm:w-auto px-8 md:px-10 py-3 md:py-4 bg-gradient-to-r from-gold-600 to-gold-500 text-royal-900 font-bold uppercase tracking-widest text-xs md:text-sm rounded-full text-center hover:scale-105 hover:shadow-[0_0_40px_rgba(212,175,55,0.5)] transition-all">
                    Explore Our Menu
                </a>

                @guest
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 md:px-10 py-3 md:py-4 border border-gold-500/50 text-gold-600 dark:text-gold-500 font-bold uppercase tracking-widest text-xs md:text-sm rounded-full hover:bg-gold-500/10 transition-all text-center backdrop-blur-sm">
                    Reserve a Table
                </a>
                @endguest
            </div>

            <!-- Stats Row -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 md:gap-8 max-w-3xl mx-auto border-t border-gold-500/20 pt-8 animate-fade-in-up delay-300">
                <div class="text-center">
                    <h3 class="text-2xl md:text-3xl font-serif text-gold-600 dark:text-gold-500 mb-1">15+</h3>
                    <p class="text-[10px] md:text-xs text-brown/50 dark:text-gray-400 uppercase tracking-widest">Years of Excellence</p>
                </div>
                <div class="text-center sm:border-x border-gold-500/20">
                    <h3 class="text-2xl md:text-3xl font-serif text-gold-600 dark:text-gold-500 mb-1">50+</h3>
                    <p class="text-[10px] md:text-xs text-brown/50 dark:text-gray-400 uppercase tracking-widest">Signature Dishes</p>
                </div>
                <div class="text-center">
                    <h3 class="text-2xl md:text-3xl font-serif text-gold-600 dark:text-gold-500 mb-1">10k+</h3>
                    <p class="text-[10px] md:text-xs text-brown/50 dark:text-gray-400 uppercase tracking-widest">Happy Guests</p>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div id="about" class="py-16 md:py-24 bg-cream dark:bg-royal-900 relative transition-colors duration-300">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col md:flex-row items-center gap-10 md:gap-16">
                <div class="w-full md:w-1/2 relative">
                    <div class="absolute -inset-2 md:-inset-4 border border-gold-500/20 rounded-2xl transform rotate-3"></div>
                    <img src="https://images.unsplash.com/photo-1550966871-3ed3cdb5ed0c?q=80&w=2070&auto=format&fit=crop"
                         alt="Chef preparing food"
                         class="relative rounded-2xl shadow-2xl w-full h-[300px] md:h-[500px] object-cover">
                </div>

                <div class="w-full md:w-1/2">
                    <h2 class="font-serif text-3xl md:text-5xl text-brown dark:text-white mb-4 md:mb-6">
                        A Passion for <span class="text-gold-600 dark:text-gold-500">Perfection</span>
                    </h2>
                    <p class="text-brown/70 dark:text-gray-400 leading-relaxed mb-4 md:mb-6">
                        At GustoBite, we believe that dining is not just about food; it's about an experience.
                        Our chefs combine traditional techniques with modern innovation to create dishes that
                        tantalize your taste buds and leave a lasting impression.
                    </p>
                    <p class="text-brown/70 dark:text-gray-400 leading-relaxed mb-6 md:mb-8">
                        Every plate is a canvas, and every ingredient is carefully selected to ensure the highest
                        quality and freshness. Join us for a journey of culinary discovery.
                    </p>
                    <!-- ✅ اتغيرت من discover لـ menu -->
                    <a href="{{ route('menu') }}" class="inline-flex items-center text-gold-600 dark:text-gold-500 font-semibold hover:text-gold-500 dark:hover:text-gold-400 transition-colors">
                        Explore Our Menu <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Dishes Section -->
    <div class="py-16 md:py-24 bg-royal-900">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-10 md:mb-16">
                <h2 class="font-serif text-3xl md:text-4xl text-white mb-2 md:mb-4">Chef's <span class="text-gold-500">Specialties</span></h2>
                <p class="text-gray-400 text-sm md:text-base">Handpicked dishes that define our culinary identity.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                <!-- Dish 1 -->
                <div class="group relative overflow-hidden rounded-2xl cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=2069&auto=format&fit=crop" class="w-full h-64 md:h-80 object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-royal-900 via-transparent to-transparent opacity-80"></div>
                    <div class="absolute bottom-0 left-0 p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-serif text-white mb-1">Premium Wagyu Steak</h3>
                        <p class="text-gold-500 text-sm">$85.00</p>
                    </div>
                </div>
                <!-- Dish 2 -->
                <div class="group relative overflow-hidden rounded-2xl cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1551183053-bf91a1d81141?q=80&w=2032&auto=format&fit=crop" class="w-full h-64 md:h-80 object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-royal-900 via-transparent to-transparent opacity-80"></div>
                    <div class="absolute bottom-0 left-0 p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-serif text-white mb-1">Truffle Tagliatelle</h3>
                        <p class="text-gold-500 text-sm">$45.00</p>
                    </div>
                </div>
                <!-- Dish 3 -->
                <div class="group relative overflow-hidden rounded-2xl cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1551024506-0bccd828d307?q=80&w=2070&auto=format&fit=crop" class="w-full h-64 md:h-80 object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-royal-900 via-transparent to-transparent opacity-80"></div>
                    <div class="absolute bottom-0 left-0 p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-serif text-white mb-1">Gold Leaf Soufflé</h3>
                        <p class="text-gold-500 text-sm">$25.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="py-16 md:py-24 bg-cream dark:bg-royal-800 transition-colors duration-300">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-10 md:mb-16">
                <h2 class="font-serif text-3xl md:text-4xl text-brown dark:text-white mb-2 md:mb-4">What Our <span class="text-gold-600 dark:text-gold-500">Guests Say</span></h2>
                <p class="text-brown/60 dark:text-gray-400 text-sm md:text-base">Real experiences from our valued diners.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white dark:bg-royal-900 p-6 md:p-8 rounded-2xl border border-gold-500/10 shadow-sm relative">
                    <i class="fas fa-quote-left text-3xl text-gold-500/20 absolute top-6 right-6"></i>
                    <div class="flex text-gold-500 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-brown/70 dark:text-gray-300 text-sm md:text-base italic mb-6">"An absolutely unforgettable dining experience. The ambiance, the service, and the food were all beyond exceptional."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gold-500/20 flex items-center justify-center text-gold-500 font-bold">S</div>
                        <div>
                            <h4 class="text-brown dark:text-white font-semibold text-sm">Sarah Johnson</h4>
                            <p class="text-brown/50 dark:text-gray-500 text-xs">Food Critic</p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="bg-white dark:bg-royal-900 p-6 md:p-8 rounded-2xl border border-gold-500/10 shadow-sm relative">
                    <i class="fas fa-quote-left text-3xl text-gold-500/20 absolute top-6 right-6"></i>
                    <div class="flex text-gold-500 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-brown/70 dark:text-gray-300 text-sm md:text-base italic mb-6">"The Wagyu steak was cooked to perfection. I've never tasted anything like it. Highly recommended!"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gold-500/20 flex items-center justify-center text-gold-500 font-bold">M</div>
                        <div>
                            <h4 class="text-brown dark:text-white font-semibold text-sm">Michael Chen</h4>
                            <p class="text-brown/50 dark:text-gray-500 text-xs">Regular Guest</p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="bg-white dark:bg-royal-900 p-6 md:p-8 rounded-2xl border border-gold-500/10 shadow-sm relative">
                    <i class="fas fa-quote-left text-3xl text-gold-500/20 absolute top-6 right-6"></i>
                    <div class="flex text-gold-500 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="text-brown/70 dark:text-gray-300 text-sm md:text-base italic mb-6">"Beautiful atmosphere and exquisite food. Perfect for a romantic dinner or a special celebration."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gold-500/20 flex items-center justify-center text-gold-500 font-bold">E</div>
                        <div>
                            <h4 class="text-brown dark:text-white font-semibold text-sm">Emma Williams</h4>
                            <p class="text-brown/50 dark:text-gray-500 text-xs">Travel Blogger</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="relative py-20 md:py-32 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=2074&auto=format&fit=crop" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-royal-900/80"></div>
        </div>
        <div class="relative z-10 text-center px-4 md:px-6 max-w-3xl mx-auto">
            <h2 class="font-serif text-3xl md:text-5xl text-white mb-4 md:mb-6">Ready to Experience <span class="text-gold-500 italic">Excellence?</span></h2>
            <p class="text-gray-300 text-sm md:text-lg mb-8 md:mb-10">Book your table now and let us take you on a culinary journey you won't forget.</p>
            <a href="{{ route('register') }}" class="inline-block px-8 md:px-12 py-3 md:py-4 bg-gradient-to-r from-gold-600 to-gold-500 text-royal-900 font-bold uppercase tracking-widest text-xs md:text-sm rounded-full hover:scale-105 hover:shadow-[0_0_40px_rgba(212,175,55,0.5)] transition-all">
                Reserve Your Table
            </a>
        </div>
    </div>

</x-layouts.app>