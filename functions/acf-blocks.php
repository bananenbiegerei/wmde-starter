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

// Add flag to block if it's within a column (to avoid getting a container)
add_filter(
	'render_block_data',
	function ($parsed_block, $source_block, $parent_block) {
		if ($parent_block && $parent_block->parsed_block['blockName'] == 'core/column') {
			$parsed_block['inColumn'] = true;
		} else {
			$parsed_block['inColumn'] = false;
		}
		return $parsed_block;
	},
	10,
	3,
);

// Wrap blocks with a container
add_filter(
	'render_block',
	function ($block_content, $block) {
		$always_fullwidth = [null, 'acf/projects-swiper', 'acf/testimonials-swiper', 'core/column'];
		$container_classes = 'container grid grid-cols-12';
		$align_classes = [
			'default' => 'col-span-12 lg:col-span-8 lg:col-start-3',
			'wide' => 'col-span-12',
			'right' => 'col-span-12 lg:col-span-8 lg:col-start-5',
			'col-full' => 'px-5',
			'col-12' => 'col-span-12',
			'col-10' => 'col-span-12 lg:col-span-10 lg:col-start-1',
			'col-8' => 'col-span-12 lg:col-span-8 lg:col-start-3',
		];

		// For columns we get the alignment info from the classes, otherwise from the block attributes
		if ($block['blockName'] == 'core/columns') {
			$align = $block['attrs']['className'];
			if (!in_array($align, array_keys($align_classes))) {
				$align = 'wide';
			}
		} else {
			$align = $block['attrs']['data']['style_alignment'] ?? 'default';
		}

		// Full width block get no container around them
		if ($align == 'full' || in_array($block['blockName'], $always_fullwidth) || $block['inColumn']) {
			return $block_content;
		}

		$content = "<div class='{$container_classes}'><div class='{$align_classes[$align]}'>" . $block_content . '</div></div>';
		return $content;
	},
	10,
	2,
);
