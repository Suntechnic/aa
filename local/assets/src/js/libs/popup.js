// Модуль попапов
//(c) Фрилансер по жизни, "Хмурый Кот"
// Документация по работе в шаблоне: https://template.fls.guru/template-docs/funkcional-popup.html
// Сниппет (HTML): pl

// Подключение функционала "Чертоги Фрилансера"
import { flsModules } from '../files/modules.js';
import api from '../files/api.js';
import * as flsForms from '../files/forms/forms.js';
import {
  isMobile,
  bodyLockStatus,
  bodyLock,
  bodyUnlock,
  bodyLockToggle,
  FLS,
  addClasses,
  removeClasses,
} from '../files/functions.js';
const functionsInModal = (el) => {
  flsForms.formFieldsInit({
    viewPass: false,
    autoHeight: false,
  });
};

// Клас Popup
class Popup {
  constructor(options) {
    let config = {
      logging: true,
      init: true,
      //Для кнопок
      attributeOpenButton: 'data-popup', // Атрибут для кнопки, которая открывает
      attributeCloseButton: 'data-close', // Атрибут для кнопки, которая закрывает попап
      classes: {
        popup: 'popup',
        popupContent: 'popup__content',
        popupActive: 'popup_show',
        bodyActive: 'popup-show',
      },
      focusCatch: true,
      closeEsc: true, // Закриття ESC
      bodyLock: true, // Блокування скролла
      hashSettings: {
        location: true, // Хеш в адресному рядку
        goHash: true, // Перехід по наявності в адресному рядку
      },
      on: {
        // Події
        beforeOpen: function () {},
        afterOpen: function () {},
        beforeClose: function () {},
        afterClose: function () {},
      },
    };
    this.youTubeCode;
    this.isOpen = false;
    // Поточне вікно
    this.targetOpen = {
      selector: false,
      element: false,
    };
    // Попереднє відкрите
    this.previousOpen = {
      selector: false,
      element: false,
    };
    // Останнє закрите
    this.lastClosed = {
      selector: false,
      element: false,
    };
    this._dataValue = false;
    this.hash = false;

    this._reopen = false;
    this._selectorOpen = false;

    this.lastFocusEl = false;
    this._focusEl = [
      'a[href]',
      'input:not([disabled]):not([type="hidden"]):not([aria-hidden])',
      'button:not([disabled]):not([aria-hidden])',
      'select:not([disabled]):not([aria-hidden])',
      'textarea:not([disabled]):not([aria-hidden])',
      'area[href]',
      'iframe',
      'object',
      'embed',
      '[contenteditable]',
      '[tabindex]:not([tabindex^="-"])',
    ];
    //this.options = Object.assign(config, options);
    this.options = {
      ...config,
      ...options,
      classes: {
        ...config.classes,
        ...options?.classes,
      },
      hashSettings: {
        ...config.hashSettings,
        ...options?.hashSettings,
      },
      on: {
        ...config.on,
        ...options?.on,
      },
    };
    this.bodyLock = false;
    this.options.init ? this.initPopups() : null;
  }
  initPopups() {
    this.popupLogging(`Проснулся`);
    this.eventsPopup();
  }
  async getModal(link, selector) {
    console.log(link);
    api.load({
      url: link,
      format: 'text',
      cb: (responseResult) => {
        const parser = new DOMParser();
        const response = parser.parseFromString(responseResult, 'text/html');
        const el = response.querySelector(selector);
        document.body.appendChild(el);
        functionsInModal(el);
        this.open();
      },
    });
  }
  eventsPopup() {
    document.addEventListener(
      'click',
      async function (e) {
        const buttonOpen = e.target.closest(
          `[${this.options.attributeOpenButton}]`
        );
        if (buttonOpen) {
          e.preventDefault();
          this._dataValue = buttonOpen.getAttribute(
            this.options.attributeOpenButton
          )
            ? buttonOpen.getAttribute(this.options.attributeOpenButton)
            : 'error';
          addClasses([buttonOpen], 'popup-open');
          await this.getModal(buttonOpen.href, this._dataValue);
          removeClasses([buttonOpen], 'popup-open');

          if (this._dataValue !== 'error') {
            if (!this.isOpen) this.lastFocusEl = buttonOpen;
            this.targetOpen.selector = `${this._dataValue}`;
            this._selectorOpen = true;
            this.open();

            return;
          } else
            this.popupLogging(`Не заполнен атрибут в ${buttonOpen.classList}`);
          return;
        }
        const buttonClose = e.target.closest(
          `[${this.options.attributeCloseButton}]`
        );
        if (
          buttonClose ||
          (!e.target.closest(`.${this.options.classes.popupContent}`) &&
            this.isOpen)
        ) {
          e.preventDefault();
          this.close();
          return;
        }
      }.bind(this)
    );
    // Закрытие на ESC
    document.addEventListener(
      'keydown',
      function (e) {
        if (
          this.options.closeEsc &&
          e.which == 27 &&
          e.code === 'Escape' &&
          this.isOpen
        ) {
          e.preventDefault();
          this.close();
          return;
        }
        if (this.options.focusCatch && e.which == 9 && this.isOpen) {
          this._focusCatch(e);
          return;
        }
      }.bind(this)
    );

    if (this.options.hashSettings.goHash) {
      window.addEventListener(
        'hashchange',
        function () {
          if (window.location.hash) {
            this._openToHash();
          } else {
            this.close(this.targetOpen.selector);
          }
        }.bind(this)
      );

      window.addEventListener(
        'load',
        function () {
          if (window.location.hash) {
            this._openToHash();
          }
        }.bind(this)
      );
    }
  }
  open(selectorValue) {
    this.bodyLock =
      document.documentElement.classList.contains('lock') && !this.isOpen
        ? true
        : false;

    if (
      selectorValue &&
      typeof selectorValue === 'string' &&
      selectorValue.trim() !== ''
    ) {
      this.targetOpen.selector = selectorValue;
      this._selectorOpen = true;
    }
    if (this.isOpen) {
      this._reopen = true;
      this.close();
    }
    if (!this._selectorOpen)
      this.targetOpen.selector = this.lastClosed.selector;
    if (!this._reopen) this.previousActiveElement = document.activeElement;

    this.targetOpen.element = document.querySelector(this.targetOpen.selector);

    if (this.targetOpen.element) {
      if (this.options.hashSettings.location) {
        this._getHash();
        this._setHash();
      }

      this.options.on.beforeOpen(this);
      document.dispatchEvent(
        new CustomEvent('beforePopupOpen', {
          detail: {
            popup: this,
          },
        })
      );
      addClasses([this.targetOpen.element], this.options.classes.popupActive);
      addClasses([document.documentElement], this.options.classes.bodyActive);

      if (!this._reopen) {
        !this.bodyLock ? bodyLock() : null;
      } else this._reopen = false;

      this.targetOpen.element.setAttribute('aria-hidden', 'false');

      this.previousOpen.selector = this.targetOpen.selector;
      this.previousOpen.element = this.targetOpen.element;

      this._selectorOpen = false;

      this.isOpen = true;

      setTimeout(() => {
        this._focusTrap();
      }, 50);

      this.options.on.afterOpen(this);
      document.dispatchEvent(
        new CustomEvent('afterPopupOpen', {
          detail: {
            popup: this,
          },
        })
      );
      this.popupLogging(`Открыл попап`);
    } else
      this.popupLogging(`Ей, такого попа нет. Проверьте правильность ввода.`);
  }
  forceOpen(link, selector) {
    this.targetOpen.selector = selector;
    this._selectorOpen = true;
    this.getModal(link, selector);
  }

