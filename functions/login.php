<?php
function custom_login_logo() {
    $logo_mini = get_field('logo_small', 'option');
    if ($logo_mini) {
        echo '<style type="text/css">
            .login h1 a {
                background-image: url(' . esc_url($logo_mini) . ');
            }
        </style>';
    }
}
add_action('login_enqueue_scripts', 'custom_login_logo');