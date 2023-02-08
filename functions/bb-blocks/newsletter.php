<?php

acf_register_block_type([
	'name' => 'newsletter',
	'title' => 'Newsletter Registration',
	'description' => 'Newsletter Registration Block',
	'render_template' => get_template_directory() . '/template-parts/bb-blocks/newsletter.php',
	'category' => 'wkmde-custom-blocks',
	'supports' => ['align' => false],
	'mode' => false,
	'icon' => 'slides',
]);
