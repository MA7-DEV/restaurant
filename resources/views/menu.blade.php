<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - GustoBite</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --primary: #2C5530;
            --secondary: #D4A574;
            --accent: #E8C39E;
            --light: #FAF7F2;
            --dark: #2C1810;
        }

        .card-meal {
            background: white;
            border-radius: 16px;
            border: 1px solid rgba(212, 165, 116, 0.2);
            box-shadow: 0 4px 20px rgba(44, 24, 16, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card-meal:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(44, 24, 16, 0.1);
        }

        .btn-order {
            background: linear-gradient(135deg, var(--primary), #4A7C59);
            color: white;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-order:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(44, 85, 48, 0.3);
        }

        .category-btn {
            background: white;
            border: 2px solid rgba(212, 165, 116, 0.3);
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 600;
            color: var(--dark);
            transition: all 0.3s ease;
        }

        .category-btn:hover, .category-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #EF4444;
            color: white;
            font-size: 12px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#2C5530] to-[#6BAF6B] flex items-center justify-center">
                        <i class="fas fa-utensils text-white"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xl text-gray-800">GustoBite</h1>
                        <p class="text-sm text-gray-500">Fine Dining Experience</p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#2C5530]">
                        <i class="fas fa-home mr-2"></i>
                        Home
                    </a>

                    <a href="{{ route('menu') }}" class="text-[#2C5530] font-bold">
                        <i class="fas fa-utensils mr-2"></i>
                        Menu
                    </a>

                    @auth
                        <a href="{{ route('customer.dashboard') }}" class="text-gray-700 hover:text-[#2C5530]">
                            <i class="fas fa-user mr-2"></i>
                            My Account
                        </a>

                        <!-- Cart Icon -->
                        <div class="relative">
                            <a href="#" onclick="openCartModal()" class="text-gray-700 hover:text-[#2C5530]">
                                <i class="fas fa-shopping-cart"></i>
                                <span id="cart-count" class="cart-badge">0</span>
                            </a>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-[#2C5530]">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login
                        </a>

                        <a href="{{ route('register') }}" class="bg-[#2C5530] text-white px-4 py-2 rounded-lg hover:bg-[#1e3a23]">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Our Menu</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Choose from our wide selection of delicious dishes, carefully prepared from the freshest ingredients.</p>
        </div>

        <!-- Categories Filter -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Categories</h2>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('menu') }}" class="category-btn {{ request()->routeIs('menu') && !request()->segment(2) ? 'active' : '' }}">
                    <i class="fas fa-utensils mr-2"></i>
                    All
                </a>

                @foreach($categories as $category)
                <a href="{{ route('category.filter', $category->id) }}"
                   class="category-btn {{ request()->routeIs('category.filter') && request()->segment(2) == $category->id ? 'active' : '' }}">
                    <i class="fas fa-tag mr-2"></i>
                    {{ $category->name }}
                    <span class="ml-2 text-xs bg-gray-100 px-2 py-1 rounded-full">{{ $category->meals_count }}</span>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Meals Grid -->
        @if($meals->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($meals as $meal)
            <div class="card-meal">
                <!-- Meal Image -->
                @if($meal->image)
                <img src="{{ asset('storage/' . $meal->image) }}"
                     alt="{{ $meal->name }}"
                     class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gradient-to-r from-[#2C5530] to-[#6BAF6B] flex items-center justify-center">
                    <i class="fas fa-utensils text-white text-4xl"></i>
                </div>
                @endif

                <!-- Meal Content -->
                <div class="p-6">
                    <!-- Category Badge -->
                    <span class="inline-block px-3 py-1 bg-[#2C5530]/10 text-[#2C5530] text-xs font-semibold rounded-full mb-3">
                        {{ $meal->category->name }}
                    </span>

                    <!-- Meal Name & Price -->
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="font-bold text-lg text-gray-800">{{ $meal->name }}</h3>
                        <span class="text-xl font-bold text-[#D4A574]">${{ number_format($meal->price, 2) }}</span>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-600 mb-4 text-sm">
                        {{ Str::limit($meal->description, 100) }}
                    </p>

                    <!-- Availability -->
                    <div class="flex items-center justify-between">
                        @if($meal->is_available)
                        <span class="inline-flex items-center text-green-600 text-sm">
                            <i class="fas fa-check-circle mr-2"></i>
                            Available
                        </span>
                        @else
                        <span class="inline-flex items-center text-red-600 text-sm">
                            <i class="fas fa-times-circle mr-2"></i>
                            Unavailable
                        </span>
                        @endif

                        <!-- Order Button -->
                        <button onclick="addToCart({{ $meal->id }}, '{{ $meal->name }}', {{ $meal->price }})"
                                class="btn-order">
                            <i class="fas fa-cart-plus"></i>
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-utensils text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-700 mb-2">No Meals Available</h3>
            <p class="text-gray-500">No meals are available in this category at the moment.</p>
        </div>
        @endif
    </div>

    <!-- Cart Modal -->
    <div id="cart-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Shopping Cart</h3>
                <button onclick="closeCartModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div id="cart-items" class="mb-6 max-h-64 overflow-y-auto">
                <!-- Cart items will be displayed here -->
            </div>

            <div class="border-t pt-4">
                <div class="flex justify-between items-center mb-4">
                    <span class="font-semibold text-gray-700">Total:</span>
                    <span id="cart-total" class="text-xl font-bold text-[#D4A574]">$0.00</span>
                </div>

                <div class="flex gap-3">
                    <button onclick="closeCartModal()" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 font-medium">
                        Continue Shopping
                    </button>
                    <button onclick="checkout()" class="flex-1 px-4 py-3 bg-[#2C5530] text-white rounded-lg hover:bg-[#1e3a23] font-medium">
                        Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12 py-8">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <p class="text-gray-600 text-sm">
                    &copy; {{ date('Y') }} GustoBite Restaurant. All rights reserved.
                    <span class="mx-2">•</span>
                    <a href="#" class="text-[#2C5530] hover:text-[#1e3a23]">Privacy Policy</a>
                    <span class="mx-2">•</span>
                    <a href="#" class="text-[#2C5530] hover:text-[#1e3a23]">Terms of Service</a>
                </p>
                <div class="flex justify-center space-x-4 mt-4">
                    <a href="#" class="text-gray-400 hover:text-[#2C5530]">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#2C5530]">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#2C5530]">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Cart functionality
        let cart = [];

        function addToCart(id, name, price) {
            // Check if item already exists in cart
            const existingItem = cart.find(item => item.id === id);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id,
                    name,
                    price,
                    quantity: 1
                });
            }

            updateCart();
            showNotification(`${name} added to cart!`);
        }

        function updateCart() {
            updateCartCount();
            updateCartModal();
        }

        function updateCartCount() {
            const countElement = document.getElementById('cart-count');
            if (countElement) {
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                countElement.textContent = totalItems;
            }
        }

        function updateCartModal() {
            const itemsContainer = document.getElementById('cart-items');
            const totalElement = document.getElementById('cart-total');

            if (cart.length === 0) {
                itemsContainer.innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-shopping-cart text-gray-300 text-4xl mb-4"></i>
                        <p class="text-gray-500">Your cart is empty</p>
                    </div>
                `;
                if (totalElement) totalElement.textContent = '$0.00';
            } else {
                let html = '<div class="space-y-4">';
                let total = 0;

                cart.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;

                    html += `
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">${item.name}</h4>
                            <p class="text-sm text-gray-600">$${item.price.toFixed(2)} each</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <button onclick="updateQuantity(${item.id}, -1)"
                                    class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center">
                                <i class="fas fa-minus text-xs"></i>
                            </button>
                            <span class="font-medium w-8 text-center">${item.quantity}</span>
                            <button onclick="updateQuantity(${item.id}, 1)"
                                    class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center">
                                <i class="fas fa-plus text-xs"></i>
                            </button>
                            <span class="font-bold text-[#D4A574] ml-4">$${itemTotal.toFixed(2)}</span>
                            <button onclick="removeFromCart(${item.id})"
                                    class="ml-2 text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    `;
                });

                html += '</div>';
                itemsContainer.innerHTML = html;

                if (totalElement) {
                    totalElement.textContent = `$${total.toFixed(2)}`;
                }
            }
        }

        function updateQuantity(id, change) {
            const item = cart.find(item => item.id === id);
            if (item) {
                item.quantity += change;

                // Remove item if quantity is 0 or less
                if (item.quantity <= 0) {
                    cart = cart.filter(item => item.id !== id);
                }

                updateCart();
            }
        }

        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            updateCart();
            showNotification('Item removed from cart');
        }

        function openCartModal() {
            updateCartModal();
            document.getElementById('cart-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeCartModal() {
            document.getElementById('cart-modal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function checkout() {
            if (cart.length === 0) {
                showNotification('Your cart is empty!', 'error');
                return;
            }

            showNotification('Checkout functionality coming soon!');
            // Here you would typically integrate with a payment gateway
            // For now, we'll just clear the cart
            cart = [];
            updateCart();
            closeCartModal();
        }

        function showNotification(message, type = 'success') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg font-medium ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;

            // Add to page
            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Initialize cart
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();

            // Close modal when clicking outside
            document.getElementById('cart-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeCartModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeCartModal();
                }
            });
        });
    </script>
</body>
</html>