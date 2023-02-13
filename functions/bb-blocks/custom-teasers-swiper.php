<?php

acf_register_block_type([
	'name' => 'custom-teasers-swiper',
	'title' => __('Custom Teasers Swiper'),
	'description' => __('A scrolling list of teasers'),
	'render_template' => get_template_directory() . '/template-parts/bb-blocks/custom-teasers-swiper.php',
	'category' => 'wkmde-custom-blocks',
	'icon' => 'slides',
	'keywords' => [],
	'mode' => 'false',
]);
