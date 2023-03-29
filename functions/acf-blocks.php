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

// NOTE: If there's not acf-json folder then load from 'acf-groups' and /blocks/*/
// if (!file_exists(get_template_directory() . '/acf-json') || !is_dir(get_template_directory() . '/acf-json')) {
// 	add_filter('acf/settings/load_json', function ($paths) {
// 		$paths[] = get_template_directory() . 'acf-groups';
// 		foreach (glob(__DIR__ . '/../blocks/*/') as $block_dir) {
// 			$paths[] = $block_dir;
// 		}
// 	});
// }

// Define list of allowed block types
add_filter('allowed_block_types_all', function ($allowed_blocks) {
	// Get all registered blocks except 'core/*' blocks
	$blocks = array_filter(array_keys(WP_Block_Type_Registry::get_instance()->get_all_registered()), function ($b) {
		return !str_starts_with($b, 'core/');
	});
	// Add the core blocks we're still using
	$core_blocks = ['core/group', 'core/column', 'core/columns', 'core/file', 'core/shortcode', 'core/table', 'core/block', 'core/html', 'core/separator', 'core/paragraph'];
	return array_merge($blocks, $core_blocks);
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

add_filter('acf/fields/wysiwyg/toolbars', function ($toolbars) {
	// Remove fullscreen button
	unset($toolbars['Basic'][1][13]);
	unset($toolbars['Full'][1][12]);
	return $toolbars;
});
