<?php

acf_register_block_type([
	'name' => 'paragraph',
	'title'				=> __(' Paragraph'),
	'description'		=> __('Basic Block for Paragraphs'),
	'render_template'	=> get_template_directory() . '/template-parts/bb-blocks/paragraph.php',
	'category'			=> 'wkmde-custom-blocks',
	'icon'				=> 'editor-paragraph',
	'keywords'			=> [],
	'mode' => false,
]);