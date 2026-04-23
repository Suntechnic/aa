// Подключение функционала "Чертоги Фрилансера"
import { isMobile, uniqArray, FLS } from '../files/functions.js';
import { flsModules } from '../files/modules.js';

// Наблюдатель объектов [всевидящее око]
// data-watch – можно писать значение для применения кастомного кода
// data-watch-root – родительский элемент внутри которого наблюдать за объектом
// data-watch-margin -отступление
// data-watch-threshold – процент показа объекта для срабатывания
// data-watch-once – наблюдать только один раз
// _watcher-view – класс добавляемый при появлении объекта

class ScrollWatcher {
  constructor(props) {
    let defaultConfig = {
      logging: true,
    };
    this.config = Object.assign(defaultConfig, props);
    this.observer;
    !document.documentElement.classList.contains('watcher')
      ? this.scrollWatcherRun()
      : null;
  }
  scrollWatcherUpdate() {
    this.scrollWatcherRun();
  }
  scrollWatcherRun() {
    document.documentElement.classList.add('watcher');
    this.scrollWatcherConstructor(document.querySelectorAll('[data-watch]'));
  }
  scrollWatcherConstructor(items) {
    if (items.length) {
      this.scrollWatcherLogging(
        `Проснулся, слежу за объектами (${items.length})...`
      );
      // Унікалізуємо параметри
      let uniqParams = uniqArray(
        Array.from(items).map(function (item) {
          return `${
            item.dataset.watchRoot ? item.dataset.watchRoot : null
          }|${item.dataset.watchMargin ? item.dataset.watchMargin : '0px'}|${item.dataset.watchThreshold ? item.dataset.watchThreshold : 0}`;
        })
      );
      uniqParams.forEach((uniqParam) => {
        let uniqParamArray = uniqParam.split('|');
        let paramsWatch = {
          root: uniqParamArray[0],
          margin: uniqParamArray[1],
          threshold: uniqParamArray[2],
        };
        let groupItems = Array.from(items).filter(function (item) {
          let watchRoot = item.dataset.watchRoot
            ? item.dataset.watchRoot
            : null;
          let watchMargin = item.dataset.watchMargin
            ? item.dataset.watchMargin
            : '0px';
          let watchThreshold = item.dataset.watchThreshold
            ? item.dataset.watchThreshold
            : 0;
          if (
            String(watchRoot) === paramsWatch.root &&
            String(watchMargin) === paramsWatch.margin &&
            String(watchThreshold) === paramsWatch.threshold
          ) {
            return item;
          }
        });

        let configWatcher = this.getScrollWatcherConfig(paramsWatch);

        // Ініціалізація спостерігача зі своїми налаштуваннями
        this.scrollWatcherInit(groupItems, configWatcher);
      });
    } else {
      this.scrollWatcherLogging('Сплю, нет объектов для слежки. ZzzZZzz');
    }
  }
  getScrollWatcherConfig(paramsWatch) {
    let configWatcher = {};
    if (document.querySelector(paramsWatch.root)) {
      configWatcher.root = document.querySelector(paramsWatch.root);
    } else if (paramsWatch.root !== 'null') {
      this.scrollWatcherLogging(
        `Эмм... родительского объекта ${paramsWatch.root} нет на странице`
      );
    }
    // Відступ спрацьовування
    configWatcher.rootMargin = paramsWatch.margin;
    if (
      paramsWatch.margin.indexOf('px') < 0 &&
      paramsWatch.margin.indexOf('%') < 0
    ) {
      this.scrollWatcherLogging(
        `Ой, настройку data-watch-margin нужно задавать в PX или %`
      );
      return;
    }
    if (paramsWatch.threshold === 'prx') {
      paramsWatch.threshold = [];
      for (let i = 0; i <= 1.0; i += 0.005) {
        paramsWatch.threshold.push(i);
      }
    } else {
      paramsWatch.threshold = paramsWatch.threshold.split(',');
    }
    configWatcher.threshold = paramsWatch.threshold;

    return configWatcher;
  }
  scrollWatcherCreate(configWatcher) {
    this.observer = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        this.scrollWatcherCallback(entry, observer);
      });
    }, configWatcher);
  }
  scrollWatcherInit(items, configWatcher) {
    this.scrollWatcherCreate(configWatcher);
    items.forEach((item) => this.observer.observe(item));
  }
  scrollWatcherIntersecting(entry, targetElement) {
    if (entry.isIntersecting) {
      !targetElement.classList.contains('_watcher-view')
        ? targetElement.classList.add('_watcher-view')
        : null;
      this.scrollWatcherLogging(
        `Я вижу ${targetElement.classList} добавил класс _watcher-view`
      );
    } else {
      targetElement.classList.contains('_watcher-view')
        ? targetElement.classList.remove('_watcher-view')
        : null;
      this.scrollWatcherLogging(
        `Я не вижу ${targetElement.classList}, убрал класс _watcher-view`
      );
    }
  }
  scrollWatcherOff(targetElement, observer) {
    observer.unobserve(targetElement);
    this.scrollWatcherLogging(
      `Я перестал следить за ${targetElement.classList}`
    );
  }
  scrollWatcherLogging(message) {
    this.config.logging ? FLS(`[Наблюдатель]: ${message}`) : null;
  }
  scrollWatcherCallback(entry, observer) {
    const targetElement = entry.target;
    this.scrollWatcherIntersecting(entry, targetElement);
    targetElement.hasAttribute('data-watch-once') && entry.isIntersecting
      ? this.scrollWatcherOff(targetElement, observer)
      : null;
    document.dispatchEvent(
      new CustomEvent('watcherCallback', {
        detail: {
          entry: entry,
        },
      })
    );
  }
}
flsModules.watcher = new ScrollWatcher({});
