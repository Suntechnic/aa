import { flsModules } from './modules.js';

// Пример чанк импорта fslightbox
// export default async () => {
//   const el = document.querySelector('[data-fslightbox]');
//   if (!el) return;
//   await import(/* webpackChunkName: "fslightbox" */ 'fslightbox');
//   window.FsLightbox();
// };

// Пример чанк импорта для подключения модуля без названия
// export default async () => {
//   if (!tipItems) return;
//   const { default: Tippy } = await import(
//     /* webpackChunkName: "tippy" */ 'tippy.js'
//   );

// };

//========================================================================================================================================================

// export default async () => {
//   const el = document.querySelector('[data-fslightbox]');
//   if (!el) return;
//   await import(/* webpackChunkName: "fslightbox" */ 'fslightbox');
//   window.FsLightbox();
// };

//========================================================================================================================================================
let fsLightboxLoaded = false;

const initFsLightbox = async (container = document) => {
  const items = container.querySelectorAll(
    '[data-fslightbox]:not([data-fslightbox-init])',
  );

  if (!items.length) return;

  if (!fsLightboxLoaded) {
    await import(/* webpackChunkName: "fslightbox" */ 'fslightbox');
    fsLightboxLoaded = true;
  }

  items.forEach((el) => {
    el.setAttribute('data-fslightbox-init', 'true');
  });

  window.refreshFsLightbox();
};

export default () => {
  initFsLightbox();

  if (window.BX) {
    BX.addCustomEvent('app.DOMUpdated', function (data) {
      const container = data?.container;
      if (!container) return;

      initFsLightbox(container);
    });
  }
};

//========================================================================================================================================================
const animateItems = document.querySelectorAll('.animate-block');
if (animateItems[0]) {
  animateItems.forEach((element) => {
    const items = element.querySelectorAll('[data-watch]');
    if (items[0]) {
      items.forEach((element, index) => {
        if (window.matchMedia('(max-width: 992px)').matches) {
          element.style.animationDelay = '0.05s';
        } else {
          element.style.animationDelay = index * 0.05 + 's';
        }
      });
    }
  });
}
