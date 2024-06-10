<?php

// To override the options and force loading all of the blocks and force choosing default blocks
define('BB_LOAD_ALL_BB_BLOCKS', false);
define('BB_ALLOWED_WP_BLOCKS', []);

// Load bb-blocks
require_once get_template_directory() . '/bb-blocks/init.php';
