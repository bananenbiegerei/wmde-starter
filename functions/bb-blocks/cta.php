<?php

acf_register_block_type([
	'name' => 'cta',
	'title' => 'Call to Action',
	'description' => 'Call to Action block',
	'render_template' => get_template_directory() . '/template-parts/bb-blocks/cta.php',
	'category' => 'wkmde-custom-blocks',
	'icon' => 'slides',
	'supports' => ['align' => false],
	'mode' => false,
]);
