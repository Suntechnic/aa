import { createSlider } from '../../js/files/sliders.js';
import { Navigation } from 'swiper/modules';

createSlider('.js-slider-intro', {
  modules: [Navigation],

  slidesPerView: 1,
  spaceBetween: 20,

  navigation: {
    prevEl: '.intro__arrow--prev',
    nextEl: '.intro__arrow--next',
  },

  //   pagination: {
  //     el: '.product-form__pagging',
  //     clickable: true,
  //     // dynamicBullets: true,
  //   },

  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
    992: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
  },

  on: {},
});
