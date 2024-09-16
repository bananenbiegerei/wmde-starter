<?php function my_acf_collapse_field_groups() {
    // Only run the script on the options page
    if (get_current_screen()->id === 'settings_page_acf-options') {
        ?>
        <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                // Close all ACF field groups by default
                $('.acf-postbox').addClass('closed');
            });
        })(jQuery);
        </script>
        <?php
    }
}
add_action('acf/input/admin_head', 'my_acf_collapse_field_groups');
