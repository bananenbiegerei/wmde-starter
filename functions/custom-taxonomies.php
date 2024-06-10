<?php

register_taxonomy('project_types', 'projects', [
    'labels' => [
        'name' => __('Projekttypen', BB_TEXT_DOMAIN),
        'singular_name' => __('Projekttyp', BB_TEXT_DOMAIN),
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
