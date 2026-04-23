import { createSlider } from '../../js/files/sliders.js';
import { Navigation, Pagination } from 'swiper/modules';

createSlider('.js-slider-block', {
  modules: [Navigation, Pagination],

  slidesPerView: 1,
  spaceBetween: 20,

  navigation: {
    prevEl: '.block__arrow--prev',
    nextEl: '.block__arrow--next',
  },

  pagination: {
    el: '.block__pagination',
    clickable: true,
    // dynamicBullets: true,
  },

  breakpoints: {
    320: {
      slidesPerView: 'auto',
      spaceBetween: 0,
    },
    992: {
      slidesPerView: 'auto',
      spaceBetween: 0,
    },
  },

  on: {},
});
