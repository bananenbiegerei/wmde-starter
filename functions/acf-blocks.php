<?php

// Define this to limit which blocks will be loaded
//define('WMDE_ALLOWED_BB_BLOCKS', ['image', 'card']);

define('WMDE_ALLOWED_WP_BLOCKS', ['core/group', 'core/column', 'core/columns', 'core/html', 'core/file', 'core/shortcode']);

require_once get_template_directory() . '/blocks/init.php';

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

// BG colors for team members
add_filter('acf/load_field/name=team_section_color', function ($field) {
		$field['choices'] = [
				'palerose' => 'Rose',
				'palepurple' => 'Purple',
				'palepeach' => 'Peach',
				'palecyan' => 'Cyan',
				'palepink' => 'Pink',
				'paleblue' => 'Blue',
				'palegreen' => 'Green',
		];
		return $field;
});
