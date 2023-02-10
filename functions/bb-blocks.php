<?php
// list all allowed block types here. custom block types need to be added here to appear
function custom_allowed_block_types($allowed_blocks)
{
	return [
		//'core/paragraph',
		//'core/heading',
		'core/column',
		'core/columns',
		// ACF Blocks
		'acf/image',
		'acf/paragraph',
		'acf/heading',
		'acf/button',
		'acf/blockquote',
		'acf/accordion',
		'acf/card',
		'acf/cta',
		'acf/projects-swiper',
		'acf/responsive-table',
		'acf/newsletter',
	];
}
add_filter('allowed_block_types_all', 'custom_allowed_block_types');

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

/*
add_filter('acf/load_field/name=tw_color', function ($field) {
	// reset choices
	$field['choices'] = [
		'1' => 'one',
		'2' => 'two',
	];

	// return the field
	return $field;
});

*/
