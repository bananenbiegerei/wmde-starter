<?php

acf_register_block_type([
	'name' => 'heading',
	'title'				=> __('Headline'),
	'description'		=> __('Basic Block for Headlines'),
	'render_template'	=> get_template_directory() . '/template-parts/bb-blocks/heading.php',
	'category'			=> 'wkmde-custom-blocks',
	'icon'				=> 'heading',
	'keywords'			=> [],
	'mode' => false,
]);