<?php
register_taxonomy('project_types', 'projects', [
	'labels' => [
		'name' => __('Project Types', 'wkmde-theme'),
		'singular_name' => __('Project Type', 'wkmde-theme'),
		'all_items' => __('All Project Types', 'wkmde-theme'),
		'edit_item' => __('Edit Project Type', 'wkmde-theme'),
		'view_item' => __('View Project Type', 'wkmde-theme'),
		'update_item' => __('Update Project Type', 'wkmde-theme'),
		'add_new_item' => __('Add New Project Type', 'wkmde-theme'),
		'new_item_name' => __('New Project Type Name', 'wkmde-theme'),
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
		'name' => __('Categories', 'wkmde-theme'),
		'singular_name' => __('Category', 'wkmde-theme'),
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
