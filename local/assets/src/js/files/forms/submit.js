import { flsModules } from '../modules.js';
import { formValidate } from './validation.js';
import api from '../api.js';

export function formSubmit() {
  document.addEventListener('submit', function (e) {
    const form = e.target;
    formSubmitAction(form, e);
  });
  document.addEventListener('reset', function (e) {
    const form = e.target;
    formValidate.formClean(form);
  });

  async function formSubmitAction(form, e) {
    const error = !form.hasAttribute('data-no-validate')
      ? formValidate.getErrors(form)
      : 0;
    if (error === 0) {
      const ajax = form.hasAttribute('data-ajax');
      if (ajax) {
        e.preventDefault();
        const formAction = form.getAttribute('action')
          ? form.getAttribute('action').trim()
          : '#';
        const formFormat = form.getAttribute('data-format')
          ? form.getAttribute('data-format').trim()
          : 'text';
        const formMethod = form.getAttribute('method')
          ? form.getAttribute('method').trim()
          : 'GET';
        const formData = new FormData(form);
        form.classList.add('_sending');
        if (formMethod === 'GET') {
          api.load({
            url: formAction,
            method: formMethod,
            format: 'text',
            cb: (response) => {
              formSent(form, response);
            },
          });
        } else {
          api.upload({
            url: formAction,
            method: formMethod,
            body: formData,
            format: formFormat,
            cb: (response) => {
              formSent(form, response);
            },
          });
        }
      }
    } else {
      e.preventDefault();
      if (
        form.querySelector('._form-error') &&
        form.hasAttribute('data-goto-error')
      ) {
        const formGoToErrorClass = form.dataset.gotoError
          ? form.dataset.gotoError
          : '._form-error';
      }
    }
  }
  function formSent(form, responseResult = ``) {
    document.dispatchEvent(
      new CustomEvent('formSent', {
        detail: {
          form: form,
        },
      })
    );

    setTimeout(() => {
      const popupSelector = form.dataset.popupMessage;

      if (flsModules.popup && popupSelector) {
        const activeModal = document.querySelector('.popup_show');
        if (activeModal) {
          flsModules.popup.close(activeModal, 100);
        }
        const popup = document.querySelector(popupSelector);
        if (popup) {
          flsModules.popup.open(popupSelector);
        } else {
          const parser = new DOMParser();
          const response = parser.parseFromString(responseResult, 'text/html');
          const el = response.body.querySelector(popupSelector);
          document.body.appendChild(el);
          setTimeout(() => {
            flsModules.popup.open(popupSelector);
          }, 110);
        }
      }
    }, 0);
    // Очищуємо форму
    formValidate.formClean(form);
    // Повідомляємо до консолі
  }
  function formLogging(message) {
    FLS(`[Формы]: ${message}`);
  }
}
