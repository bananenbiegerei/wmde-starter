<?php

// Automatically declare all blocks in `bb-blocks/`
add_action('acf/init', function () {
	foreach (glob(dirname(__FILE__) . '/bb-blocks/*.php') as $block) {
		include_once $block;
	}
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
