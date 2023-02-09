<?php

function custom_post_types()
{
	register_post_type('projects', [
		'labels' => [
			'name' => __('Projects', BB_TEXT_DOMAIN),
			'singular_name' => __('Project', BB_TEXT_DOMAIN),
		],
		'public' => true,
		'has_archive' => true,
		'supports' => ['title', 'editor', 'thumbnail', 'author'],
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-clipboard',
	]);

	register_post_type('team', [
		'labels' => [
			'name' => __('Team Members', BB_TEXT_DOMAIN),
			'singular_name' => __('Team Member', BB_TEXT_DOMAIN),
		],
		'public' => true,
		'has_archive' => true,
		'supports' => ['title', 'thumbnail'],
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-groups',
	]);

	register_post_type('testimonials', [
		'labels' => [
			'name' => __('Testimonials', BB_TEXT_DOMAIN),
			'singular_name' => __('Testimonial', BB_TEXT_DOMAIN),
		],
		'public' => true,
		'has_archive' => true,
		'supports' => ['title', 'editor', 'thumbnail'],
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-format-quote',
	]);
}
add_action('init', 'custom_post_types');

add_filter('register_post_type_args', 'action_week_events_rewrite_slug', 10, 2);
function action_week_events_rewrite_slug($args, $post_type)
{
	if ('action_week_events' === $post_type) {
		$args['rewrite']['slug'] = 'aktionswoche';
	}

	return $args;
}

function press_custom_post_type()
{
	$labels = [
		'name' => _x('Pressemitteilungen', 'Post Type General Name', BB_TEXT_DOMAIN),
		'singular_name' => _x('Pressemitteilung', 'Post Type Singular Name', BB_TEXT_DOMAIN),
		'menu_name' => __('Pressemitteilungen', BB_TEXT_DOMAIN),
		'name_admin_bar' => __('Pressemitteilung', BB_TEXT_DOMAIN),
		'archives' => __('Pressemitteilungen-Archiv', BB_TEXT_DOMAIN),
		'attributes' => __('Pressemitteilungen-Attribute', BB_TEXT_DOMAIN),
		'parent_item_colon' => __('Parent Item:', BB_TEXT_DOMAIN),
		'all_items' => __('Alle Pressemitteilungen', BB_TEXT_DOMAIN),
		'add_new_item' => __('Pressemitteilung hinzufügen', BB_TEXT_DOMAIN),
		'add_new' => __('Neue Pressemitteilung hinzufügen', BB_TEXT_DOMAIN),
		'new_item' => __('Neue Pressemitteilung', BB_TEXT_DOMAIN),
		'edit_item' => __('Pressemitteilung bearbeiten', BB_TEXT_DOMAIN),
		'update_item' => __('Pressemitteilung updaten', BB_TEXT_DOMAIN),
		'view_item' => __('Pressemitteilung ansehen', BB_TEXT_DOMAIN),
		'view_items' => __('Pressemitteilungen ansehen', BB_TEXT_DOMAIN),
		'search_items' => __('Pressemitteilung suchen', BB_TEXT_DOMAIN),
		'not_found' => __('Nicht gefunden', BB_TEXT_DOMAIN),
		'not_found_in_trash' => __('Nicht im Papierkorb gefunden', BB_TEXT_DOMAIN),
		'featured_image' => __('Beitragsbild', BB_TEXT_DOMAIN),
		'set_featured_image' => __('Beitragsbild auswählen', BB_TEXT_DOMAIN),
		'remove_featured_image' => __('Beitragsbild entfernen', BB_TEXT_DOMAIN),
		'use_featured_image' => __('Als Beitragsbild benutzen', BB_TEXT_DOMAIN),
		'insert_into_item' => __('In Pressemitteilung einfügen', BB_TEXT_DOMAIN),
		'uploaded_to_this_item' => __('Zu Pressemitteilung hochladen', BB_TEXT_DOMAIN),
		'items_list' => __('Pressemitteilungen-Liste', BB_TEXT_DOMAIN),
		'items_list_navigation' => __('Items list navigation', BB_TEXT_DOMAIN),
		'filter_items_list' => __('Filter items list', BB_TEXT_DOMAIN),
	];
	$args = [
		'label' => __('Pressemitteilung', BB_TEXT_DOMAIN),
		'description' => __('Custom Post Type für Pressemitteilungen', BB_TEXT_DOMAIN),
		'labels' => $labels,
		'supports' => ['title', 'editor', 'thumbnail', 'custom-fields', 'excerpt'],
		'taxonomies' => ['category', 'post_tag'],
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-testimonial',
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => 'pressemitteilungen',
		// 'has_archive'           => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
		'rewrite' => ['slug' => 'pressemitteilungen'],
		'show_in_rest' => true,
	];
	register_post_type('press-releases', $args);
}
add_action('init', 'press_custom_post_type', 0);
