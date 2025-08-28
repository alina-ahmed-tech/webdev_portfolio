/**
 * main.js
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
      anchor.addEventListener('click', function (e) {
        var target = document.querySelector(this.getAttribute('href'));
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth' });
        }
      });
    });
  });

  // --- Animate on scroll using IntersectionObserver
  (function animateOnScroll() {
    if ('IntersectionObserver' in window) {
      // auto-mark common elements to animate
      var selectors = ['h1','h2','h3','.lead','.card','.btn','.site-title','.navbar-brand','article header'];
      selectors.forEach(function (s) {
        document.querySelectorAll(s).forEach(function (el) {
          if (!el.hasAttribute('data-animate')) el.setAttribute('data-animate','fade-up');
        });
      });

      // stagger helper: if parent has data-stagger attribute, add per-child index as CSS var
      document.querySelectorAll('[data-stagger]').forEach(function (container) {
        Array.prototype.forEach.call(container.children, function (child, i) {
          child.style.setProperty('--stagger-index', i);
        });
      });

      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('in-view');
            // If want to animate once only:
            io.unobserve(entry.target);
          }
        });
      }, {
        root: null,
        rootMargin: '0px 0px -10% 0px',
        threshold: 0.12
      });

      document.querySelectorAll('[data-animate]').forEach(function (el) {
        io.observe(el);
      });
    } else {
      // fallback: reveal all immediately
      document.querySelectorAll('[data-animate]').forEach(function (el) {
        el.classList.add('in-view');
      });
    }
  })();


})();
