<?php

acf_register_block_type([
	'name' => 'blockquote',
	'title'				=> __('Numero Blockquote'),
	'description'		=> __('Blockquote'),
	'render_template'	=> get_template_directory() . '/template-parts/bb-blocks/blockquote-block.php',
	'category'			=> 'wkmde-custom-blocks',
	'icon'				=> 'format-quote',
	'keywords'			=> [],
	'mode' => false,
]);