  close(selectorValue, timer = 800) {
    if (
      selectorValue &&
      typeof selectorValue === 'string' &&
      selectorValue.trim() !== ''
    ) {
      this.previousOpen.selector = selectorValue;
    }
    if (!this.isOpen || !bodyLockStatus) {
      return;
    }
    this.options.on.beforeClose(this);
    // Событие до закрытия
    document.dispatchEvent(
      new CustomEvent('beforePopupClose', {
        detail: {
          popup: this,
        },
      })
    );

    removeClasses(
      [this.previousOpen.element],
      this.options.classes.popupActive
    );

    bodyUnlock(timer);

    // aria-hidden
    this.previousOpen.element.setAttribute('aria-hidden', 'true');
    if (!this._reopen) {
      removeClasses(
        [document.documentElement],
        this.options.classes.bodyActive
      );

      this.isOpen = false;
    }
    this._removeHash();
    if (this._selectorOpen) {
      this.lastClosed.selector = this.previousOpen.selector;
      this.lastClosed.element = this.previousOpen.element;
    }
    this.options.on.afterClose(this);
    document.dispatchEvent(
      new CustomEvent('afterPopupClose', {
        detail: {
          popup: this,
        },
      })
    );

    setTimeout(() => {
      this._focusTrap();
    }, 50);

    console.log(this.previousOpen);
    setTimeout(() => {
      this.previousOpen.element.remove();
    }, timer);

    this.popupLogging(`Закрыл попап`);
  }
  // Отримання хешу
  _getHash() {
    if (this.options.hashSettings.location) {
      this.hash = this.targetOpen.selector.includes('#')
        ? this.targetOpen.selector
        : this.targetOpen.selector.replace('.', '#');
    }
  }
  async _openToHash() {
    const button = document.querySelector(
      `[${this.options.attributeOpenButton}="${window.location.hash}"]`
    );

    if (button) {
      await this.getModal(
        button.href,
        button.getAttribute(this.options.attributeOpenButton)
      ).then(() => {
        this.open(button.getAttribute(this.options.attributeOpenButton));
      });
    }
  }
  // Встановлення хеша
  _setHash() {
    history.pushState('', '', this.hash);
  }
  _removeHash() {
    history.pushState('', '', window.location.href.split('#')[0]);
  }
  _focusCatch(e) {
    const focusable = this.targetOpen.element.querySelectorAll(this._focusEl);
    const focusArray = Array.prototype.slice.call(focusable);
    const focusedIndex = focusArray.indexOf(document.activeElement);

    if (e.shiftKey && focusedIndex === 0) {
      focusArray[focusArray.length - 1].focus();
      e.preventDefault();
    }
    if (!e.shiftKey && focusedIndex === focusArray.length - 1) {
      focusArray[0].focus();
      e.preventDefault();
    }
  }
  _focusTrap() {
    const focusable = this.previousOpen.element.querySelectorAll(this._focusEl);
    if (!this.isOpen && this.lastFocusEl) {
      this.lastFocusEl.focus();
    } else {
      focusable[0].focus();
    }
  }
  // Функція виведення в консоль
  popupLogging(message) {
    this.options.logging ? FLS(`[Попапос]: ${message}`) : null;
  }
}
// Запускаємо та додаємо в об'єкт модулів
flsModules.popup = new Popup({});
window.popup = flsModules.popup;
