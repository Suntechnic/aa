import priorityNav from 'priority-nav';

//========================================================================================================================================================

// window.addEventListener('load', function () {
//   if (window.innerWidth > 992) {
//     priorityNav.init({
//       mainNavWrapper: '.js-nav',
//       navDropdownLabel: 'Ещё',
//       breakPoint: 992,
//     });
//   }
// });

//========================================================================================================================================================

let navInitialized = false;

function handlePriorityNav() {
  if (window.innerWidth > 992) {
    if (!navInitialized) {
      priorityNav.init({
        mainNavWrapper: '.js-nav',
        navDropdownLabel: 'Ещё',
        breakPoint: 992,
      });
      navInitialized = true;
    }
  } else {
    if (navInitialized && priorityNav.destroy) {
      priorityNav.destroy();
      navInitialized = false;
    }
  }
}

window.addEventListener('load', handlePriorityNav);
window.addEventListener('resize', handlePriorityNav);

//========================================================================================================================================================
const menuBody = document.querySelector('.menu__body');

document.addEventListener('click', (event) => {
  const html = document.documentElement; // тег <html>

  // Проверяем, что класс menu-open есть
  if (html.classList.contains('menu-open')) {
    // Если клик вне menuBody — удаляем класс
    if (!menuBody.contains(event.target)) {
      menuClose();
    }
  }
});

//========================================================================================================================================================
function setHeaderHeight() {
  const header = document.querySelector('header');

  if (header) {
    document.documentElement.style.setProperty(
      '--header',
      `${header.offsetHeight}px`,
    );
  }
}

window.addEventListener('load', setHeaderHeight);
window.addEventListener('resize', setHeaderHeight);
