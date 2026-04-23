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

export default async () => {
  const el = document.querySelector('[data-fslightbox]');
  if (!el) return;
  await import(/* webpackChunkName: "fslightbox" */ 'fslightbox');
  window.FsLightbox();
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
