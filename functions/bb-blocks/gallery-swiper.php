<?php
acf_register_block_type([
	'name' => 'gallery-swiper',
	'title' => __('Gallery Swiper'),
	'description' => __('An image gallery with swiper'),
	'render_template' => 'template-parts/bb-blocks/gallery-swiper.php',
	'category' => 'wkmde-custom-blocks',
	'icon' => 'slides',
	'keywords' => [],
]);
