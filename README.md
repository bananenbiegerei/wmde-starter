# BB Tailwind Starter Theme

## Installation & Setup

All required node modules will be installed when running `npm install`.

Update the theme metadata in `style.css`. Don't forget to set `Text Domain` to the value of the theme slug.

To setup BrowserSync copy the file `.env-example` to `.env` and edit accordingly:

- `BROWSERSYNC_PROXY_URL`: base URL of your local WP instance (e.g. `wkmde.local`, no `http://`!)
- `BROWSERSYNC_OPEN_BROWSER`: start browser when running gulp

## Formatting Standards

Use [Prettier](https://prettier.io) with your IDE to get automatic formatting of the code. Ideally you'll setup your IDE so that files are formatted upon saving.

The Prettier config is defined in `package.json` under the `prettier` key and should be automatically used.

- "printWidth": 200 (80 is way to short for modern screens...)
- "useTabs": true (use tabs instead of spaces)
- "phpVersion": "8.0" (among others will convert `array()` to `[]`...)
- "singleQuote" and "jsxSingleQuote": true (use single quotes by default)

## Reusable Custom ACF Blocks (BB Blocks)

**TBD**

## String Translations

The theme will set the constant `BB_TEXT_DOMAIN` to the value setup in `style.css`. When using localization functions, make sure to use `BB_TEXT_DOMAIN` as the text domain. For example:

`<?php _e('my example text', BB_TEXT_DOMAIN); ?>`

## Features

When logged in the current page can be edited by pressing `CTLR-E`.

## Development and Build

For development start `npm run dev` or `npm run watch`.

For building (for production site) start `npm run build`.

## Creating Theme Archive

A Zip file of the compiled theme can easily be created by running `./mktheme.sh` or `npm run package`. The file will be created in the `dist/` folder and timestamped with the current date.

## Files and Folder Structure:

### Configuration and Build

- config files:
  - `.env`
  - `tailwindconfig.js`
- build files:
  - `package.json` and `package-lock.json`
  - `gulpfile.js`

### Theme Files

- theme metadata:
  - `style.css`
  - `screenshot.png`
- static assets:
  - `img/`
  - `fonts/`
- styles:
  - pre-build: `src/scss/*`
  - post-build: `css/*`
- scripts:
  - pre-build: `src/js/*`
  - post-build: `js/*`
- ACF block fields:
  - `acf-json/`
- ACF blocks: `/bb-block/*`
  - block definition: `block.json`
  - functions: `functions.php`
  - block template: `*.php`
  - symlink to ACF group: `group_XXXXX.json --> ../../acf-json/group_XXXXX.json`
- theme functions:
  - `functions.php`
  - `functions/*`
- theme templates in project root:
  - `404.php`
  - `archive.php`
  - `footer.php`
  - `front-page.php`
  - `head.php`
  - `header.php`
  - `index.php`
  - `page.php`
  - `search.php`
  - `single.php`
- theme template parts: `template-parts/`
- theme localization: `languages/*`

## Deployment

Make sure that the following files and folders are **excluded** when uploading
the theme to the server:

- `.env*`
- `.git/`
- `.gitignore`
- `.nova/`
- `blocks/group_*.json` (symlinks)
- `gulpfile.js`
- `node_modules/`
- `package.*`
- `src/`
- `tailwind.config.js`
