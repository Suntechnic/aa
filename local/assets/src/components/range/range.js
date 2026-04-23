import { throttle } from '../../js/files/functions';

// Устанавливаем npm i nouislider и npm i wnumb

export default async (selector) => {
  const priceSlider = document.querySelectorAll(selector);
  if (priceSlider[0]) {
    const { default: noUiSlider } = await import(
      /* webpackChunkName: "noUiSlider" */ 'nouislider'
    );
    const { default: wNumb } = await import(
      /* webpackChunkName: "wNumb" */ 'wnumb'
    );
    priceSlider.forEach((element) => {
      const textFrom = element.querySelector('[data-range-min]');
      const textTo = element.querySelector('[data-range-max]');
      const maxVal = Number(textTo.getAttribute('data-range-max'));
      const minVal = Number(textFrom.getAttribute('data-range-min'));
      // eslint-disable-next-line no-undef
      const valueFormat = wNumb({
        decimals: 0,
        thousand: ' ',
        // eslint-disable-next-line
        to: function (value) {
          return Math.round(value);
        },
        // eslint-disable-next-line
        from: function (value) {
          return value;
        },
      });
      const item = element.querySelector('[data-range-item]');
      noUiSlider.create(item, {
        start: [minVal, maxVal], // [0,200000]
        connect: true,
        range: {
          min: [minVal],
          max: [maxVal],
        },
        format: valueFormat,
      });
      const setPriceValues = () => {
        const minValue = textFrom.value === '' ? '0' : textFrom.value;
        item.noUiSlider.set([minValue, textTo.value]);
      };
      textFrom.addEventListener('input', setPriceValues);
      textTo.addEventListener('input', setPriceValues);
      item.noUiSlider.on(
        'slide',
        throttle(100, ([min, max]) => {
          textFrom.value = min;
          textTo.value = max;
        })
      );
      item.noUiSlider.on('update', ([min, max]) => {
        textFrom.value = min;
        textTo.value = max;
      });
    });
  }
};

/* Разметка
pug: 
.catalog-filter__range.range.js-range(data-range)
  fieldset.range__values.js-range-values
    .range__value
      input#rng2.input.range__range-value(
        autocomplete='off',
        type='text',
        name='form-range[]',
        aria-label='Минимальное значение',
        placeholder='',
        data-range-min='0'
      )
    .range__value
      input.input.range__range-value(
        autocomplete='off',
        aria-label='Максимальное значение',
        type='text',
        name='form-range[]',
        placeholder='',
        data-range-max='32000'
      )
    div(data-range-item)
//====================================================================
twig: 
<div class="catalog-filter__range range js-range" data-range>
  <fieldset class="range__values js-range-values">
    <div class="range__value">
      <input id="rng2" class="input range__range-value" autocomplete="off" type="text" name="form-range[]" aria-label="Минимальное значение" placeholder="" data-range-min="0">
    </div>
    <span class="range__divider"></span>
    <div class="range__value">
      <input class="input range__range-value" autocomplete="off" aria-label="Максимальное значение" type="text" name="form-range[]" placeholder="" data-range-max="32000">
    </div>
    <div data-range-item></div>
  </fieldset>
</div>

*/
