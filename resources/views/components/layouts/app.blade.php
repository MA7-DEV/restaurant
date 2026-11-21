<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'GustoBite | Luxury Dining' }}</title>

    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- ✅ Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        royal: {
                            50: '#F9F9F9', 100: '#E5E5E5', 200: '#C8C8C8', 300: '#A0A0A0',
                            400: '#666666', 500: '#333333', 600: '#222222', 700: '#111111',
                            800: '#0A0A0A', 900: '#050505',
                        },
                        gold: {
                            300: '#F3E5AB', 400: '#E6C200', 500: '#D4AF37', 600: '#B8860B', 700: '#8B6508',
                        },
                        cream: '#FAF7F2',
                        brown: '#2C1810',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                },
            },
        }
    </script>

    <!-- ✅ Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        /* Custom animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
    </style>
</head>
<body class="bg-cream text-brown dark:bg-royal-800 dark:text-white font-sans antialiased transition-colors duration-300 selection:bg-gold-500 selection:text-royal-900">

    <x-partials.navbar />

    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <x-partials.footer />

    <!-- ✅ Global Notification Script -->
    <script>
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

</body>
</html>