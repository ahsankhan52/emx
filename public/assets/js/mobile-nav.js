/**
 * Mobile Navigation Functionality
 * Handles hamburger menu toggle and mobile navigation
 */

(function() {
  'use strict';

  const MobileNav = {
    navToggle: null,
    navMenu: null,
    navLinks: null,

    // Initialize mobile navigation
    init: function() {
      this.navToggle = document.getElementById('mobile-nav-toggle');
      this.navMenu = document.getElementById('nav-menu');
      this.navLinks = document.querySelectorAll('.nav-link');

      if (!this.navToggle || !this.navMenu) return;

      this.bindEvents();
      this.handleResize();
    },

    // Bind event listeners
    bindEvents: function() {
      // Toggle button click
      this.navToggle.addEventListener('click', () => {
        this.toggleMenu();
      });

      // Close menu when clicking on a nav link
      this.navLinks.forEach(link => {
        link.addEventListener('click', () => {
          this.closeMenu();
        });
      });

      // Close menu when clicking outside
      document.addEventListener('click', (e) => {
        if (
          this.navMenu.classList.contains('active') &&
          !this.navMenu.contains(e.target) &&
          !this.navToggle.contains(e.target)
        ) {
          this.closeMenu();
        }
      });

      // Handle window resize
      window.addEventListener('resize', () => {
        this.handleResize();
      });

      // Close menu on escape key
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && this.navMenu.classList.contains('active')) {
          this.closeMenu();
        }
      });
    },

    // Toggle mobile menu
    toggleMenu: function() {
      const isActive = this.navMenu.classList.contains('active');
      
      if (isActive) {
        this.closeMenu();
      } else {
        this.openMenu();
      }
    },

    // Open mobile menu
    openMenu: function() {
      this.navMenu.classList.add('active');
      this.navToggle.classList.add('active');
      this.navToggle.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
    },

    // Close mobile menu
    closeMenu: function() {
      this.navMenu.classList.remove('active');
      this.navToggle.classList.remove('active');
      this.navToggle.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    },

    // Handle window resize
    handleResize: function() {
      if (window.innerWidth > 1199) {
        this.closeMenu();
      }
    }
  };

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => MobileNav.init());
  } else {
    MobileNav.init();
  }
})();
