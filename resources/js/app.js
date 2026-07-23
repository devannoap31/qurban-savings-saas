// import './bootstrap';
import anime from 'animejs';

// Global init for simple animations
document.addEventListener('DOMContentLoaded', () => {
    // Fade in up for hero sections
    if (document.querySelector('.animate-hero')) {
        anime({
            targets: '.animate-hero',
            translateY: [30, 0],
            opacity: [0, 1],
            duration: 1000,
            easing: 'easeOutExpo',
            delay: anime.stagger(150)
        });
    }

    // Stagger for cards
    if (document.querySelector('.animate-card')) {
        anime({
            targets: '.animate-card',
            translateY: [20, 0],
            opacity: [0, 1],
            duration: 800,
            easing: 'easeOutCubic',
            delay: anime.stagger(100)
        });
    }
});
