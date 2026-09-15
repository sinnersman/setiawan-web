// Full-site subtle motion: reveal-on-scroll, navbar shadow, smooth anchors, counters.
(function () {
    'use strict';

    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // ---------- 1. Reveal on scroll (.reveal -> .revealed) ----------
    var revealEls = document.querySelectorAll('.reveal');
    revealEls.forEach(function (el) {
        var delay = el.getAttribute('data-reveal-delay');
        if (delay !== null && delay !== '') {
            el.style.setProperty('--reveal-delay', Math.max(0, parseInt(delay, 10) || 0) + 'ms');
        }
    });

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        // Show everything immediately: no motion, no hidden content.
        revealEls.forEach(function (el) { el.classList.add('revealed'); });
    } else if (revealEls.length) {
        var revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });
        revealEls.forEach(function (el) { revealObserver.observe(el); });
    }

    // ---------- 2. Navbar shadow on scroll ----------
    var header = document.getElementById('site-header');
    if (header) {
        var onScroll = function () {
            header.classList.toggle('nav-scrolled', window.scrollY > 8);
        };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    // ---------- 3. Smooth anchor scroll with sticky-header offset ----------
    document.addEventListener('click', function (event) {
        var anchor = event.target.closest('a[href^="#"]');
        if (!anchor) return;
        var id = anchor.getAttribute('href');
        if (!id || id.length < 2) return;
        var target = document.querySelector(id);
        if (!target) return;
        event.preventDefault();
        var headerHeight = header ? header.offsetHeight : 64;
        var top = target.getBoundingClientRect().top + window.scrollY - headerHeight - 12;
        window.scrollTo({ top: Math.max(0, top), behavior: prefersReducedMotion ? 'auto' : 'smooth' });
        if (history.replaceState) history.replaceState(null, '', id);
    });

    // ---------- 4. Animated counters ([data-count-to]) ----------
    var counters = document.querySelectorAll('[data-count-to]');
    if (counters.length && !prefersReducedMotion && 'IntersectionObserver' in window) {
        var animateCounter = function (el) {
            var target = parseFloat(el.getAttribute('data-count-to')) || 0;
            var decimals = parseInt(el.getAttribute('data-count-decimals') || '0', 10);
            var suffix = el.getAttribute('data-count-suffix') || '';
            var duration = 1200;
            var start = null;
            var step = function (now) {
                if (!start) start = now;
                var progress = Math.min((now - start) / duration, 1);
                var eased = 1 - Math.pow(1 - progress, 3); // easeOutCubic
                el.textContent = (target * eased).toFixed(decimals) + suffix;
                if (progress < 1) requestAnimationFrame(step);
            };
            requestAnimationFrame(step);
        };
        var counterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(function (el) { counterObserver.observe(el); });
    } else {
        // Reduced motion or no IO: render final values instantly.
        counters.forEach(function (el) {
            var target = parseFloat(el.getAttribute('data-count-to')) || 0;
            var decimals = parseInt(el.getAttribute('data-count-decimals') || '0', 10);
            var suffix = el.getAttribute('data-count-suffix') || '';
            el.textContent = target.toFixed(decimals) + suffix;
        });
    }
})();
