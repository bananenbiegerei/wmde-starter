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

// Wrap blocks with a container
add_filter(
	'render_block',
	function ($block_content, $block) {
		$always_fullwidth = [null, 'acf/projects-swiper', 'acf/testimonials-swiper'];
		$align = $block['attrs']['data']['style_alignment'] ?? 'default';
		if ($align == 'full' || in_array($block['blockName'], $always_fullwidth)) {
			return $block_content;
		}
		$container_classes = 'container grid grid-cols-12';
		$align_classes = [
			'default' => 'col-span-12 lg:col-span-8 lg:col-start-3',
			'wide' => 'col-span-12',
			'right' => 'col-span-12 lg:col-span-8 lg:col-start-5',
		];
		$content = "<div class='{$container_classes}'><div class='{$align_classes[$align]}'>" . $block_content . '</div></div>';
		return $content;
	},
	10,
	2,
);
