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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-cream text-brown dark:bg-royal-800 dark:text-white font-sans antialiased transition-colors duration-300 selection:bg-gold-500 selection:text-royal-900">

    <x-partials.navbar />

    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <x-partials.footer />

    <!-- ✅ Global Notification Script (عشان الرسايل تظهر) -->
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