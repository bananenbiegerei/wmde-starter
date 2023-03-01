<?php

// Add flag to a block if it's within a column (to avoid getting a container during render_block)
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

// Wrap blocks with a container to implement page layout
add_filter(
	'render_block',
	function ($block_content, $block) {
		$always_fullwidth = ['acf/projects-swiper', 'acf/testimonials-swiper', 'core/column', null];
		$container_classes = 'container grid grid-cols-12';
		$alignment_classes = [
			// Options defined in ACF: Clone Library / Alignment
			'default' => 'col-span-12 lg:col-span-8 lg:col-start-3',
			'wide' => 'col-span-12',
			'right' => 'col-span-12 lg:col-span-8 lg:col-start-5',
			// Classes manually added to Columns blocks in Gutenberg editor
			'col-12' => 'col-span-12',
			'col-10' => 'col-span-12 lg:col-span-10 lg:col-start-2',
			'col-8' => 'col-span-12 lg:col-span-8 lg:col-start-3',
		];

		// For columns we get the alignment info from the classes, for other blocks from the block attributes
		if ($block['blockName'] == 'core/columns') {
			$align = $block['attrs']['className'] ?? '';
			// Default is no container with px-5 applied (see 'scss/ui/columns.scss')
			if (!in_array($align, array_keys($alignment_classes))) {
				return $block_content;
			}
		} else {
			$align = $block['attrs']['data']['style_alignment'] ?? 'default';
		}

		// Full width block get no container around them
		if ($align == 'full' || in_array($block['blockName'], $always_fullwidth) || $block['inColumn']) {
			return $block_content;
		}

		$content = "<div class='{$container_classes}'><div class='{$alignment_classes[$align]}'>" . $block_content . '</div></div>';
		return $content;
	},
	10,
	2,
);
