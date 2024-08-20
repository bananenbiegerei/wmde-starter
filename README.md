# BB WMDE Theme

## Installation & Setup

### Fork Repo
Fork Repo to have a independed copy:
1. `git clone https://github.com/bananenbiegerei/wmde-starter`
2. Change directory name of the cloned repository then `cd NEW-REPO-NAME`
3. Create a new repo on github
4. Add your new repo as a remote: `git remote add origin https://github.com/your-username/new-repo-name.git`
5. Push the code to your new repository: `git push -u origin main`

### Node Modules
The first thing to do after cloning the repo is to install node modules for the project: `npm install`.

### ACF Blocks Submodule
For this theme we use two kind of blocks
1. bb-blocks which are blocks that are used in a global context. Meaning they have DON'T have any individual features required by the theme, but can be used on every context.
Install the submodule with: ``` git submodule update --init --recursive ```
2. setup your own individual blocks that are only used within this theme

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

### ACF-JSON

The ACF-JSON files for the blocks are _not located_ in the `acf-json` directory. They are loaded from the corresponding directories in `blocks`. This means the fields cannot directly be imported and edited in the backend.

If you wish to do that use symlinks. For example for the Card block you would do this (from the project top directory):

```
ln -s blocks/card/group_63da65f585957.json acf-json/

```

This will create a symbolic link and make the fields importable in the backend. All changes to the symlink will be mirrored to `blocks/card/group_63da65f585957.json`.

Once you're done with the changes, delete the group in the backend. It will be removed from the DB, the symlink will be deleted. The file `blocks/card/group_63da65f585957.json` will still be there and the block will remain active.

NOTE: _Make sure to NOT commit the symlinks to the repo!_

Adding new Blocks:
@EL ?
@EL, do I have to edit init.json if I add new blocks?

## String Translations

The theme will set the constant `BB_TEXT_DOMAIN` to the value setup in `style.css`. When using localization functions, make sure to use `BB_TEXT_DOMAIN` as the text domain. For example:

`<?php _e('my example text', BB_TEXT_DOMAIN); ?>`

## Features

When logged in the current page can be edited by pressing `CTLR-E`.

## Colors

The colors used in the theme must be declared in (at least) two locations: the Tailwind configuration and a script to load the colors values into the ACF fields.

### Tailwind Config

In `tailwind.config.js`:

```
module.exports = {
	safelist: [
		{
			pattern: /(text|bg)-(black|white|primary|gray|gray-700|primary-50|primary-600|red|red-50|green-50|green-700|neon|neon-800)/,
		},
	],
}
```

### ACF Fields:

In `acf-blocks.php`:

```
add_filter('acf/load_field/name=color_light', function ($field) {
	$field['choices'] = [
		'default' => 'Default',
		'white' => 'White',
		'gray' => 'Gray',
		'red-50' => 'Red',
		'green-50' => 'Green',
		'primary-50' => 'Blue',
		'neon' => 'Neon',
	];
	return $field;
});

add_filter('acf/load_field/name=color_dark', function ($field) {
	$field['choices'] = [
		'default' => 'Default',
		'black' => 'Black',
		'gray-700' => 'Gray',
		'red' => 'Red',
		'green-700' => 'Green',
		'primary' => 'Blue',
		'neon-800' => 'Neon',
	];
	return $field;
});
```

## Development and Build

For development run `npm run dev`.

For building (for production site) run `npm run build`.

For creating an archive to install the theme run `npm run package`. A zip will be created in `dist` with a timestamped theme version. Note that this will also delete all symbolic links in the `acf-json` directory.
Upload zip file to bb server. You wll find a directory called updates/themes. Upload and rename the zip file on server to only "wmde".
Go to wordpress instance -> themes. Mark the theme and check for updates. Then update.

_Do not manually upload files to the live server. Install the theme in the backend with the zipfile (unless it's for an emergency fix)._