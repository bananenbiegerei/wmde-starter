<?php

add_action(
	'init',
	function () {
		register_post_type('projects', [
			'labels' => [
				'name' => __('Projects', BB_TEXT_DOMAIN),
				'singular_name' => __('Project', BB_TEXT_DOMAIN),
			],
			'public' => true,
			'has_archive' => true,
			'supports' => ['title', 'editor', 'thumbnail', 'author', 'excerpt'],
			'show_in_rest' => true,
			'menu_icon' => 'dashicons-clipboard',
		]);

		// NOTE: CPT declaration 'team' moved to blocks/team-members/

		register_post_type('testimonials', [
			'labels' => [
				'name' => __('Testimonials', BB_TEXT_DOMAIN),
				'singular_name' => __('Testimonial', BB_TEXT_DOMAIN),
			],
			'public' => false,
			'show_ui' => true,
			'has_archive' => true,
			'supports' => ['title', 'editor', 'thumbnail'],
			'show_in_rest' => true,
			'menu_icon' => 'dashicons-format-quote',
		]);

		register_post_type('publications', [
			'labels' => [
				'name' => __('Publikationen', BB_TEXT_DOMAIN),
				'singular_name' => __('Publikation', BB_TEXT_DOMAIN),
			],
			'public' => true,
			'has_archive' => true,
			'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
			'show_in_rest' => true,
			'menu_icon' => 'dashicons-book',
		]);

		register_post_type('press-releases', [
			'labels' => [
				'name' => _x('Pressemitteilungen', 'Post Type General Name', BB_TEXT_DOMAIN),
				'singular_name' => _x('Pressemitteilung', 'Post Type Singular Name', BB_TEXT_DOMAIN),
			],
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
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'capability_type' => 'page',
			'rewrite' => ['slug' => 'pressemitteilungen-archive'],
			'show_in_rest' => true,
		]);

		register_post_type('theme-releases', [
			'description' => __('Custom Post Type für Themen', BB_TEXT_DOMAIN),
			'labels' => [
				'name' => _x('Themen', 'Post Type General Name', BB_TEXT_DOMAIN),
				'singular_name' => _x('Thema', 'Post Type Singular Name', BB_TEXT_DOMAIN),
			],
			'supports' => ['title', 'editor', 'thumbnail', 'custom-fields', 'excerpt'],
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'menu_icon' => 'dashicons-megaphone',
			'show_in_admin_bar' => true,
			'show_in_nav_menus' => true,
			'can_export' => true,
			'has_archive' => 'Themen',
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'capability_type' => 'page',
			'rewrite' => ['slug' => 'themen'],
			'show_in_rest' => true,
		]);
	},
	0,
);
