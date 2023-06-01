# BB WMDE Theme

## Installation & Setup

### Node Modules

All required node modules will be installed when running `npm install`.

### ACF Blocks Submodule

The `wmde-blocks` submodule is installed by running `git submodule update --init`;

If you make changes to blocks you'll have to sync them to the repo:

```
cd blocks
git commit -a -m 'Test update'
git push
```

To update the submodule from the repo, run the following:

```
cd blocks
git pull
```

### BrowserSync

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

## ACF Blocks

The `/blocks` directory contains the ACF blocks from the `wmde-blocks` submodule.

NOTE: The blocks ACF groups are _not_ in the `/acf-json` directory. They are loaded from the corresponding directories in `/blocks`.

If you wish to edit the fields of a block then make a symlink. For example for the Card block:

```
ln -s blocks/card/group_63da65f585957.json acf-json/

```

This will make the fields importable in the backend and changes will be mirrored to the file in `/blocks/card`.

## String Translations

The theme will set the constant `BB_TEXT_DOMAIN` to the value setup in `style.css`. When using localization functions, make sure to use `BB_TEXT_DOMAIN` as the text domain. For example:

`<?php _e('my example text', BB_TEXT_DOMAIN); ?>`

## Features

When logged in the current page can be edited by pressing `CTLR-E`.

## Development and Build

For development run `npm run dev`.

For building (for production site) run `npm run build`.

For creating an archive to install the theme run `npm run package`. A zip will be created in `/dist` with a timestamped theme version.

_Do not manually upload files to the live server. Install the theme in the backend with the zipfile (unless it's for an emergency fix)._

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
- ACF fields (not for blocks):
  - `acf-json/`
- ACF blocks: `/bb-block/*`
  - block definition: `block.json`
  - functions: `functions.php`
  - block template: `*.php`
  - ACF groups: `group_XXXXX.json`
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
  - `page*.php`
  - `search.php`
  - `single*.php`
- theme template parts: `template-parts/`
- theme localization: `languages/*`

## Deployment

Make sure that the following files and folders are **excluded** when uploading
the theme to the server:

- `.env*`
- `.git/`
- `.gitignore`
- `.nova/`
- `gulpfile.js`
- `node_modules/`
- `package.*`
- `src/`
- `tailwind.config.js`
