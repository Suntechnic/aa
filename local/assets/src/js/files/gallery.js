// Устанавливаем библиотеку npm i fslightbox

export default async () => {
  const el = document.querySelector('[data-fslightbox]');
  if (!el) return;
  await import(/* webpackChunkName: "fslightbox" */ 'fslightbox');
  window.FsLightbox();
};
