<?php

acf_register_block_type([
	'name' => 'image',
	'title' => __('Image'),
	'description' => __('Custom image block'),
	'render_template' => get_template_directory() . '/template-parts/bb-blocks/image.php',
	'category' => 'wkmde-custom-blocks',
	'icon' => 'format-image',
	'mode' => false,
]);
