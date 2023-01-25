# BB Tailwind Starter Theme

## Todo

- @Eric: Add a `cleanUp` task to glup (to delete `css/*` and 'js/\*`)
- @Eric: Add a `package` task to create a zip file of the theme ready to install on WordPress
- @Eric: Add basic metadata in `head.php`
- @Ingo: Do some cleanup of `src/scss/` to keep only the minimal required
- @Ingo: Check that templates work to get a minimal functional site
- @Ingo: Do some cleanup of template files to remove classes and styling

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

For custom ACF blocks that we may want to reuse a modular structure is recommended. For now there's an example with the block called `accordion`.

These are the files to be created and used:

- ACF fields:
  - file: `acf-json/group_5cff8a6c26332.json`
  - created automatically after local sync from WP backend
  - always make sure that you have an up-to-date version when pushing to git repo
- ACF declaration:
  - file: `functions/bb-blocks/accordion.php`
  - will be **automatically** included by `functions/bb-blocks.php`
- Styling:
  - file: `src/scss/bb-blocks/accordion.scss`
  - will be **automatically** included by `src/scss/styles.scss`
- Render template:
  - file: `template-parts/bb-blocks/accordion.php`
- JS code:
  - file: `src/js/bb-blocks/accordion.js`
  - needs to be **manually** imported in `site.js` and `site.js` to be extended as needed

If you want to disable a block, move it to a `bb-bocks.disabled/` folder for example (create folder in `functions/` and `src/scss/` as needed).

## String Translations

The theme will set the constant `BB_TEXT_DOMAIN` to the value setup in `style.css`. When using localization functions, make sure to use `BB_TEXT_DOMAIN` as the text domain. For example:

`<?php _e('my example text', BB_TEXT_DOMAIN); ?>`

## Features

When logged in the current page can be edited by pressing `CTLR-E`.

## Development and Build

For development start `npm run dev` or `npm run watch`.


For building (for production site) start `npm run build`.

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
- styles and scripts (pre-build):
  - `src/scss/`
  - `src/js/`
- ACF block fields:
  - `acf-json/`
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
- theme template parts:
  - `template-parts/bb-block`: custom ACF blocks
  - any other templates in `template-parts/`
- theme localization: `languages/*`

## Deployment

Make sure that the following files and folders are **excluded** when uploading
the theme to the server:

- `.git/`
- `.nova/`
- `node_modules/`
- `src/`
- `.env*`
- `.gitignore`
- `gulpfile.js`
- `package.*`
- `tailwind.config.js`
