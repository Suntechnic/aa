// Подключение списка активных модулей
import { flsModules } from '../modules.js';
// Вспомогательные функции
import {
  isMobile,
  _slideUp,
  _slideDown,
  _slideToggle,
  FLS,
} from '../functions.js';
import api from '../api.js';
import 'inputmask/dist/inputmask.min.js';
import { formValidate } from './validation.js';

//================================================================================================================================================================================================================================================================================================================================

export function formFieldsInit(
  options = { viewPass: false, autoHeight: false }
) {
  document.body.addEventListener('focusin', function (e) {
    const targetElement = e.target;
    if (
      targetElement.tagName === 'INPUT' ||
      targetElement.tagName === 'TEXTAREA'
    ) {
      if (!targetElement.hasAttribute('data-no-focus-classes')) {
        targetElement.classList.add('_form-focus');
        targetElement.parentElement.classList.add('_form-focus');
      }
      formValidate.removeError(targetElement);
      targetElement.hasAttribute('data-validate')
        ? formValidate.removeError(targetElement)
        : null;
    }
  });
  document.body.addEventListener('focusout', function (e) {
    const targetElement = e.target;
    if (
      targetElement.tagName === 'INPUT' ||
      targetElement.tagName === 'TEXTAREA'
    ) {
      if (!targetElement.hasAttribute('data-no-focus-classes')) {
        targetElement.classList.remove('_form-focus');
        targetElement.parentElement.classList.remove('_form-focus');
      }
      // Мгновенная валидация
      targetElement.hasAttribute('data-validate')
        ? formValidate.validateInput(targetElement)
        : null;
    }
  });
  // Если включен, добавляем функционал "Показать пароль"
  if (options.viewPass) {
    document.addEventListener('click', function (e) {
      let targetElement = e.target;
      if (targetElement.closest('[class*="__viewpass"]')) {
        let inputType = targetElement.classList.contains('_viewpass-active')
          ? 'password'
          : 'text';
        targetElement.parentElement
          .querySelector('input')
          .setAttribute('type', inputType);
        targetElement.classList.toggle('_viewpass-active');
      }
    });
  }
  // Если включено, добавляем функционал "Автовысота"
  if (options.autoHeight) {
    const textareas = document.querySelectorAll('textarea[data-autoheight]');
    if (textareas.length) {
      textareas.forEach((textarea) => {
        const startHeight = textarea.hasAttribute('data-autoheight-min')
          ? Number(textarea.dataset.autoheightMin)
          : Number(textarea.offsetHeight);
        const maxHeight = textarea.hasAttribute('data-autoheight-max')
          ? Number(textarea.dataset.autoheightMax)
          : Infinity;
        setHeight(textarea, Math.min(startHeight, maxHeight));
        textarea.addEventListener('input', () => {
          if (textarea.scrollHeight > startHeight) {
            textarea.style.height = `auto`;
            setHeight(
              textarea,
              Math.min(Math.max(textarea.scrollHeight, startHeight), maxHeight)
            );
          }
        });
      });
      function setHeight(textarea, height) {
        textarea.style.height = `${height}px`;
      }
    }
  }
}

/* Модуль формы "количество" */
export function formQuantity() {
  document.addEventListener('click', function (e) {
    let targetElement = e.target;
    if (
      targetElement.closest('[data-quantity-plus]') ||
      targetElement.closest('[data-quantity-minus]')
    ) {
      const valueElement = targetElement
        .closest('[data-quantity]')
        .querySelector('[data-quantity-value]');
      let value = parseInt(valueElement.value);
      if (targetElement.hasAttribute('data-quantity-plus')) {
        value++;
        if (
          +valueElement.dataset.quantityMax &&
          +valueElement.dataset.quantityMax < value
        ) {
          value = valueElement.dataset.quantityMax;
        }
      } else {
        --value;
        if (+valueElement.dataset.quantityMin) {
          if (+valueElement.dataset.quantityMin > value) {
            value = valueElement.dataset.quantityMin;
          }
        } else if (value < 1) {
          value = 1;
        }
      }
      targetElement
        .closest('[data-quantity]')
        .querySelector('[data-quantity-value]').value = value;
    }
  });
}

/* Модуль маски для телефона  */
export const createMask = (context = document) => {
  const telInputs = context.querySelectorAll('input[type="tel"]');

  telInputs.forEach((input) => {
    Inputmask({ mask: '+7 (999) 999-9999', showMaskOnHover: false }).mask(
      input
    );
  });
};