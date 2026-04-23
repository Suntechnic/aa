/* eslint-disable no-await-in-loop */
import { readFile, writeFile } from 'node:fs/promises';
import { renameSync, existsSync } from 'fs';
import { exec } from 'child_process';
import gulp from 'gulp';
import clean from 'gulp-clean';
import cpy from 'cpy';
import htmlBemValidator from 'gulp-html-bem-validator';
import { htmlValidator } from 'gulp-w3c-html-validator';
import imagemin from 'gulp-imagemin';
import imageminWebp from 'imagemin-webp';
import newer from 'gulp-newer';
import rename from 'gulp-rename';
import beautifyHtml from 'gulp-html-beautify';
import glob from 'glob';

const FIND_STRINGS = {
  'src="/': 'src="./',
  "src='/": "src='./",
  'src=/': 'src=./',
  'href="/': 'href="./',
  "href='/": "href='./",
  'href=/': 'href=./',
  'url("/': 'url("../',
  "url('/": "url('../",
  'url(/': 'url(../',
  'url(&quot;/': 'url(&quot;../',
};

const FIND_STRINGS_JS = {
  'yn="modulepreload",Sn=function(t){return"/"+t}':
    'yn="modulepreload",Sn=function(t){return BASE_URL + t}',
};

const rootStaticFolders = ['img'];

const copyFolders = {
  'src/fonts/*{woff,woff2}': 'fonts/',
  'src/responses/*': 'responses/',
  'src/favicon/*': '',
};

const updateResponsesJSON = () => {
  return gulp
    .src('src/responses/**/*.json')
    .pipe(newer('public/responses')) // Only pass through newer files
    .pipe(gulp.dest('public/responses'));
};

export const watchResponsesJSON = () => {
  gulp.watch('src/responses/**/*.json', updateResponsesJSON);
};

/* common build */

const renameStaticFolders = async (direction = '') => {
  rootStaticFolders.forEach((folder) => {
    const changePath = [`src/${folder}`, `src/${folder}-temp`];

    if (direction === '') {
      if (!existsSync(changePath[1])) {
        changePath.reverse();
      } else {
        return;
      }
    }

    if (direction === 'reverse') {
      if (existsSync(changePath[1])) {
        changePath.reverse();
      } else {
        return;
      }
    }

    renameSync(changePath[0], changePath[1]);
  });
};

const renameStaticFoldersReverse = async (cb) => {
  renameStaticFolders('reverse');
  cb();
};

/* before build */

const cleanPublic = () =>
  gulp.src('public', { read: false, allowEmpty: true }).pipe(clean());

const copyFiles = async (cb) => {
  Object.entries(copyFolders).forEach(([key, value]) => {
    const dest = `public/${value}`;
    cpy(key, dest);
  });
  gulp.src('src/img/**/*.mp4').pipe(gulp.dest('public/img'));
  cb();
};

const watcherFilesInit = async (cb) => {
  gulp.watch('src/{img,upload}/**/*', { events: 'all' }, () =>
    // eslint-disable-next-line no-console
    exec('npm run img', () => console.log('Картинки обновлены'))
  );
  cb();
};

// eslint-disable-next-line
const copyVideosForBuild = () => {
  return gulp.src('src/img/**/*.mp4').pipe(gulp.dest('build/img'));
};

const generateImages = async (cb) => {
  const quality = 100;

  rootStaticFolders.forEach((folder) => {
    gulp
      .src(`src/${folder}/**/*.{svg,SVG}`)
      .pipe(newer({ dest: `public/${folder}` }))
      .pipe(gulp.dest(`public/${folder}`));

    gulp
      .src(`src/${folder}/**/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}`)
      .pipe(newer({ dest: `public/${folder}`, ext: '.webp' }))
      .pipe(imagemin([imageminWebp({ quality })]))
      .pipe(rename({ extname: '.webp' }))
      .pipe(gulp.dest(`public/${folder}`));
  });

  cb();
};
const copyFaviconToDist = async (cb) => {
  const sourcePath = 'src/img/favicon/**/*';
  const destinationPath = 'dist';
  if (existsSync('src/img/favicon')) {
    await cpy(sourcePath, destinationPath);
  }

  cb();
};

export const preDev = gulp.parallel(gulp.series(copyFiles, generateImages));

export const watcherFiles = gulp.series(watcherFilesInit, watchResponsesJSON);

export const preBuild = gulp.series(
  renameStaticFoldersReverse,
  cleanPublic,
  generateImages,
  copyFiles,
  copyVideosForBuild,
  copyFaviconToDist
);

export const renameStaticFoldersBuild = gulp.series(renameStaticFolders);
export const renameStaticFoldersDev = gulp.series(renameStaticFoldersReverse);

export const img = gulp.series(generateImages);

/* after build */

const replacePath = async () => {
  const escapeRegExp = (string) =>
    string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

  try {
    glob('build/**/*.{html,css}', {}, async (error, files) => {
      // eslint-disable-next-line no-restricted-syntax
      for (const file of files) {
        let fileContent = await readFile(file, 'utf8');

        Object.entries(FIND_STRINGS).forEach(([key, value]) => {
          fileContent = fileContent.replace(
            new RegExp(escapeRegExp(key), 'g'),
            value
          );
        });

        await writeFile(file, fileContent, 'utf8');
      }
    });

    glob('build/**/*.js', {}, async (error, files) => {
      // eslint-disable-next-line no-restricted-syntax
      for (const file of files) {
        let fileContent = await readFile(file, 'utf8');

        Object.entries(FIND_STRINGS_JS).forEach(([key, value]) => {
          fileContent = fileContent.replace(
            new RegExp(escapeRegExp(key), 'g'),
            value
          );
        });

        await writeFile(file, fileContent, 'utf8');
      }
    });

    // eslint-disable-next-line no-console
    console.log('\x1b[32m%s\x1b[0m', 'BUILD END!');
  } catch (error) {
    // eslint-disable-next-line no-console
    console.error(`Ошибка при чтении директории`);
  }
};

const htmlBeautifyInit = async (cb) => {
  const options = {
    indent_size: 2,
    indent_char: ' ',
    max_preserve_newlines: 1,
    indent_with_tabs: true,
    inline: [],
  };
  gulp
    .src('./dist/*.html')
    .pipe(beautifyHtml(options))
    .pipe(gulp.dest('./dist/'));

  setTimeout(async () => {
    const result = await replacePath();
    if (result) {
      cb();
    }
  }, 1000);
};
const copyReadmeBackendToDist = () => {
  return gulp.src('readme-backend.md').pipe(gulp.dest('dist'));
};

export const afterBuild = gulp.parallel(
  htmlBeautifyInit,
  renameStaticFoldersReverse,
  copyReadmeBackendToDist
);

/* TEST */
const validateBEM = () =>
  gulp
    .src([`dist/*.html`, `!dist/popup-*.html`, `!dist/responses-*.html`])
    .pipe(htmlBemValidator());
const validateHTML = () =>
  gulp
    .src([`dist/*.html`, `!dist/popup-*.html`, `!dist/responses-*.html`])
    .pipe(
      htmlValidator.analyzer({
        ignoreMessages: /^Section lacks heading. Consider using “h2”-“h6”/,
      })
    )
    .pipe(htmlValidator.reporter());

export const test = gulp.series(validateBEM, validateHTML);
