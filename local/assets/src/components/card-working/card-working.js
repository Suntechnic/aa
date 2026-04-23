import { createSlider } from '../../js/files/sliders.js';
import { Pagination, EffectFade } from 'swiper/modules';

createSlider('.js-slider-card', {
  modules: [Pagination, EffectFade],
  nested: true,
  touchStartPreventDefault: false,
  slidesPerView: 1,
  spaceBetween: 14,
  effect: 'fade',

  fadeEffect: {
    crossFade: true,
  },

  pagination: {
    el: '.card-working__pagination',
    clickable: true,
  },

  on: {
    init(swiper) {
      const sliderEl = swiper.el;
      let isEnabled = false;

      const isTouchDevice = () => {
        return 'ontouchstart' in window || navigator.maxTouchPoints > 0;
      };

      if (isTouchDevice()) return;

      const handleMove = (clientX) => {
        const rect = sliderEl.getBoundingClientRect();
        const x = clientX - rect.left;
        const percent = Math.min(Math.max(x / rect.width, 0), 1);
        const slideIndex = Math.floor(percent * swiper.slides.length);
        if (slideIndex !== swiper.activeIndex) {
          swiper.slideTo(slideIndex);
        }
      };

      const mouseMoveHandler = (e) => {
        handleMove(e.clientX);
      };

      const mouseLeaveHandler = () => {
        swiper.slideTo(0);
      };

      const enableHandlers = () => {
        if (!isEnabled) {
          sliderEl.addEventListener('mousemove', mouseMoveHandler);
          sliderEl.addEventListener('mouseleave', mouseLeaveHandler);
          isEnabled = true;
        }
      };

      const disableHandlers = () => {
        if (isEnabled) {
          sliderEl.removeEventListener('mousemove', mouseMoveHandler);
          sliderEl.removeEventListener('mouseleave', mouseLeaveHandler);
          isEnabled = false;
          swiper.slideTo(0);
        }
      };

      const checkWidth = () => {
        if (window.innerWidth > 992) {
          enableHandlers();
        } else {
          disableHandlers();
        }
      };

      checkWidth();
      window.addEventListener('resize', checkWidth);
    },
  },
});
