<?php

acf_register_block_type([
	'name' => 'button',
	'title'				=> __('Button'),
	'description'		=> __('Basic Block for Buttons'),
	'render_template'	=> get_template_directory() . '/template-parts/bb-blocks/button.php',
	'category'			=> 'wkmde-custom-blocks',
	'icon'				=> 'button',
	'keywords'			=> [],
	'mode' => false,
]);