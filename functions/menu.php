<?php

// Register navigation menus
add_action('init', function () {
	$locations = [
		'nav' => 'Top Navigation Menu',
		'footer' => __('Footer', BB_TEXT_DOMAIN),
	];
	register_nav_menus($locations);
});

// For new top navigation
define('BB_NAV_MENU_FEATURED', 'Featured');

function bb_get_nav_menu($location = 'nav')
{
	$menu = wp_get_nav_menu_name($location);
	if ($menu === '') {
		return [];
	}
	$nav = [];
	$featured_id = null;
	$section_title_id = ['title' => null, 'id' => null];
	$menu_array = wp_get_nav_menu_items($menu);
	$menu_item_IDs = array_map(function ($a) {
		return $a->ID;
	}, $menu_array);

	foreach ($menu_array as $m) {
		if (empty($m->menu_item_parent) || !in_array($m->menu_item_parent, $menu_item_IDs)) {
			// If item has no parent, then it's a domain (top-level)
			$domain = new stdClass();
			$domain->ID = intval($m->object_id);
			$domain->title = $m->title;
			$domain->url = $m->url;
			$domain->excerpt = wp_strip_all_tags(get_the_excerpt($m->object_id), true);
			$domain->featured = [];
			$domain->pages = [];
			$domain->t_sections = [];
			$domain->children = [];
			$nav[] = $domain;
		} elseif ($m->title == BB_NAV_MENU_FEATURED) {
			// If the title is BB_NAV_MENU_FEATURED, the next items will be featured pages
			$featured_id = $m->ID;
		} elseif ($m->url == '#') {
			// If the url is '#' it's a section title
			$section_title_id = ['title' => $m->title, 'id' => $m->ID];
			$domain->t_sections["{$m->title}***{$m->ID}"] = [];
		} else {
			// Otherwise it's a normal page
			$page = new stdClass();
			$page->ID = intval($m->object_id);
			$page->title = $m->title;
			$page->url = $m->url;
			$page->domain_id = $domain->ID;
			$domain->children[] = $page->ID;
			if ($m->menu_item_parent == $featured_id) {
				// If it's a featured page, add it to the domain's featured pages
				$page->excerpt = wp_strip_all_tags(get_the_excerpt($m->object_id), true);
				$page->thumbnail = get_the_post_thumbnail_url($m->object_id, 'medium');
				$domain->featured[] = $page;
			} elseif ($m->menu_item_parent == $section_title_id['id']) {
				// If it's part of a section, add it to the current section
				$domain->t_sections["{$section_title_id['title']}***{$section_title_id['id']}"][] = $page;
			} else {
				// Otherwise it's a normal page of that domain
				$domain->pages[] = $page;
			}
		}
	}
	foreach ($nav as $domain) {
		$domain->sections = [];
		foreach ($domain->t_sections as $title => $section) {
			$s = new stdClass();
			$s->title = explode('***', $title)[0];
			$s->pages = $section;
			$domain->sections[] = $s;
		}
		unset($domain->t_sections);
	}

	return $nav;
}

function is_current_menu($id)
{
	global $post;
	echo $post->ID == get_post_meta(intval($id), '_menu_item_object_id', true) ? 'current' : '';
}
