<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover Global Meals - GustoBite</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Poppins', sans-serif; }
        .category-pill { transition: all 0.3s ease; }
        .category-pill:hover, .category-pill.active { background-color: #2C5530; color: white; border-color: #2C5530; }
        .meal-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .meal-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="w-10 h-10 rounded-full bg-gradient-to-r from-[#2C5530] to-[#6BAF6B] flex items-center justify-center">
                        <i class="fas fa-utensils text-white"></i>
                    </a>
                    <div>
                        <h1 class="font-bold text-xl text-gray-800">GustoBite</h1>
                        <p class="text-sm text-gray-500">Global Discoveries</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#2C5530]"><i class="fas fa-home mr-2"></i>Home</a>
                    <a href="{{ route('menu') }}" class="text-gray-700 hover:text-[#2C5530]"><i class="fas fa-utensils mr-2"></i>Menu</a>
                    <a href="{{ route('discover') }}" class="text-[#2C5530] font-bold"><i class="fas fa-globe mr-2"></i>Discover</a>

                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-[#2C5530]"><i class="fas fa-user mr-2"></i>Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-[#2C5530]"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-10">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Discover Global Cuisines</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Explore meals from around the world powered by TheMealDB API. Admins can import meals directly to the restaurant menu.</p>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">{{ session('error') }}</div>
        @endif

        <!-- Categories Filter -->
        <div class="flex flex-wrap gap-3 justify-center mb-10">
            @foreach($categories as $cat)
                <a href="{{ route('discover', ['category' => $cat['strCategory']]) }}"
                   class="category-pill px-5 py-2 rounded-full border-2 border-gray-300 text-gray-700 font-semibold {{ $selectedCategory === $cat['strCategory'] ? 'active' : '' }}">
                    {{ $cat['strCategory'] }}
                </a>
            @endforeach
        </div>

        <!-- Meals Grid -->
        @if(count($meals) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($meals as $meal)
                    <div class="meal-card bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 flex flex-col">
                        <img src="{{ $meal['strMealThumb'] }}" alt="{{ $meal['strMeal'] }}" class="w-full h-48 object-cover">
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $meal['strMeal'] }}</h3>
                                <p class="text-sm text-gray-500 mb-4">Origin: {{ $selectedCategory }}</p>
                            </div>

                            @if(auth()->check() && auth()->user()->isAdmin())
                                <form action="{{ route('discover.import') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="meal_id" value="{{ $meal['idMeal'] }}">
                                    <button type="submit" class="w-full bg-[#D4A574] text-white px-4 py-2 rounded-lg hover:bg-[#BC8A53] transition-colors font-medium">
                                        <i class="fas fa-plus mr-1"></i> Import to Menu
                                    </button>
                                </form>
                            @else
                                <div class="text-sm text-gray-400 text-center italic">Login as Admin to Import</div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-search text-gray-300 text-5xl mb-4"></i>
                <h3 class="text-xl font-bold text-gray-700">No meals found</h3>
                <p class="text-gray-500">Try selecting a different category.</p>
            </div>
        @endif
    </div>

</body>
</html>