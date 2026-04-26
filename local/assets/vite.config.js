import vituum from 'vituum';
import postcss from '@vituum/vite-plugin-postcss';
import pug from '@vituum/vite-plugin-pug';
import twig from '@vituum/vite-plugin-twig';
import Inspect from 'vite-plugin-inspect';
import mqpacker from '@hail2u/css-mqpacker';

export default {
  base: './',
  plugins: [
    Inspect(),
    vituum(),
    pug({
      options: {
        // debug: true, // pug дебаг режим
      },
      data: ['src/components/pagesData/*.json', 'src/components/**/*.json'],
    }),
    twig({
      data: ['src/components/pagesData/*.json', 'src/components/**/*.json'],
    }),
    postcss(),
  ],
  css: {
    devSourcemap: process.env.NODE_ENV === 'development',
    preprocessorOptions: {
      scss: {
        silenceDeprecations: ['legacy-js-api'],
      },
    },
    postcss: {
      plugins: [
        mqpacker({
          sort: true,
        }),
      ],
    },
  },
  optimizeDeps: {
    include: ['**/*.pug'],
  },
  server: {
    port: 3000,
    '/': {
      target: 'http://localhost:3000',
      changeOrigin: true,
      method: 'GET',
    },
  },
  build: {
    brotliSize: false, // - отчёт о размере файлов отключение этой опции может увеличить производительность сборки для больших проектов
    reportCompressedSize: false, // - отчеты о размерах, сжатых gzip. Сжатие больших выходных файлов может быть медленным, поэтому его отключение может повысить производительность сборки для больших проектов.
    sourcemap: process.env.NODE_ENV === 'development',
    outDir: 'dist',
    assetsDir: '',
    // cssMinify: false,
    // minify: false,
    assetsInlineLimit: 0,
    rollupOptions: {
      output: {
        chunkFileNames: 'js/[name].[hash].js',
        // [hash] можно убрать по необходимости
        assetFileNames: (info) => {
          if (info.name.endsWith('.css')) {
            return `css/main.css`;
          }
          if (info.name.endsWith('.woff')) {
            return `fonts/[name].woff`;
          }
          if (info.name.endsWith('.woff2')) {
            return `fonts/[name].woff2`;
          }
          if (info.name.match(/\.(png|jpe?g|gif|svg|webp)$/)) {
            return `img/icons/[name][extname]`;
          }
          return `[name].[ext]`;
        },
      },
    },
  },
};
