<?php
// list all allowed block types here. custom block types need to be added here to appear
function custom_allowed_block_types($allowed_blocks)
{
	return array(
		//'core/paragraph',
		//'core/heading',
		'core/column',
		'core/columns',
		'acf/accordion',
		'acf/call-to-action',
	);
}
add_filter('allowed_block_types_all', 'custom_allowed_block_types');

// Custom Block Categories
function custom_block_category($categories, $post)
{
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'custom-blocks',
				'title' => __('Custom Blocks', 'custom-blocks'),
			),
		)
	);
}
add_filter('block_categories', 'custom_block_category', 10, 2);

// For Icons go to: https://developer.wordpress.org/resource/dashicons/ – But leave out the "dashicons-" Prefix
function register_acf_block_types()
{
	// acf_register_block_type([
	// 	'name' => 'swiper-spread',
	// 	'title'				=> __('Swiper Spread'),
	// 	'description'		=> __('Swiper for Spread Articles'),
	// 	'render_template'	=> 'template-parts/blocks/swiper-spread.php',
	// 	'category'			=> 'custom-blocks',
	// 	'icon'				=> 'slides',
	// 	'keywords'			=> [],
	// 	'mode' => 'edit',
	// ]);
	acf_register_block_type([
		'name' => 'accordion',
		'title' => __('Accordion'),
		'description' => __('An accordion'),
		'render_template' => 'template-parts/blocks/accordion.php',
		'category' => 'wkmde-custom-blocks',
		'icon' => 'slides',
		'keywords' => [],
		'mode' => false,
	]);
	acf_register_block_type([
		'name' => 'call-to-action',
		'title' => __('Call to Action'),
		'description' => __('Call to Action'),
		'render_template' => 'template-parts/blocks/call-to-action.php',
		'category' => 'wkmde-custom-blocks',
		'icon' => 'megaphone',
		'keywords' => [],
		'mode' => false
	]);
}
if (function_exists('acf_register_block_type')) {
	add_action('acf/init', 'register_acf_block_types');
}



