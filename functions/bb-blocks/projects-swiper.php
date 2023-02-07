<?php

acf_register_block_type([
	'name' => 'projects-swiper',
	'title' => __('Projects Swiper'),
	'description' => __('A scrolling list of projects'),
	'render_template' => get_template_directory() . '/template-parts/bb-blocks/projects-swiper.php',
	'category' => 'wkmde-custom-blocks',
	'icon' => 'slides',
	'keywords' => [],
	'mode' => false,
]);
