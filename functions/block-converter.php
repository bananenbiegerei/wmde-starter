<?php
add_action('admin_menu', function () {
	add_menu_page('BB Block Converter', 'BB Block Converter', 'install_plugins', 'bb_block_converter', 'bb_block_converter_page', 'dashicons-hammer');
});

function bb_block_converter_page()
{
	$p = get_post(240); //52405); //55309);

	$blocks = parse_blocks($p->post_content);
	$new_blocks = [];

	clog($blocks);
	foreach ($blocks as $block) {
		if ($block['blockName']) {
			$new_blocks[] = bb_convert_block($block);
		} else {
			$new_blocks[] = $block;
		}
	}
	clog($new_blocks);

	clog(serialize_blocks($new_blocks));
}

function bb_convert_block($block)
{
	switch ($block['blockName']) {
		case 'core/heading':
			preg_match('/<(h.)( id="(.*?)")?>/', $block['innerHTML'], $match);
			$new_block = [
				'blockName' => 'acf/heading',
				'attrs' => [
					'name' => 'acf/heading',
					'data' => [
						'field_6332f0b132592' => strip_tags($block['innerHTML']), // headline text
						'field_6332f0c432593' => $match[1], // headline type,
						'field_63ef9861a9a68' => $match[3] ?? null, // ID for anchor nav
						'field_6399a788bde81' => 'default', // size
						'field_63f346930b9b5' => 0, // has_bg_color
						'field_63e3a8189c006' => '#ffffff', // bg_color
					],
					'mode' => 'auto',
				],
			];
			break;
		case 'core/paragraph':
			$new_block = [
				'blockName' => 'acf/paragraph',
				'attrs' => [
					'name' => 'acf/paragraph',
					'data' => [
						'field_6332e57c9e5c2' => $block['innerHTML'],
						'field_6332e7ddefe75' => 'default',
					],
					'mode' => 'auto',
				],
			];
			break;
		case 'core/image':
			$new_block = [
				'blockName' => 'acf/image',
				'attrs' => [
					'name' => 'acf/image',
					'data' => [
						'image' => $block['attrs']['id'],
						'_image' => 'field_6328565a67504',
						'wide' => 0,
						'_wide' => 'field_63ee61aed2f3b',
					],
					'mode' => 'auto',
				],
			];
			break;
		default:
			$new_block = $block;
	}

	$new_block['innerContent'] = $new_block['innerContent'] ?? [];

	$new_inner_content = [];
	foreach ($block['innerBlocks'] as $inner_block) {
		if (gettype($inner_block) == 'string') {
			$new_inner_content[] = $inner_block;
		} else {
			$new_inner_content[] = bb_convert_block($inner_block);
		}
	}
	$new_block['innerBlocks'] = $new_inner_content;

	return $new_block;
}
