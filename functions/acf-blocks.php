<?php

add_action('init', function () {
	// Declare all blocks in '/blocks/'
	foreach (glob(__DIR__ . '/../blocks/*') as $block) {
		register_block_type($block);
	}

	// Each block can come with its set of functions...
	foreach (glob(__DIR__ . '/../blocks/*/functions.php') as $block_functions) {
		include_once $block_functions;
	}
});

// add_filter('acf/settings/load_json', function ($paths) {
//   Add all folders in /blocks/
//   $paths[] = get_template_directory() . '/blocks/custom-teasers-swiper/';
//   return $paths;
// });

// List all allowed block types here
add_filter('allowed_block_types_all', function ($allowed_blocks) {
	// These core blocks are still enabled
	$blocks = ['core/group', 'core/column', 'core/columns', 'core/file', 'core/shortcode', 'core/table', 'core/block', 'core/html', 'core/separator', 'wpforms/form-selector'];

	// ACF blocks loaded automatically...
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

// define('BB_PRODUCTION_SERVER_NAME', 'website.wikimedia.de');
// add_action('admin_enqueue_scripts', function () {
// 	if (is_production_server()) {
// 		wp_enqueue_style('admin-prod', get_template_directory_uri() . '/css/admin-prod.css', [], '', 'all');
// 	}
// });
