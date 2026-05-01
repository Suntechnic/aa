import vituum from 'vituum';
import postcss from '@vituum/vite-plugin-postcss';
import pug from '@vituum/vite-plugin-pug';
import twig from '@vituum/vite-plugin-twig';
import Inspect from 'vite-plugin-inspect';
import mqpacker from '@hail2u/css-mqpacker';

export default {
  base: './',

  // 🔴 КЛЮЧЕВОЙ ФИКС
  experimental: {
    renderBuiltUrl(filename) {
      return filename.replace(/^\//, '');
    },
  },

  plugins: [
    Inspect(),
    vituum(),
    pug({
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
      plugins: [mqpacker({ sort: true })],
    },
  },

  optimizeDeps: {
    include: ['**/*.pug'],
  },

  server: {
    port: 3000,
  },

  build: {
    outDir: 'dist',
    assetsDir: '',
    assetsInlineLimit: 0,

    brotliSize: false,
    reportCompressedSize: false,

    sourcemap: process.env.NODE_ENV === 'development',

    rollupOptions: {
      output: {
        entryFileNames: 'js/[name].[hash].js',
        chunkFileNames: 'js/[name].[hash].js',

        assetFileNames: (info) => {
          const name = info.name || '';

          if (name.endsWith('.css')) {
            return 'css/main.css';
          }

          if (name.endsWith('.woff')) {
            return 'fonts/[name].woff';
          }

          if (name.endsWith('.woff2')) {
            return 'fonts/[name].woff2';
          }

          if (/\.(png|jpe?g|gif|svg|webp)$/.test(name)) {
            return 'img/icons/[name][extname]';
          }

          return '[name][extname]';
        },
      },
    },
  },
};
