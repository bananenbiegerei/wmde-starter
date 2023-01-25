<?php
// %%%%%%%%%% Title Tag
add_theme_support('title-tag');

// %%%%%%%%%% Custom Excerpt Length %%%%%%%%%
function custom_excerpt_length($length)
{
	return 30;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

// function new_excerpt_more( $more ) {
// 	return ' …<br><a class="read-more small" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Mehr <span class="material-icons">arrow_right_alt</span>' ) . '</a>';
// }
// add_filter( 'excerpt_more', 'new_excerpt_more' );

// %%%%%%%%% Post Thumbnails
add_theme_support('post-thumbnails', ['post', 'page']);

// %%%%%%%% SVG Support in Media
function svg_support($svg_mime)
{
	$svg_mime['svg'] = 'image/svg+xml';
	return $svg_mime;
}
add_filter('upload_mimes', 'svg_support');

// Disable admin bar in site view
show_admin_bar(false);

// Debug to console
function clog($var)
{
	$json = json_encode($var);
	echo "<script>console.log($json)</script>";
}

// ACF Options Page
if (function_exists('acf_add_options_page')) {
	acf_add_options_page();
}
