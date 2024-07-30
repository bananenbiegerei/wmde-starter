<?php

/* Todo
- support uploading fonts?
- add support for different styles (normal / italic ?)
*/


define('BB_FONTS_DIR', 'fonts');

// Debug stuff...
add_action('xinit', function () {
    // echo '<pre>';
    // var_dump(get_fields('options'));
    // echo '</pre>';
    // die;
});


function bb_list_available_fonts()
{
    $fonts = glob(get_template_directory() . '/'. BB_FONTS_DIR . '/*');
    $fonts = array_map('basename', $fonts);
    return $fonts;
}

add_filter('acf/load_field/name=custom_font_file', function ($field) {
    $field['choices'] = bb_list_available_fonts();
    return $field;
});


function bb_get_font_format($filename)
{
    $types = [
        'ttf' => 'truetype',
        'woff2' => 'woff2',
        'woff' => 'woff'
    ];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return $types[$ext];
}

function bb_inline_style_fonts()
{
    $theme_uri = get_template_directory_uri();
    $bb_fonts_css = "/* Custom Fonts */\n";
    foreach ([ 'h' => 'Headings', 't' => 'Texts'] as $k => $l) {
        while (have_rows('fonts_' . $k, 'options')) {
            the_row();
            $filename = get_sub_field('custom_font_file');
            $weight = get_sub_field('custom_font_weight');
            $weight = $weight == 'variable' ? '100 700' : $weight;
            $format = bb_get_font_format($filename);
            $bb_fonts_css .= "
                @font-face {
                    font-family: '{$l}';
                    font-style: normal;
                    font-weight: {$weight};
                    font-display: swap;
                    src: url('{$theme_uri}/fonts/{$filename}') format('{$format}');
                }";
            $bb_fonts_css .= "\n";
        }
    }
    return $bb_fonts_css;
}

// Add custom colors to stylesheet
add_action(
    'wp_enqueue_scripts',
    function () {
        // if (get_field('use_custom_colors', 'options')) {
        wp_add_inline_style('style', bb_inline_style_fonts());
    // }
    },
    PHP_INT_MAX
);
