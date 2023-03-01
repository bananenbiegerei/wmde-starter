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
	foreach ($menu_array as $m) {
		if (empty($m->menu_item_parent)) {
			$domain = new stdClass();
			$domain->ID = $m->object_id;
			$domain->title = $m->title;
			$domain->url = $m->url;
			$domain->excerpt = wp_strip_all_tags(get_the_excerpt($m->object_id), true);
			$domain->featured = [];
			$domain->pages = [];
			$domain->sections = [];
			$nav[] = $domain;
		} elseif ($m->title == BB_NAV_MENU_FEATURED) {
			$featured_id = $m->ID;
		} elseif ($m->url == '#') {
			$section_title_id = ['title' => $m->title, 'id' => $m->ID];
			$domain->sections["{$m->title}#{$m->ID}"] = [];
		} else {
			$page = new stdClass();
			$page->ID = $m->object_id;
			$page->title = $m->title;
			$page->url = $m->url;
			if ($m->menu_item_parent == $featured_id) {
				$page->excerpt = wp_strip_all_tags(get_the_excerpt($m->object_id), true);
				$page->thumbnail = get_the_post_thumbnail_url($m->object_id);
				$domain->featured[] = $page;
			} elseif ($m->menu_item_parent == $section_title_id['id']) {
				$domain->sections["{$section_title_id['title']}#{$section_title_id['id']}"][] = $page;
			} else {
				$domain->pages[] = $page;
			}
		}
	}
	return $nav;
}

function is_current_menu($id)
{
	global $post;
	echo $post->ID == get_post_meta(intval($id), '_menu_item_object_id', true) ? 'current' : '';
}

// FIXME: remove those if unused
function bb_get_menu_array($current_menu = 'Main Menu', $limit = 99999)
{
	function _bb_get_menu_array_sub($menu_array, $menu_item, $depth)
	{
		$depth--;
		$children = [];
		if (!empty($menu_array)) {
			foreach ($menu_array as $k => $m) {
				if ($m->menu_item_parent == $menu_item->ID) {
					$children[] = [
						'ID' => $m->object_id,
						'title' => $m->title,
						'url' => $m->url,
						'children' => _bb_get_menu_array_sub($menu_array, $m, $depth),
					];
					unset($menu_array[$k]);
				}
			}
		}
		return $children;
	}

	$menu_array = wp_get_nav_menu_items($current_menu);
	$menu = [];
	foreach ($menu_array as $m) {
		if (empty($m->menu_item_parent)) {
			$menu[] = [
				'ID' => $m->object_id,
				'title' => $m->title,
				'url' => $m->url,
				'children' => _bb_get_menu_array_sub($menu_array, $m, 2),
			];
		}
	}
	foreach ($menu as $i => $l0) {
		$menu[$i]['children'] = array_merge($l0['children'], array_slice(_bb_get_menu_array_child_pages_sub($l0['ID']), 0, $limit));
		foreach ($menu[$i]['children'] as $j => $l1) {
			$menu[$i]['children'][$j]['children'] = array_merge($menu[$i]['children'][$j]['children'], array_slice(_bb_get_menu_array_child_pages_sub($l1['ID']), 0, $limit));
		}
	}
	return $menu;
}
