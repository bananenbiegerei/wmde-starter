<?php

/* Experiments with new way of declaring blocks in ACF v6.0 */
add_action('init', function () {
	register_block_type(__DIR__ . '/../blocks/custom-teasers-swiper');
});

add_filter('acf/settings/load_json', function ($paths) {
	// remove original path (optional)
	//unset($paths[0]);
	$paths[] = get_stylesheet_directory() . '/blocks/custom-teasers-swiper/';
	return $paths;
});

// List all allowed block types here
add_filter('allowed_block_types_all', function ($allowed_blocks) {
	$blocks = [
		//'core/paragraph',
		//'core/heading',
		//'core/image',
		'core/column',
		'core/columns',
		'acf/custom-teasers-swiper',
	];
	// ACF Blocks loaded automatically...
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
