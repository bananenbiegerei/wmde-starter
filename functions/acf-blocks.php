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

// Define list of allowed block types
add_filter('allowed_block_types_all', function ($allowed_blocks) {
	// Get all registered blocks except 'core/*' blocks
	$blocks = array_filter(array_keys(WP_Block_Type_Registry::get_instance()->get_all_registered()), function ($b) {
		return !str_starts_with($b, 'core/');
	});
	// Add the core blocks we're still using
	$blocks = array_merge($blocks, ['core/group', 'core/column', 'core/columns', 'core/file', 'core/shortcode', 'core/table', 'core/block', 'core/html', 'core/separator']);
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

add_action('admin_enqueue_scripts', function () {
	if (is_production_server()) {
		wp_enqueue_style('admin-prod', get_template_directory_uri() . '/css/admin-prod.css', [], '', 'all');
	}
});
