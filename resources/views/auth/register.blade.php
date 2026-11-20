<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Account - GustoBite Luxury</title>

    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .glass-panel {
            background: rgba(10, 10, 10, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }
        .bg-zoom {
            animation: zoomIn 20s ease-in-out infinite alternate;
        }
        @keyframes zoomIn {
            from { transform: scale(1); }
            to { transform: scale(1.1); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden font-sans">

    <!-- الخلفية -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=2074&auto=format&fit=crop"
             class="w-full h-full object-cover bg-zoom" alt="Luxury Restaurant">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-black/80"></div>
    </div>

    <!-- الكارت -->
    <div class="relative z-10 w-full max-w-md mx-4 my-8 animate-fade-in-up">
        <div class="glass-panel rounded-3xl p-8 md:p-10 shadow-2xl">

            <!-- اللوجو -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 rounded-full border border-gold-500/50 flex items-center justify-center mx-auto mb-4 bg-gold-500/10 shadow-[0_0_20px_rgba(212,175,55,0.2)]">
                    <i class="fas fa-user-plus text-gold-500 text-2xl"></i>
                </div>
                <h2 class="text-3xl font-serif text-white mb-2">Join Us</h2>
                <p class="text-gold-500 text-xs tracking-[0.2em] uppercase">Create Your Account</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- الاسم -->
                <div>
                    <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-2">Full Name</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gold-500/50"></i>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full pl-11 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-gold-500 focus:bg-white/10 focus:ring-0 transition-all text-sm">
                    </div>
                    @error('name') <span class="text-red-400 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                </div>

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

                <!-- تأكيد الباسورد -->
                <div>
                    <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-2">Confirm Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gold-500/50"></i>
                        <input type="password" name="password_confirmation" required
                            class="w-full pl-11 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-gold-500 focus:bg-white/10 focus:ring-0 transition-all text-sm">
                    </div>
                </div>

                <!-- زر التسجيل -->
                <button type="submit" class="w-full bg-gradient-to-r from-gold-600 to-gold-500 text-royal-900 py-3 rounded-xl font-bold tracking-widest uppercase text-xs hover:shadow-[0_0_25px_rgba(212,175,55,0.5)] transition-all transform hover:-translate-y-0.5 mt-4">
                    Create Account
                </button>
            </form>

            <!-- لينك الدخول -->
            <p class="text-center text-xs text-gray-400 mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-gold-500 font-semibold hover:text-gold-400">Sign In</a>
            </p>
        </div>
    </div>

</body>
</html>