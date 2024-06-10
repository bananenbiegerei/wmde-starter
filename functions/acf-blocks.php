<?php

// Check if ACF Pro is installed
if (!function_exists('acf_register_block_type')) {
    add_action('admin_notices', function () {
        echo '<div class="notice notice-error"><p><b>WMDE Starter Theme:</b> ' .
          __('Required plugin "Advanced Custom Fields" is missing. Please install and activate.', BB_TEXT_DOMAIN) .
          '</p></div>';
    });
    return;
}

// To override the options and force loading all of the blocks and force choosing default blocks
define('BB_LOAD_ALL_BB_BLOCKS', false);
define('BB_ALLOWED_WP_BLOCKS', []);

// Load bb-blocks
require_once get_template_directory() . '/bb-blocks/init.php';
