<?php

// Get list of sites
function bb_get_sites()
{
	global $wpdb;
	if (!is_multisite()) {
		return [1 => (object) ['blog_id' => 1, 'site_id' => 1, 'path' => '/', 'domain' => $_SERVER['SERVER_NAME']]];
	}
	$sites = [];
	foreach ($wpdb->get_results("SELECT * FROM {$wpdb->prefix}blogs;") as $site) {
		$sites[$site->blog_id] = $site;
	}
	return $sites;
}

function bb_find_post_data($url)
{
	if (!is_multisite()) {
		return bb_get_post_data($url);
	}

	$post_data = null;
	foreach (array_keys(bb_get_sites()) as $blog_id) {
		switch_to_blog($blog_id);
		if ($post_data = bb_get_post_data($url)) {
			$post_data['blog_id'] = $blog_id;
			restore_current_blog();
			break;
		} else {
			restore_current_blog();
		}
	}
	return $post_data;
}

function bb_get_post_data($url)
{
	if ($local_post_id = url_to_postid($url)) {
		$local_post = get_post($local_post_id);
		// Get themes and formats
		$theme = [];
		$format = [];
		foreach (wp_get_post_terms($local_post_id, ['format', 'theme']) as $term) {
			if ($term->taxonomy == 'format') {
				$format[] = $term->name;
			}
			if ($term->taxonomy == 'theme') {
				$theme[] = $term->name;
			}
		}
		return [
			'title' => $local_post->post_title,
			'text' => $local_post->post_excerpt,
			'image' => get_post_thumbnail_id($local_post_id),
			'post_type' => get_post_type($local_post_id),
			'format' => $format,
			'theme' => $theme,
		];
	}
	return null;
}

function bb_get_multisite_attachment_image($blog_id, $image, $size, $classes)
{
	if (is_multisite()) {
		switch_to_blog($blog_id);
	}
	$img = wp_get_attachment_image($image, $size, false, $classes);
	if (is_multisite()) {
		restore_current_blog();
	}
	return $img;
}
