<?php

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
