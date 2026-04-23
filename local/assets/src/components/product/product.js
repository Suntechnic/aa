import { createSlider } from '../../js/files/sliders.js';
import { Navigation, Thumbs } from 'swiper/modules';

document.querySelectorAll('.js-slider-product').forEach((slider, index) => {
  const thumbs = document.querySelectorAll('.js-slider-thumbs')[index];

  if (!thumbs) return;

  createSlider(slider, {
    modules: [Navigation, Thumbs],
    slidesPerView: 1,
    spaceBetween: 0,

    thumbs: {
      swiper: {
        modules: [Navigation, Thumbs],

        el: thumbs,
        // slidesPerView: 'auto',
        spaceBetween: 6,
        slidesPerView: 'auto',
        navigation: {
          prevEl: '.product__arrow--prev',
          nextEl: '.product__arrow--next',
        },

        breakpoints: {
          320: {
            spaceBetween: 0,
            slidesPerView: 'auto',
            direction: 'horizontal',
          },
          992: {
            spaceBetween: 0,
            slidesPerView: 'auto',
            direction: 'vertical',
          },
        },
        // navigation: {
        //   prevEl: '.product__arrow--prev',
        //   nextEl: '.product__arrow--next',
        // },
      },
    },
  });
});
