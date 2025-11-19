<?php

/* Todo
- add support for different styles (normal / italic ?)
*/

add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes, $real_mime) {
    if (! empty($data['ext']) && ! empty($data['type'])) {
        return $data;
    }
    $wp_file_type = wp_check_filetype($filename, $mimes);
    switch ($wp_file_type['ext']) {
        case 'ttf':
            $data['ext'] = 'ttf';
            $data['type'] = 'font/ttf';
            break;
        case 'woff':
            $data['ext'] = 'woff';
            $data['type'] = 'font/woff';
            break;
        case 'woff2':
            $data['ext'] = 'woff2';
            $data['type'] = 'font/woff2';
            break;
    }
    return $data;
}, 10, 5);


add_filter('upload_mimes', function ($mimes) {
    $mimes['ttf']   = 'font/ttf';
    $mimes['woff']  = 'font/woff';
    $mimes['woff2'] = 'font/woff2';
    return $mimes;
});

// Debug stuff...
add_action('xinit', function () {
    echo '<pre>';
    var_dump(get_fields('options'));
    echo '</pre>';
    die;
});


function bb_list_available_fonts()
{
    $fonts = [];
    $args = array('post_type'=>'attachment','numberposts'=>null,'post_status'=>null);
    $attachments = get_posts($args);
    foreach ($attachments as $attachment) {
        if (!str_starts_with($attachment->post_mime_type, 'font/')) {
            continue;
        }
        $fonts[] = wp_get_attachment_url($attachment->ID);
    }
    return $fonts;
}

add_filter('acf/load_field/name=custom_font_file', function ($field) {
    $field['choices'] =[];
    foreach (bb_list_available_fonts() as $font) {
        $field['choices'][$font] = basename($font);
    }
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
    $bb_fonts_css = "/* Custom Fonts */\n";
    foreach ([ 'h' => 'Headings', 't' => 'Texts', 'm' => 'Menus' ] as $k => $l) {
        while (have_rows('fonts_' . $k, 'options')) {
            the_row();
            $name = get_sub_field('custom_font_file')['label'];
            $uri = get_sub_field('custom_font_file')['value'];
            if ($k == 'h' || $k == 'm') {
                $weight = "100 700";
            } else {
                $weight = get_sub_field('custom_font_weight');
                $weight = $weight == 'variable' ? '100 700' : $weight;
            }
            $format = bb_get_font_format(basename($uri));
            $bb_fonts_css .= "@font-face {\n";
            $bb_fonts_css .= "    font-family: '{$l}';\n";
            $bb_fonts_css .= "    font-style: normal;\n";
            $bb_fonts_css .= "    font-weight: {$weight};\n";
            $bb_fonts_css .= "    font-display: swap;\n";
            $bb_fonts_css .= "    src: url('{$uri}') format('{$format}');\n";
            $bb_fonts_css .= "}\n";
        }
    }
    return $bb_fonts_css;
}

function bb_inline_style_typography_colors()
{
    $options = get_fields('options');
    $headline_color = $options['headline_color'] ?? 'black';
    $text_color = $options['text_color'] ?? 'black';
    $menue_color = $options['menue_color'] ?? 'black';

    $typography_css = "/* Typography Colors */\n";
    $typography_css .= ":root {\n";
    $typography_css .= "    --typography-headline-color: var(--tw-colors-{$headline_color});\n";
    $typography_css .= "    --typography-text-color: var(--tw-colors-{$text_color});\n";
    $typography_css .= "    --typography-menu-color: var(--tw-colors-{$menue_color});\n";
    $typography_css .= "}\n\n";

    // Apply colors to elements
    $typography_css .= "h1, h2, h3, h4, h5, h6 {\n";
    $typography_css .= "    color: rgb(var(--colors-{$headline_color}));\n";
    $typography_css .= "}\n\n";

    $typography_css .= "p, li, td, th, span, div {\n";
    $typography_css .= "    color: rgb(var(--colors-{$text_color}));\n";
    $typography_css .= "}\n\n";

    // Very specific CSS for menu items to override button classes
    $typography_css .= "/* Menu item colors - specific to override button classes */\n";
    $typography_css .= "nav a.btn.btn-menu {\n";
    $typography_css .= "    color: rgb(var(--colors-{$menue_color}));\n";
    $typography_css .= "}\n\n";

    return $typography_css;
}

// Add custom fonts and typography colors to stylesheet
add_action(
    'wp_enqueue_scripts',
    function () {
        wp_add_inline_style('style', bb_inline_style_fonts() . "\n" . bb_inline_style_typography_colors());
    },
    PHP_INT_MAX
);
