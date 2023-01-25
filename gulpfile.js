require('dotenv').config();
const { src, dest, parallel, series, watch } = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const postcss = require('gulp-postcss')
const tailwindcss = require('tailwindcss')
const cssnano = require('cssnano')
const autoprefixer = require('autoprefixer')
const webpack = require('webpack-stream')
const gulpEsbuild = require('gulp-esbuild')
const { createGulpEsbuild } = require('gulp-esbuild')
const gulpEsbuildIncremental = createGulpEsbuild({ incremental: true })
const browserSync = require('browser-sync').create()

function styles() {
  return src('./src/scss/style.scss')
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        includePaths: ['node_modules'],
      })
      .on('error', sass.logError)
    )
    .pipe(postcss([
      tailwindcss('./tailwind.config.js'),
    ]))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./dist/css'))
    .pipe(browserSync.stream())
}

function stylesProduction() {
  return src('./src/scss/style.scss')
    .pipe(
      sass({
        includePaths: ['node_modules'],
      })
      .on('error', sass.logError)
    )
    .pipe(postcss([
      tailwindcss('./tailwind.config.js'),
      autoprefixer(),
      cssnano(),
    ]))
    .pipe(dest('./dist/css'))
}

function esbuild() {
  return src('./src/js/app.js')
    .pipe(gulpEsbuildIncremental({
      outfile: 'app.js',
      bundle: true,
      sourcemap: true,
    }))
    .pipe(dest('./dist/js'))
}

function esbuildProduction() {
  return src('./src/js/app.js')
    .pipe(gulpEsbuild({
      outfile: 'app.js',
      bundle: true,
      minify: true,
      minifyWhitespace: true,
      minifyIdentifiers: true,
    }))
    .pipe(dest('./dist/js'))
}

function copyImages() {
  return src('./src/img/**/*')
    .pipe(dest('./dist/img'))
}

function copyFonts() {
  return src('./src/fonts/**/*')
    .pipe(dest('./dist/fonts'))
}

function dev() {
  browserSync.init({
    proxy: process.env.BROWSERSYNC_PROXY_URL,
    open: process.env.BROWSERSYNC_OPEN_BROWSER == 'true',
  })

  watch('./src/scss/**/*.scss', styles)
  watch('./src/js/**/*.js', esbuild).on('change', browserSync.reload)
  watch('./**/*.php', styles).on('change', browserSync.reload)
  watch('./src/img/**/*', copyImages)
  watch('./src/fonts/**/*', copyFonts)
}

exports.default = series(parallel(styles, esbuild, copyImages, copyFonts), dev)
exports.build = series(stylesProduction, esbuildProduction)
exports.styles = styles
exports.scripts = esbuild
exports.pstyles = stylesProduction
exports.pscripts = esbuildProduction

