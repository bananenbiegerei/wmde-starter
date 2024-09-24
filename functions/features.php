<?php

// PHP function to debug a PHP variable to the JS console
function clog($var)
{
    $json = json_encode($var);
    echo "<script>console.log($json)</script>";
}


add_action('acf/init', function () {
    // Enable ACF options page
    if (function_exists('acf_add_options_page')) {
        acf_add_options_sub_page(
            [
                 'page_title' => __('Theme Settings', BB_TEXT_DOMAIN),
                 'menu_title' => __('Theme Settings', BB_TEXT_DOMAIN),
                 'menu_slug' => 'acf-options',
                 'capability' => 'edit_posts',
                 'parent_slug' => 'options-general.php',
                'position' => 1
    ]
        );
    }
});


//Remove JQuery migrate
add_action('wp_default_scripts', function ($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            // Check whether the script has any dependencies
            $script->deps = array_diff($script->deps, ['jquery-migrate']);
        }
    }
});

// Disable admin bar in site view
show_admin_bar(false);

// Add support for thumbnails and excerpts
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails', ['post', 'page']);
    add_post_type_support('page', 'excerpt');
});

// Set custom excerpt length
add_filter(
    'excerpt_length',
    function ($length) {
        return 20;
    },
    999
);

// Allow administrators to insert iframes to posts
add_action(
    'init',
    function () {
        if (in_array('administrator', (array) wp_get_current_user()->roles)) {
            kses_remove_filters();
        }
    },
    11
);
