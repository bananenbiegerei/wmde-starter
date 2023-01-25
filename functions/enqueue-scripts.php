<?php

// Add option to defer loading of scripts
function bb_script_loader_tag($tag, $handle, $src)
{
	if (strstr($handle, ':defer')) {
		$tag = str_replace('<script ', '<script defer ', $tag);
	}
	return $tag;
}
add_filter('script_loader_tag', 'bb_script_loader_tag', 10, 3);

function site_scripts()
{
	//JS
	wp_enqueue_script('site:defer', get_template_directory_uri() . '/dist/js/app.js', ['jquery'], '', false);
	// CSS
	wp_enqueue_style('style', get_template_directory_uri() . '/dist/css/style.css', [], '', 'all');
}
add_action('wp_enqueue_scripts', 'site_scripts', 999);
