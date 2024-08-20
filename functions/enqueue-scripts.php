<?php

// Site scripts and style
add_action(
    'wp_enqueue_scripts',
    function () {
        // Site javascript, loaded with defer
        wp_enqueue_script('site', get_template_directory_uri() . '/js/site.js', ['jquery'], '', ['in_footer' => true, 'strategy' => 'defer']);
        // Allow easy editing of post with `CTLR-E`
        if (current_user_can('edit_post', get_the_ID())) {
            $post_edit_url = get_edit_post_link(get_the_ID(), '&');
            $script = <<<EOF
			var postEditURL = "$post_edit_url";
			document.addEventListener('keydown', function (event) {
			event = event || window.event;
			if(event.keyCode == 69 && event.ctrlKey) { window.open(postEditURL, '_blank'); }
			});
			EOF;
            wp_add_inline_script('site', $script);
        }

        // Threaded comment reply styles.
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        // Site style
        wp_enqueue_style('style', get_template_directory_uri() . '/css/site.css', [], '', 'all');
    },
    999
);

// Editor style and script: only enqueue if editing a post
add_action(
    'admin_enqueue_scripts',
    function () {
        global $pagenow;
        if ($pagenow == 'post.php' || $pagenow == 'post-new.php') {
            wp_enqueue_script('editor-addon', get_template_directory_uri() . '/js/editor.js', ['jquery', 'acf-input'], '', false);
            wp_enqueue_style('editor-wmde', get_template_directory_uri() . '/css/editor.css', [], '', 'all');
        }
        wp_enqueue_script('admin', get_template_directory_uri() . '/js/admin.js', ['jquery'], '', false);
        if (current_user_can('administrator')) {
            $acf_url = get_admin_url() . '/edit.php?post_type=acf-field-group';
            if (is_multisite()) {
                $migrate_db_url = network_admin_url() . '/settings.php?page=wp-migrate-db-pro';
            } else {
                $migrate_db_url = get_admin_url() . '/settings.php?page=wp-migrate-db-pro';
            }
            $script = <<<EOF
            document.addEventListener('keydown', function (event) {
                event = event || window.event;
                if (event.key == 'a' && event.ctrlKey) {
                    window.open('$acf_url', '_blank');
                } else if (event.key == 'm' && event.ctrlKey) {
                    window.open('$migrate_db_url', '_blank');
                }
              });
            EOF;
            wp_add_inline_script('admin', $script);
        }
    },
    999
);

// style for wysiwyg editor
function bb_add_custom_editor_styles($mce_css)
{
    if (! empty($mce_css)) {
        $mce_css .= ',';
    }

    // Adjust the path to where your custom CSS file is located
    $mce_css .= get_template_directory_uri() . '/css/editor.css';

    return $mce_css;
}
add_filter('mce_css', 'bb_add_custom_editor_styles');
