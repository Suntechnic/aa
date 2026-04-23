import { createSlider } from '../../js/files/sliders.js';
import { Pagination } from 'swiper/modules';

createSlider('.js-slider-exhibition', {
  modules: [Pagination],

  slidesPerView: 1,
  spaceBetween: 20,

  pagination: {
    el: '.exhibition__pagination',
    clickable: true,
  },

  breakpoints: {
    320: {
      slidesPerView: 'auto',
      spaceBetween: 20,
      enabled: true,
    },
    992: {
      slidesPerView: 'auto',
      spaceBetween: 0,
      enabled: false,
    },
  },

  on: {},
});
