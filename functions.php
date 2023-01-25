<?php

// Load localization functions
// Usage: `__('my example text', BB_TEXT_DOMAIN)`
// String translations can be edited with [Poedit](https://poedit.net)
require_once get_template_directory() . '/functions/localization.php';

// Special features of theme
require_once get_template_directory() . '/functions/features.php';

// Load custom ACF blocks
require_once get_template_directory() . '/functions/bb-blocks.php';

// Load styles & scripts
require_once get_template_directory() . '/functions/enqueue-scripts.php';

// Define menu locations
require_once get_template_directory() . '/functions/menu.php';

// Custom posts and taxonomies, edit as needed
// require_once(get_template_directory().'/functions/custom-posts.php');
// require_once(get_template_directory().'/functions/custom-taxonomies.php');

// Define some image sizes
// @Ingo: is this still needed?
// require_once get_template_directory() . '/functions/image-sizes.php';
