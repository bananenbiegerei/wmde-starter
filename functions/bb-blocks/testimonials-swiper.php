<?php

acf_register_block_type([
	'name' => 'testimonials-swiper',
	'title' => __('Testimonials Swiper'),
	'description' => __('A scrolling list of testimonials'),
	'render_template' => get_template_directory() . '/template-parts/bb-blocks/testimonials-swiper.php',
	'category' => 'wkmde-custom-blocks',
	'icon' => 'slides',
	'keywords' => [],
	'mode' => 'false',
]);
