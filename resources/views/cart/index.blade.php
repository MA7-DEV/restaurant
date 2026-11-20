<x-layouts.app title="Your Cart - GustoBite">
    <div class="min-h-screen bg-cream dark:bg-royal-800 py-12">
        <div class="container mx-auto px-4 md:px-6">
            <h1 class="text-3xl font-serif text-brown dark:text-white mb-8">Your Cart</h1>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Items -->
                    <div class="lg:col-span-2 space-y-4">
                        @foreach(session('cart') as $id => $item)
                        <div class="bg-white dark:bg-royal-900 p-4 rounded-xl border border-gold-500/10 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                @if($item['image'])
                                    <img src="{{ $item['image'] }}" class="w-16 h-16 rounded-lg object-cover">
                                @else
                                    <div class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center"><i class="fas fa-utensils text-gray-400"></i></div>
                                @endif
                                <div>
                                    <h3 class="font-bold text-brown dark:text-white">{{ $item['name'] }}</h3>
                                    <p class="text-sm text-gold-600">${{ number_format($item['price'], 2) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <!-- ✅ فورم التحديث (AJAX) -->
                                <form onsubmit="updateCart(event, {{ $id }})" class="flex items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="meal_id" value="{{ $id }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 px-2 py-1 border rounded-lg text-center">
                                </form>

                                <!-- ✅ زرار الحذف (AJAX) -->
                                <form onsubmit="removeItem(event, {{ $id }})">
                                    @csrf
                                    <input type="hidden" name="meal_id" value="{{ $id }}">
                                    <button type="submit" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Summary -->
                    <div class="bg-white dark:bg-royal-900 p-6 rounded-xl border border-gold-500/10 h-fit">
                        <h3 class="text-xl font-serif text-brown dark:text-white mb-4">Order Summary</h3>
                        <div class="flex justify-between font-bold text-lg mb-6">
                            <span class="text-gray-600 dark:text-gray-300">Total:</span>
                            <span class="text-gold-500">${{ number_format($total, 2) }}</span>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="block w-full text-center bg-gradient-to-r from-gold-600 to-gold-500 text-royal-900 py-3 rounded-xl font-bold hover:shadow-lg transition-all">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            @else
                <div class="text-center py-20">
                    <i class="fas fa-shopping-cart text-6xl text-gold-500/20 mb-4"></i>
                    <h2 class="text-2xl font-serif text-brown dark:text-white mb-2">Your cart is empty</h2>
                    <a href="{{ route('menu') }}" class="text-gold-500 hover:underline">Go back to menu</a>
                </div>
            @endif
        </div>
    </div>

    <!-- ✅ JavaScript (AJAX) -->
    <script>
        function updateCart(event, mealId) {
            event.preventDefault();

            const form = event.target;
            const quantity = form.querySelector('input[name="quantity"]').value;

            fetch('{{ route('cart.update') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ meal_id: mealId, quantity: parseInt(quantity) })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            })
            .catch(err => console.error(err));
        }

        function removeItem(event, mealId) {
            event.preventDefault();

            fetch('{{ route('cart.remove') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ meal_id: mealId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            })
            .catch(err => console.error(err));
        }
    </script>

</x-layouts.app>