import { Fancybox } from '@fancyapps/ui';
import '@fancyapps/ui/dist/fancybox/fancybox.css';

Fancybox.bind('[data-fslightbox]', {
  groupAttr: 'data-fslightbox',
});

if (window.BX) {
  BX.addCustomEvent('app.DOMUpdated', function (data) {
    Fancybox.bind('[data-fslightbox]', {
      groupAttr: 'data-fslightbox',
    });
  });
}