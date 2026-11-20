/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'restaurant-brown': {
                    50: '#FAF7F2',
                    100: '#F5EFE6',
                    200: '#E8C39E',
                    300: '#D4A574',
                    400: '#C8955C',
                    500: '#BC8A53',
                    600: '#A87949',
                },
                'restaurant-green': {
                    50: '#F0F7F0',
                    300: '#A6CFA6',
                    600: '#2C5530',
                },
                'restaurant-red': {
                    300: '#F5AEB9',
                    600: '#C41E3A',
                }
            },
            backgroundImage: {
                'gradient-restaurant': 'linear-gradient(135deg, #FAF7F2 0%, #F5EFE6 100%)',
                'gradient-gold': 'linear-gradient(to right, #D4A574, #E8C39E)',
                'gradient-card': 'linear-gradient(to bottom right, rgba(255,255,255,0.9), rgba(250,247,242,0.8))',
            }
        }
    }
}