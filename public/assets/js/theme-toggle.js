/**
 * Theme Toggle Functionality
 * Handles light/dark theme switching with localStorage persistence
 */

(function() {
  'use strict';

  const ThemeToggle = {
    // Initialize theme toggle
    init: function() {
      this.applySavedTheme();
      this.bindEvents();
      this.updateIcon();
    },

    // Apply saved theme or system preference
    applySavedTheme: function() {
      const savedTheme = localStorage.getItem('theme');
      const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
      
      if (savedTheme) {
        document.documentElement.setAttribute('data-theme', savedTheme);
      }  else {
        document.documentElement.setAttribute('data-theme', 'light');
      }
      
      this.updateIcon();
    },

    // Bind toggle button event
    bindEvents: function() {
      const toggleButton = document.getElementById('theme-toggle');
      
      if (toggleButton) {
        toggleButton.addEventListener('click', () => {
          this.toggleTheme();
        });
      }

      // Listen for system theme changes
      window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (!localStorage.getItem('theme')) {
          document.documentElement.setAttribute('data-theme', e.matches ? 'dark' : 'light');
          this.updateIcon();
        }
      });
    },

    // Toggle between light and dark themes
    toggleTheme: function() {
      const currentTheme = document.documentElement.getAttribute('data-theme');
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      
      document.documentElement.setAttribute('data-theme', newTheme);
      localStorage.setItem('theme', newTheme);
      this.updateIcon();
    },

    // Update theme toggle icon
    updateIcon: function() {
      const toggleButton = document.getElementById('theme-toggle');
      const icon = toggleButton?.querySelector('i');
      const currentTheme = document.documentElement.getAttribute('data-theme');
      
      if (icon) {
        if (currentTheme === 'dark') {
          icon.className = 'fas fa-sun';
          toggleButton.setAttribute('aria-label', 'Switch to light theme');
        } else {
          icon.className = 'fas fa-moon';
          toggleButton.setAttribute('aria-label', 'Switch to dark theme');
        }
      }
    }
  };

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => ThemeToggle.init());
  } else {
    ThemeToggle.init();
  }
})();
