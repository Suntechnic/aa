import Swiper from 'swiper';
import { A11y, Mousewheel } from 'swiper/modules';

// import 'swiper/css';

/**
 * Создает слайдер и добавляет его в глобальный массив `sliders`.
 *
 * @param {Element} el - DOM элемент, в котором будет инициализирован слайдер.
 * @param {Object} [options] - Параметры для настройки слайдера.
 *
 * Опции могут быть расширены или переопределены пользовательскими параметрами.
 * Если в пользовательских опциях указаны модули, они будут добавлены к модулям по умолчанию.
 * Позволяет иметь множество уникальных модулей без повторений.
 */
export const createSlider = (el, options) => {
  let mergedOptions;
  const defaultOptions = {
    modules: [A11y, Mousewheel],
    slidesPerView: 'auto',
    speed: 800,
    a11y: true,

    mousewheel: {
      releaseOnEdges: true,
      forceToAxis: true,
    },
  };

  if (options && typeof options === 'object') {
    mergedOptions = { ...defaultOptions, ...options };
    if (options.modules) {
      mergedOptions.modules = [
        ...new Set([...defaultOptions.modules, ...options.modules]),
      ];
    }
  }
  sliders.push([el, mergedOptions || defaultOptions]);
};

const sliders = [];
// Инициализация слайдеров
function initSliders() {
  // Список слайдеров
  // Проверяем, есть ли слайдер на странице
  sliders.forEach((element) => {
    new Swiper(element[0], element[1]);
  });
}

window.addEventListener('load', function (e) {
  initSliders();
});

// Бинд слайдеров на window для беков
window.initSliders = initSliders;
