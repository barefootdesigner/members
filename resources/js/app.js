import './bootstrap';
import Alpine from 'alpinejs';
import Splide from '@splidejs/splide';
import '@splidejs/splide/css/core';
import './carousels';

window.Alpine = Alpine;

// Girl Card Preview Component
document.addEventListener('alpine:init', () => {
  Alpine.data('girlCard', (galleryImages, featuredImage) => ({
    images: [],
    currentIndex: 0,
    currentImage: '',
    isPreviewing: false,
    previewInterval: null,
    isTouchDevice: false,

    init() {
      this.isTouchDevice = 'ontouchstart' in window;
      this.images = galleryImages && galleryImages.length > 0
        ? [featuredImage, ...galleryImages.map(img => `/storage/${img}`)]
        : [featuredImage];
      this.currentImage = this.images[0];
    },

    startPreview() {
      // Disable on touch devices or single image
      if (this.isTouchDevice || this.images.length <= 1) return;

      this.isPreviewing = true;
      this.currentIndex = 0;

      // Preload all images
      this.images.forEach(src => {
        const img = new Image();
        img.src = src;
      });

      // Start cycling every 800ms
      this.previewInterval = setInterval(() => {
        this.currentIndex = (this.currentIndex + 1) % this.images.length;
        this.currentImage = this.images[this.currentIndex];
      }, 800);
    },

    stopPreview() {
      this.isPreviewing = false;
      clearInterval(this.previewInterval);
      this.currentIndex = 0;
      this.currentImage = this.images[0];
    }
  }));

  // Scroll Reveal Component
  Alpine.data('scrollReveal', (delay = 0) => ({
    isVisible: false,

    init() {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            setTimeout(() => {
              this.isVisible = true;
            }, delay);
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
      });

      observer.observe(this.$el);
    }
  }));
});

Alpine.start();

// Page Transitions
document.addEventListener('DOMContentLoaded', () => {
  // Check if View Transitions API is supported
  const supportsViewTransitions = 'startViewTransition' in document;

  // Handle all internal link clicks
  document.addEventListener('click', (e) => {
    const link = e.target.closest('a');

    // Only handle internal links
    if (!link ||
        link.target === '_blank' ||
        link.hostname !== window.location.hostname ||
        link.getAttribute('href')?.startsWith('#') ||
        link.getAttribute('href')?.startsWith('tel:') ||
        link.getAttribute('href')?.startsWith('mailto:')) {
      return;
    }

    e.preventDefault();
    const url = link.href;

    if (supportsViewTransitions) {
      // Use View Transitions API
      document.startViewTransition(async () => {
        await loadPage(url);
      });
    } else {
      // Fallback: manual fade transition
      document.body.style.opacity = '0';
      setTimeout(() => {
        window.location.href = url;
      }, 200);
    }
  });

  async function loadPage(url) {
    const response = await fetch(url);
    const html = await response.text();
    const parser = new DOMParser();
    const doc = parser.parseFromString(html, 'text/html');

    // Update the content
    document.body.innerHTML = doc.body.innerHTML;
    document.title = doc.title;

    // Update URL
    window.history.pushState({}, '', url);

    // Scroll to top smoothly
    window.scrollTo({ top: 0, behavior: 'smooth' });

    // Reinitialize Alpine
    Alpine.start();
  }
});
