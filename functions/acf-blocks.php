<?php

// Define this to limit which blocks will be loaded
//define('WMDE_ALLOWED_BB_BLOCKS', ['image', 'card']);

define('WMDE_ALLOWED_WP_BLOCKS', ['core/group', 'core/column', 'core/columns', 'core/html', 'core/file']);

require_once get_template_directory() . '/blocks/init.php';
