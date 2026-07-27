// import './bootstrap';
import anime from 'animejs';

document.addEventListener('DOMContentLoaded', () => {
    // Initial hide for animation targets
    const targets = document.querySelectorAll('.animate-hero, .animate-card');
    targets.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
    });

    const observer = new IntersectionObserver((entries, observer) => {
        // We'll group elements that enter at the same time to stagger them
        const enteredHeroes = [];
        const enteredCards = [];

        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('animate-hero')) {
                    enteredHeroes.push(entry.target);
                } else if (entry.target.classList.contains('animate-card')) {
                    enteredCards.push(entry.target);
                }
                observer.unobserve(entry.target); // Only animate once
            }
        });

        if (enteredHeroes.length > 0) {
            anime({
                targets: enteredHeroes,
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 1200,
                easing: 'easeOutQuart',
                delay: anime.stagger(150)
            });
        }

        if (enteredCards.length > 0) {
            anime({
                targets: enteredCards,
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 1000,
                easing: 'easeOutCubic',
                delay: anime.stagger(150, {start: 200}) // slightly delay cards after heroes
            });
        }
    }, {
        root: null,
        rootMargin: '0px 0px -50px 0px',
        threshold: 0.1
    });

    targets.forEach(el => observer.observe(el));
});
