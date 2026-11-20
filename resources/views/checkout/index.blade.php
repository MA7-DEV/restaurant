<x-layouts.app title="Checkout - GustoBite">
    <div class="min-h-screen bg-cream dark:bg-royal-800 py-12">
        <div class="container mx-auto px-4 md:px-6">
            <h1 class="text-4xl font-serif text-brown dark:text-white mb-8 text-center">Checkout</h1>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Summary -->
                    <div class="w-full lg:w-1/3 order-2 lg:order-1">
                        <div class="bg-white dark:bg-royal-900 p-6 rounded-xl border border-gold-500/10 sticky top-24">
                            <h3 class="text-xl font-serif text-brown dark:text-white mb-4">Order Summary</h3>
                            @foreach(session('cart') as $item)
                            <div class="flex justify-between text-sm py-2 border-b border-gray-100 dark:border-royal-800">
                                <span class="text-gray-800 dark:text-white">{{ $item['name'] }} x{{ $item['quantity'] }}</span>
                                <span class="font-bold text-gold-600">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                            @endforeach
                            <div class="flex justify-between font-bold text-lg mt-4">
                                <span class="text-gray-600 dark:text-gray-300">Total:</span>
                                <span class="text-gold-500">${{ number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], session('cart', []))), 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <div class="w-full lg:w-2/3 order-1 lg:order-2">
                        <div class="bg-white dark:bg-royal-900 p-6 md:p-8 rounded-xl border border-gold-500/10">
                            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-5">
                                @csrf
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Delivery Address</label>
                                    <input type="text" name="address" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-royal-700 bg-gray-50 dark:bg-royal-800 text-gray-800 dark:text-white focus:border-gold-500 focus:ring-0">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Phone Number</label>
                                    <input type="text" name="phone" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-royal-700 bg-gray-50 dark:bg-royal-800 text-gray-800 dark:text-white focus:border-gold-500 focus:ring-0">
                                </div>
                                <button type="submit" class="w-full bg-gradient-to-r from-gold-600 to-gold-500 text-royal-900 py-4 rounded-xl font-bold uppercase tracking-widest text-sm hover:shadow-lg transition-all">
                                    Place Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-20">
                    <h2 class="text-2xl text-gray-500">Your cart is empty</h2>
                    <a href="{{ route('menu') }}" class="text-gold-500 hover:underline mt-4 block">Go back to menu</a>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>