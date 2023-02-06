<?php

acf_register_block_type([
	'name' => 'card',
	'title' => 'Card',
	'description' => 'Card Block',
	'render_template' => get_template_directory() . '/template-parts/bb-blocks/card.php',
	'category' => 'wkmde-custom-blocks',
	'supports' => ['align' => false],
	'mode' => false,
	'icon' => 'slides',
]);
