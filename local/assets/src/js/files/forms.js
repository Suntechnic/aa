import { formSubmit } from './forms/submit.js';
import { formFieldsInit } from './forms/forms.js';

/* Работа с полями формы */
formFieldsInit({
  viewPass: false,
  autoHeight: false,
});
/* Отправка формы */
formSubmit();

/* Модуль формы "количество" */
// formQuantity();

/* Модуль работы маски для телефона. */
// import { createMask } from './forms/forms.js';
// createMask();

/* Модуль работы по select. */
// import '../libs/select.js'

/* Модуль работы с ползунком */
/*
Подключение и настройка выполняется в файле js/files/forms/range.js
Документация по работе в шаблоне:
Документация плагина: https://refreshless.com/nouislider/
*/
// import initRange from '../components/range/range.js';
// initRange('[data-range]');
