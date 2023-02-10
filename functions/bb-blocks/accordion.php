<?php

acf_register_block_type([
	'name' => 'accordion',
	'title' => 'Accordion',
	'description' => 'Accordion',
	'render_template' => get_template_directory() . '/template-parts/bb-blocks/accordion.php',
	'category' => 'wkmde-custom-blocks',
	'icon' => 'slides',
	'mode' => false,
]);
