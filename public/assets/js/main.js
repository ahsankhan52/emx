/**
 * Main JavaScript File
 * Handles shared functionality and intersection observer animations
 */

(function() {
  'use strict';

  const Main = {
    // Initialize all main functionality
    init: function() {
      this.initScrollAnimations();
      this.initSmoothScroll();
      this.updateActiveNavLink();
    },

    // Initialize Intersection Observer for scroll animations
    initScrollAnimations: function() {
      const animatedElements = document.querySelectorAll(
        '.service-card, .feature-item, .about-image, .location-map'
      );

      if (!('IntersectionObserver' in window)) {
        // Fallback for browsers without IntersectionObserver
        animatedElements.forEach(el => {
          el.classList.add('fade-in-up');
        });
        return;
      }

      const observerOptions = {
        root: null,
        rootMargin: '0px 0px -100px 0px',
        threshold: 0.1
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('fade-in-up');
            observer.unobserve(entry.target);
          }
        });
      }, observerOptions);

      animatedElements.forEach(el => {
        el.style.opacity = '0';
        observer.observe(el);
      });
    },

    // Initialize smooth scroll for anchor links
    initSmoothScroll: function() {
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          const href = this.getAttribute('href');
          
          // Skip if it's just "#"
          if (href === '#') return;

          const target = document.querySelector(href);
          if (target) {
            e.preventDefault();
            const headerOffset = 0; // Height of sticky header
            const elementPosition = target.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

            window.scrollTo({
              top: offsetPosition,
              behavior: 'smooth'
            });
          }
        });
      });
    },

    // Update active navigation link on scroll
    updateActiveNavLink: function() {
      const sections = document.querySelectorAll('section[id]');
      const navLinks = document.querySelectorAll('.nav-link[href^="#"]');

      if (sections.length === 0 || navLinks.length === 0) return;

      const observerOptions = {
        root: null,
        rootMargin: '-20% 0px -70% 0px',
        threshold: 0
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const id = entry.target.getAttribute('id');
            
            navLinks.forEach(link => {
              link.classList.remove('active');
              if (link.getAttribute('href') === `#${id}`) {
                link.classList.add('active');
              }
            });
          }
        });
      }, observerOptions);

      sections.forEach(section => {
        observer.observe(section);
      });
    }
  };

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => Main.init());
  } else {
    Main.init();
  }
})();
