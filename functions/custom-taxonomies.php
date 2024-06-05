<?php
register_taxonomy('project_types', 'projects', [
	'labels' => [
		'name' => __('Project Types', BB_TEXT_DOMAIN),
		'singular_name' => __('Project Type', BB_TEXT_DOMAIN),
		'all_items' => __('All Project Types', BB_TEXT_DOMAIN),
		'edit_item' => __('Edit Project Type', BB_TEXT_DOMAIN),
		'view_item' => __('View Project Type', BB_TEXT_DOMAIN),
		'update_item' => __('Update Project Type', BB_TEXT_DOMAIN),
		'add_new_item' => __('Add New Project Type', BB_TEXT_DOMAIN),
		'new_item_name' => __('New Project Type Name', BB_TEXT_DOMAIN),
	],
	'public' => true,
	'publicly_queryable' => true,
	'hierarchical' => false,
	'show_ui' => true,
	'show_in_menu' => true,
	'show_in_nav_menus' => true,
	'query_var' => true,
	'show_admin_column' => true,
	'show_in_rest' => true,
	'show_in_quick_edit' => false,
]);

register_taxonomy('team_category', 'team', [
	'labels' => [
		'name' => __('Team sections', BB_TEXT_DOMAIN),
		'singular_name' => __('Team section', BB_TEXT_DOMAIN),
	],
	'public' => true,
	'publicly_queryable' => true,
	'hierarchical' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	'show_in_nav_menus' => true,
	'query_var' => true,
	'show_admin_column' => true,
	'show_in_rest' => true,
	'show_in_quick_edit' => false,
]);

register_taxonomy(
	'format',
	['post', 'page', 'projects'],
	[
		'labels' => [
			'name' => __('Formats', BB_TEXT_DOMAIN),
			'singular_name' => __('Format', BB_TEXT_DOMAIN),
		],
		'public' => true,
		'publicly_queryable' => true,
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'show_in_quick_edit' => false,
	],
);

register_taxonomy(
	'theme',
	['post', 'page', 'projects', 'tribe_events', 'theme-releases', 'publications'],
	[
		'labels' => [
			'name' => __('Thema', BB_TEXT_DOMAIN),
			'singular_name' => __('Themen', BB_TEXT_DOMAIN),
		],
		'public' => true,
		'publicly_queryable' => true,
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'show_in_quick_edit' => false,
	],
);
