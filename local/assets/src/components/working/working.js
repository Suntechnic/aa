import { createSlider } from '../../js/files/sliders.js';
import { Navigation, Pagination } from 'swiper/modules';

createSlider('.js-slider-working', {
  modules: [Navigation, Pagination],

  slidesPerView: 1,
  spaceBetween: 20,

  navigation: {
    prevEl: '.working__arrow--prev',
    nextEl: '.working__arrow--next',
  },

  pagination: {
    el: '.working__pagination',
    clickable: true,
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
