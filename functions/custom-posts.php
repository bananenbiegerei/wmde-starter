<?php

function custom_post_types()
{
    register_post_type('projects', [
        'labels' => [
            'name' => __('Projects'),
            'singular_name' => __('Project'),
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'author'],
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-clipboard',
    ]);

    register_post_type('team', [
        'labels' => [
            'name' => __('Team Members'),
            'singular_name' => __('Team Member'),
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'thumbnail'],
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-groups',
    ]);

    register_post_type('cta', [
        'labels' => [
            'name' => __('Calls to Action'),
            'singular_name' => __('Call to Action'),
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-megaphone',
    ]);

    register_post_type('testimonials', [
        'labels' => [
            'name' => __('Testimonials'),
            'singular_name' => __('Testimonial'),
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-format-quote',
    ]);

    // register_post_type('specialevents', [
    //     'labels' => [
    //         'name' => __('Special Events'),
    //         'singular_name' => __('Special Event'),
    //     ],
    //     'public' => true,
    //     'has_archive' => true,
    //     'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
    //     'show_in_rest' => true,
    //     'menu_icon' => 'dashicons-tickets-alt',
    // ]);
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



function press_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Pressemitteilungen', 'Post Type General Name', 'wkmde-theme' ),
		'singular_name'         => _x( 'Pressemitteilung', 'Post Type Singular Name', 'wkmde-theme' ),
		'menu_name'             => __( 'Pressemitteilungen', 'wkmde-theme' ),
		'name_admin_bar'        => __( 'Pressemitteilung', 'wkmde-theme' ),
		'archives'              => __( 'Pressemitteilungen-Archiv', 'wkmde-theme' ),
		'attributes'            => __( 'Pressemitteilungen-Attribute', 'wkmde-theme' ),
		'parent_item_colon'     => __( 'Parent Item:', 'wkmde-theme' ),
		'all_items'             => __( 'Alle Pressemitteilungen', 'wkmde-theme' ),
		'add_new_item'          => __( 'Pressemitteilung hinzufügen', 'wkmde-theme' ),
		'add_new'               => __( 'Neue Pressemitteilung hinzufügen', 'wkmde-theme' ),
		'new_item'              => __( 'Neue Pressemitteilung', 'wkmde-theme' ),
		'edit_item'             => __( 'Pressemitteilung bearbeiten', 'wkmde-theme' ),
		'update_item'           => __( 'Pressemitteilung updaten', 'wkmde-theme' ),
		'view_item'             => __( 'Pressemitteilung ansehen', 'wkmde-theme' ),
		'view_items'            => __( 'Pressemitteilungen ansehen', 'wkmde-theme' ),
		'search_items'          => __( 'Pressemitteilung suchen', 'wkmde-theme' ),
		'not_found'             => __( 'Nicht gefunden', 'wkmde-theme' ),
		'not_found_in_trash'    => __( 'Nicht im Papierkorb gefunden', 'wkmde-theme' ),
		'featured_image'        => __( 'Beitragsbild', 'wkmde-theme' ),
		'set_featured_image'    => __( 'Beitragsbild auswählen', 'wkmde-theme' ),
		'remove_featured_image' => __( 'Beitragsbild entfernen', 'wkmde-theme' ),
		'use_featured_image'    => __( 'Als Beitragsbild benutzen', 'wkmde-theme' ),
		'insert_into_item'      => __( 'In Pressemitteilung einfügen', 'wkmde-theme' ),
		'uploaded_to_this_item' => __( 'Zu Pressemitteilung hochladen', 'wkmde-theme' ),
		'items_list'            => __( 'Pressemitteilungen-Liste', 'wkmde-theme' ),
		'items_list_navigation' => __( 'Items list navigation', 'wkmde-theme' ),
		'filter_items_list'     => __( 'Filter items list', 'wkmde-theme' ),
	);
	$args = array(
		'label'                 => __( 'Pressemitteilung', 'wkmde-theme' ),
		'description'           => __( 'Custom Post Type für Pressemitteilungen', 'wkmde-theme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-testimonial',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'pressemitteilungen',
        // 'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
        'rewrite' => array('slug' => 'pressemitteilungen'),
        'show_in_rest' => true,
	);
	register_post_type( 'press-releases', $args );

}
add_action( 'init', 'press_custom_post_type', 0 );