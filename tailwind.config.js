import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
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
                cream: '#FAF7F2', // للوضع الفاتح
                brown: '#2C1810', // للنصوص في الوضع الفاتح
            },
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', 'serif'],
            },
        },
    },
    plugins: [],
};