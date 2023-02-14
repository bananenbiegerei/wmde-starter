<?php
acf_register_block_type([
	'name' => 'facts',
	'title' => __('Facts', BB_TEXT_DOMAIN),
	'description' => __('A list of facts', BB_TEXT_DOMAIN),
	'render_template' => 'template-parts/bb-blocks/facts.php',
	'category' => 'wkmde-custom-blocks',
	'icon' => 'slides',
	'keywords' => [],
	'mode' => 'false',
]);
