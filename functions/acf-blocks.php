<?php

// To override the options and force loading all of the blocks and force choosing default blocks
define('BB_LOAD_ALL_BB_BLOCKS', false);
define('BB_ALLOWED_WP_BLOCKS', []);

// Load bb-blocks
require_once get_template_directory() . '/bb-blocks/init.php';

// Custom toolbar for ACF WYSIWYG fields
function bb_acf_custom_wysiwyg_toolbar( $toolbars ) {
	$toolbars['BB Toolbar'] = array();
	$toolbars['BB Toolbar'][1] = array('bold', 'underline', 'bullist', 'numlist', 'link', 'unlink', 'removeformat','formatselect');
	return $toolbars;
}
add_filter( 'acf/fields/wysiwyg/toolbars', 'bb_acf_custom_wysiwyg_toolbar' );
