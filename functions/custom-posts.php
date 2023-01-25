<?php
function custom_post_type() {
	register_post_type('shop-items',
	array(
		'labels'      => array(
			'name'          => __('Shop Items'),
			'singular_name' => __('Shop Item'),
		),
		'public'      => true,
		'has_archive' => true,
		'supports' => array( 'title', 'thumbnail', 'editor', 'revisions')
	)
);
register_post_type('booklets',
array(
	'labels'      => array(
		'name'          => __('Booklets'),
		'singular_name' => __('Booklet'),
	),
	'public'      => true,
	'has_archive' => true,
	'supports' => array( 'title', 'thumbnail', 'editor', 'revisions')
)
);
