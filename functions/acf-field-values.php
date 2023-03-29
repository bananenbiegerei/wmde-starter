<?php

add_filter('acf/load_field/name=color_light', function ($field) {
	$field['choices'] = [
		'default' => 'Default',
		'white' => 'White',
		'gray' => 'Gray',
		'red-50' => 'Red',
		'green-50' => 'Green',
		'neon' => 'Neon',
		'primary-50' => 'Blue',
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
		'neon-800' => 'Neon',
		'primary' => 'Blue',
	];
	return $field;
});
