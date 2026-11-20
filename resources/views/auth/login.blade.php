<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign In - GustoBite Luxury</title>

    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* تأثير الزجاج */
        .glass-panel {
            background: rgba(10, 10, 10, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }
        .light .glass-panel {
            background: rgba(250, 247, 242, 0.85);
            border: 1px solid rgba(212, 175, 55, 0.4);
        }
        /* حركة الخلفية */
        .bg-zoom {
            animation: zoomIn 20s ease-in-out infinite alternate;
        }
        @keyframes zoomIn {
            from { transform: scale(1); }
            to { transform: scale(1.1); }
        }
        /* Custom Luxury Checkbox */
        .luxury-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border: 1px solid rgba(212, 175, 55, 0.4);
            border-radius: 4px;
            background: transparent;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            display: inline-block;
            vertical-align: middle;
        }
        .luxury-checkbox:checked {
            background: linear-gradient(135deg, #D4AF37, #B8860B);
            border-color: #D4AF37;
        }
        .luxury-checkbox:checked::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: #0A0A0A;
            font-size: 12px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .luxury-checkbox:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden font-sans">

    <!-- الخلفية -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1514933651103-005eec06c04b?q=80&w=2074&auto=format&fit=crop"
             class="w-full h-full object-cover bg-zoom" alt="Luxury Restaurant">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-black/80"></div>
    </div>

    <!-- الكارت -->
    <div class="relative z-10 w-full max-w-md mx-4 animate-fade-in-up">
        <div class="glass-panel rounded-3xl p-8 md:p-10 shadow-2xl">

            <!-- اللوجو -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 rounded-full border border-gold-500/50 flex items-center justify-center mx-auto mb-4 bg-gold-500/10 shadow-[0_0_20px_rgba(212,175,55,0.2)]">
                    <i class="fas fa-utensils text-gold-500 text-2xl"></i>
                </div>
                <h2 class="text-3xl font-serif text-white mb-2">Welcome Back</h2>
                <p class="text-gold-500 text-xs tracking-[0.2em] uppercase">GustoBite Luxury</p>
            </div>

            <!-- رسائل الحالة -->
            @if (session('status'))
                <div class="bg-gold-500/10 border border-gold-500/30 text-gold-300 p-3 rounded-lg text-xs text-center mb-6">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- الإيميل -->
                <div>
                    <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-2">Email</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gold-500/50"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-11 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-gold-500 focus:bg-white/10 focus:ring-0 transition-all text-sm">
                    </div>
                    @error('email') <span class="text-red-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- الباسورد -->
                <div>
                    <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-2">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gold-500/50"></i>
                        <input type="password" name="password" required
                            class="w-full pl-11 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-gold-500 focus:bg-white/10 focus:ring-0 transition-all text-sm">
                    </div>
                    @error('password') <span class="text-red-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- تذكرني + نسيت الباسورد -->
                <div class="flex justify-between items-center">
                    <label for="remember_me" class="flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" name="remember" class="luxury-checkbox">
                        <span class="ml-3 text-xs text-gray-400 group-hover:text-gold-500 transition-colors">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs text-gold-500 hover:text-gold-400 transition-colors">Forgot password?</a>
                    @endif
                </div>

                <!-- زر الدخول -->
                <button type="submit" class="w-full bg-gradient-to-r from-gold-600 to-gold-500 text-royal-900 py-3 rounded-xl font-bold tracking-widest uppercase text-xs hover:shadow-[0_0_25px_rgba(212,175,55,0.5)] transition-all transform hover:-translate-y-0.5 mt-4">
                    Sign In
                </button>
            </form>

            <!-- لينك التسجيل -->
            <p class="text-center text-xs text-gray-400 mt-6">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-gold-500 font-semibold hover:text-gold-400">Create one</a>
            </p>
        </div>
    </div>

</body>
</html>