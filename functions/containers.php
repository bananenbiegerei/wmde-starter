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
		// Get alignment values (for columns from the classes)
		if ($block['blockName'] == 'core/columns') {
			$align = $block['attrs']['className'] ?? 'default';
		} else {
			$align = $block['attrs']['data']['style_alignment'] ?? 'default';
		}

		// Full width blocks, columns, or blocks within a column, or null blocks get no containers around them
		$always_fullwidth = ['acf/projects-swiper', 'acf/testimonials-swiper', 'core/column', null];
		if ($align == 'full' || in_array($block['blockName'], $always_fullwidth) || $block['inColumn']) {
			return $block_content;
		}

		// These blocks will have full width with a small padding
		$always_fullwidth_with_padding = ['core/columns'];
		$container_classes = 'px-5';
		if (in_array($block['blockName'], $always_fullwidth_with_padding) && $align == 'default') {
			return "<div class='{$container_classes}'>" . $block_content . '</div>';
		}

		// For other blocks, depending on the align value
		$container_classes = 'container grid grid-cols-12';
		$alignment_classes = [
			// Default for specific blocks
			'acf/XX' => ['default' => 'col-span-12'],
			// For other blocks with or without alignment settings
			'default' => [
				// Options defined in ACF: Clone Library / Alignment
				'default' => 'col-span-12 lg:col-span-8 lg:col-start-3',
				'wide' => 'col-span-12',
				'right' => 'col-span-12 lg:col-span-8 lg:col-start-5',
				// Classes manually added to Columns blocks in Gutenberg editor
				'col-12' => 'col-span-12',
				'col-10' => 'col-span-12 lg:col-span-10 lg:col-start-2',
				'col-8' => 'col-span-12 lg:col-span-8 lg:col-start-3',
			],
		];
		$item_classes = ($alignment_classes[$block['blockName']] ?? $alignment_classes['default'])[$align] ?? ($alignment_classes['default'][$align] ?? $alignment_classes['default']['default']);
		$content = "<div class='{$container_classes}'><div class='{$item_classes}'>" . $block_content . '</div></div>';
		return $content;
	},
	10,
	2,
);
