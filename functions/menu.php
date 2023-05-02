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
			$domain = new stdClass();
			$domain->ID = intval($m->object_id);
			$domain->title = $m->title;
			$domain->url = $m->url;
			$domain->excerpt = wp_strip_all_tags(get_the_excerpt($m->object_id), true);
			$domain->featured = [];
			$domain->pages = [];
			$domain->t_sections = [];
			$nav[] = $domain;
		} elseif ($m->title == BB_NAV_MENU_FEATURED) {
			$featured_id = $m->ID;
		} elseif ($m->url == '#') {
			$section_title_id = ['title' => $m->title, 'id' => $m->ID];
			$domain->t_sections["{$m->title}***{$m->ID}"] = [];
		} else {
			$page = new stdClass();
			$page->ID = intval($m->object_id);
			$page->title = $m->title;
			$page->url = $m->url;
			if ($m->menu_item_parent == $featured_id) {
				$page->excerpt = wp_strip_all_tags(get_the_excerpt($m->object_id), true);
				$page->thumbnail = get_the_post_thumbnail_url($m->object_id);
				$domain->featured[] = $page;
			} elseif ($m->menu_item_parent == $section_title_id['id']) {
				$domain->t_sections["{$section_title_id['title']}***{$section_title_id['id']}"][] = $page;
			} else {
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
