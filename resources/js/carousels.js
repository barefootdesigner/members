import Splide from '@splidejs/splide';

document.addEventListener('DOMContentLoaded', () => {
  const carousels = document.querySelectorAll('.girl-carousel');

  carousels.forEach(carousel => {
    new Splide(carousel, {
      type: 'slide',
      perPage: 6,
      perMove: 1,
      gap: '1.5rem',
      pagination: false,
      arrows: true,
      drag: true,
      snap: true,
      breakpoints: {
        1536: { perPage: 5, gap: '1.5rem' },
        1280: { perPage: 4, gap: '1.5rem' },
        1024: { perPage: 3, gap: '1.25rem' },
        768: { perPage: 2.5, gap: '1rem' },
        640: { perPage: 2, gap: '1rem' },
        475: { perPage: 1.5, gap: '0.75rem' }
      }
    }).mount();
  });
});
