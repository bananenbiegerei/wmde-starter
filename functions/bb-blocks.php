<?php

// List all allowed block types here. custom block types need to be added here to appear
add_filter('allowed_block_types_all', function ($allowed_blocks) {
	$blocks = [
		//'core/paragraph',
		//'core/heading',
		'core/column',
		'core/columns',
	];
	$blocks = array_merge($blocks, bb_get_acf_blocknames());
	return $blocks;
});

// Automatically get names of defined ACF blocks in 'bb-blocks'
function bb_get_acf_blocknames()
{
	$acf = [];
	foreach (glob(dirname(__FILE__) . '/bb-blocks/*.php') as $block) {
		preg_match("/'name'\s+=>\s+'(.*?)',/", file_get_contents($block), $m);
		if (!empty($m[1])) {
			$acf[] = "acf/{$m[1]}";
		}
	}
	return $acf;
}

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
