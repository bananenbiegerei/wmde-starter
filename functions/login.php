<?php
function enqueue_custom_login_script() {
    // Enqueue your custom login script
    wp_enqueue_script('custom-login', get_template_directory_uri() . '/js/login.js', [], null, true);

    // Get the logo URL from ACF
    $logo_url = get_field('logo_small', 'options');

    // Pass the logo URL to JavaScript
    wp_localize_script('custom-login', 'customLoginData', [
        'logoUrl' => $logo_url,
    ]);
}
add_action('login_enqueue_scripts', 'enqueue_custom_login_script');