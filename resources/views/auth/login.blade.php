<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GustoBite</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --primary: #2C5530;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Sign In</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2C5530] focus:border-[#2C5530] outline-none"
                           placeholder="you@example.com">
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2C5530] focus:border-[#2C5530] outline-none"
                           placeholder="••••••••">
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full bg-[#2C5530] text-white py-3 rounded-lg font-semibold hover:bg-[#1e3a23] transition">
                    Sign In
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('register') }}" class="text-[#2C5530] hover:text-[#1e3a23]">
                    Don't have an account? Sign up
                </a>
            </div>
        </div>
    </div>

    <script>
        // Debug CSRF token
        document.addEventListener('DOMContentLoaded', function() {
            const token = document.querySelector('input[name="_token"]');
            if (token) {
                console.log('✅ CSRF Token found:', token.value.substring(0, 20) + '...');
            } else {
                console.log('❌ CSRF Token NOT found!');
                alert('CSRF Token is missing!');
            }
        });
    </script>
</body>
</html>