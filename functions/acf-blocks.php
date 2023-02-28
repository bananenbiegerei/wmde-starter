<?php

// Declare all blocks in '/blocks/'
add_action('init', function () {
	foreach (glob(__DIR__ . '/../blocks/*') as $block) {
		register_block_type($block);
	}
	// Each block can come with its set of functions...
	foreach (glob(__DIR__ . '/../blocks/*/functions.php') as $block_functions) {
		include_once $block_functions;
	}
});

// List all allowed block types here
add_filter('allowed_block_types_all', function ($allowed_blocks) {
	$blocks = [
		//'core/paragraph',
		//'core/heading',
		//'core/image',
		'core/column',
		'core/columns',
	];
	// ACF Blocks loaded automatically..
	foreach (glob(__DIR__ . '/../blocks/*') as $block) {
		$blocks[] = 'acf/' . basename($block);
	}
	return $blocks;
});

// Add custom blocks category
add_filter(
	'block_categories',
	function ($categories, $post) {
		return array_merge($categories, [
			[
				'slug' => 'custom-blocks',
				'title' => __('Custom Blocks', BB_TEXT_DOMAIN),
			],
		]);
	},
	10,
	2,
);
