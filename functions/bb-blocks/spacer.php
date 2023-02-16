<?php

acf_register_block_type([
	'name' => 'spacer',
	'title' => 'Spacer',
	'description' => 'Different Spaces to make nice and regulated white spaces',
	'render_template' => get_template_directory() . '/template-parts/bb-blocks/spacer.php',
	'category' => 'wkmde-custom-blocks',
	'icon' => 'editor-expand',
	'mode' => false,
]);
