<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - GustoBite</title>

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

        .card-customer {
            background: white;
            border-radius: 16px;
            border: 1px solid rgba(212, 165, 116, 0.2);
            box-shadow: 0 4px 20px rgba(44, 24, 16, 0.05);
            transition: all 0.3s ease;
        }

        .card-customer:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(44, 24, 16, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #4A7C59);
            color: white;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(44, 85, 48, 0.3);
        }

        .btn-secondary {
            background: white;
            border: 2px solid var(--secondary);
            color: var(--secondary);
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--secondary);
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#2C5530] to-[#6BAF6B] flex items-center justify-center">
                        <i class="fas fa-utensils text-white"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-xl text-gray-800">GustoBite</h1>
                        <p class="text-sm text-gray-500">Welcome, {{ Auth::user()->name }}</p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#2C5530]">
                        <i class="fas fa-home mr-2"></i>
                        Home
                    </a>

                    <a href="{{ route('menu') }}" class="text-gray-700 hover:text-[#2C5530]">
                        <i class="fas fa-utensils mr-2"></i>
                        Menu
                    </a>

                    <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-[#2C5530]">
                        <i class="fas fa-user mr-2"></i>
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-[#FAF7F2] to-[#FFF9F0] rounded-2xl p-8 border border-[#E8C39E]/30 mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-3xl font-bold text-[#2C1810] mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-gray-600">Enjoy a unique dining experience with us</p>
                </div>
                <div class="w-16 h-16 rounded-full bg-gradient-to-r from-[#D4A574] to-[#E8C39E] flex items-center justify-center shadow-lg">
                    <i class="fas fa-user text-2xl text-white"></i>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('menu') }}" class="card-customer p-6 text-center">
                <div class="w-14 h-14 rounded-full bg-gradient-to-r from-[#2C5530]/10 to-[#6BAF6B]/10 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-utensils text-2xl text-[#2C5530]"></i>
                </div>
                <h3 class="font-bold text-lg text-[#2C1810] mb-2">Browse Menu</h3>
                <p class="text-sm text-gray-600">Discover our wide selection of dishes</p>
            </a>

            <a href="{{ route('profile.edit') }}" class="card-customer p-6 text-center">
                <div class="w-14 h-14 rounded-full bg-gradient-to-r from-[#D4A574]/10 to-[#E8C39E]/10 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-edit text-2xl text-[#D4A574]"></i>
                </div>
                <h3 class="font-bold text-lg text-[#2C1810] mb-2">Edit Profile</h3>
                <p class="text-sm text-gray-600">Update your personal information</p>
            </a>

            <div class="card-customer p-6 text-center">
                <div class="w-14 h-14 rounded-full bg-gradient-to-r from-[#C41E3A]/10 to-[#D9455D]/10 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-history text-2xl text-[#C41E3A]"></i>
                </div>
                <h3 class="font-bold text-lg text-[#2C1810] mb-2">Order History</h3>
                <p class="text-sm text-gray-600">View all your previous orders</p>
                <span class="inline-block mt-2 text-xs bg-gray-100 px-3 py-1 rounded-full">Coming Soon</span>
            </div>
        </div>

        <!-- Recent Orders (Placeholder) -->
        <div class="card-customer p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-[#2C1810]">Recent Orders</h2>
                <a href="#" class="text-[#2C5530] text-sm font-medium">View All</a>
            </div>

            <div class="text-center py-8">
                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shopping-cart text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-700 mb-2">No Previous Orders</h3>
                <p class="text-gray-500 mb-6">You haven't placed any orders yet</p>
                <a href="{{ route('menu') }}" class="btn-primary inline-flex items-center gap-2">
                    <i class="fas fa-utensils"></i>
                    Start Shopping Now
                </a>
            </div>
        </div>

        <!-- Features -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="card-customer p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                        <i class="fas fa-shipping-fast text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-[#2C1810]">Fast Delivery</h3>
                        <p class="text-sm text-gray-500">Delivery within 30 minutes</p>
                    </div>
                </div>
                <p class="text-gray-600">We guarantee your order arrives hot and fresh in the shortest possible time.</p>
            </div>

            <div class="card-customer p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-star text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-[#2C1810]">Quality Guaranteed</h3>
                        <p class="text-sm text-gray-500">Best Ingredients</p>
                    </div>
                </div>
                <p class="text-gray-600">We use only fresh, high-quality ingredients in all our dishes.</p>
            </div>
        </div>

        <!-- Special Offers -->
        <div class="mt-8 p-6 bg-gradient-to-r from-[#2C5530] to-[#6BAF6B] rounded-2xl text-white">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Special Offers!</h2>
                    <p class="opacity-90">Get 20% off your first order using code: WELCOME20</p>
                </div>
                <button onclick="copyCouponCode()" class="btn-secondary bg-white text-[#2C5530] hover:bg-gray-100 whitespace-nowrap">
                    <i class="fas fa-ticket-alt mr-2"></i>
                    Copy Code
                </button>
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
                    <a href="#" class="text-[#2C5530] hover:text-[#1e3a23]">Terms & Conditions</a>
                    <span class="mx-2">•</span>
                    <a href="#" class="text-[#2C5530] hover:text-[#1e3a23]">Privacy Policy</a>
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

    <script>
        // Copy coupon code
        function copyCouponCode() {
            const code = 'WELCOME20';
            navigator.clipboard.writeText(code).then(() => {
                alert('Code copied: ' + code);
            });
        }

        // Add hover animations
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card-customer');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>