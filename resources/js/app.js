import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Custom JS for restaurant
document.addEventListener('DOMContentLoaded', function() {
    // Add floating animation to logo
    const logo = document.querySelector('.restaurant-logo');
    if (logo) {
        logo.classList.add('animate-float');
    }
});