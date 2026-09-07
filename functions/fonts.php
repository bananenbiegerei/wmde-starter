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
            $custom_font_file = get_sub_field('custom_font_file');
            $weight = get_sub_field('custom_font_weight');
            // Skip incomplete rows: the bundled default font in /fonts (registered in
            // src/scss/ui/fonts.scss) stays in effect for this weight instead.
            if (empty($custom_font_file) || empty($weight)) {
                continue;
            }
            $name = $custom_font_file['label'];
            $uri = $custom_font_file['value'];
            $weight = $weight == 'variable' ? '100 700' : $weight;
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
    $titlebar_text_color = $options['titlebar_color']['text_color'] ?? 'black';
    $navbar_text_color = $options['navbar_color']['text_color'] ?? 'black';

    $typography_css = "/* Typography Colors */\n";
    $typography_css .= ":root {\n";
    $typography_css .= "    --typography-headline-color: var(--tw-colors-{$headline_color});\n";
    $typography_css .= "    --typography-text-color: var(--tw-colors-{$text_color});\n";
    $typography_css .= "}\n\n";

    // Apply colors to elements
    $typography_css .= "h1, h2, h3, h4, h5, h6 {\n";
    $typography_css .= "    color: rgb(var(--colors-{$headline_color}));\n";
    $typography_css .= "    font-weight: 500;\n";
    $typography_css .= "}\n\n";

    $typography_css .= "p, li, td, th, span, div {\n";
    $typography_css .= "    color: rgb(var(--colors-{$text_color}));\n";
    $typography_css .= "    font-weight: 300;\n";
    $typography_css .= "}\n\n";

    // Buttons should inherit their own color, not the text color
    $typography_css .= ".btn, .btn span, .btn div {\n";
    $typography_css .= "    color: inherit;\n";
    $typography_css .= "}\n\n";

    // Menu text in the titlebar (profile/login links) follows the titlebar's own
    // text color, independent of the navbar's. Hover keeps the background
    // transparent and just dims the text slightly instead.
    $typography_css .= "/* Titlebar menu item colors - specific to override button classes */\n";
    $typography_css .= "#nav-right-level-1 a, #nav-right-level-1 button {\n";
    $typography_css .= "    color: rgb(var(--colors-{$titlebar_text_color}));\n";
    $typography_css .= "}\n";
    $typography_css .= "#nav-right-level-1 a:hover, #nav-right-level-1 button:hover {\n";
    $typography_css .= "    color: rgba(var(--colors-{$titlebar_text_color}), 0.9);\n";
    $typography_css .= "}\n\n";

    // Menu text directly on the navbar (domains, subnav) follows the navbar's own
    // text color, independent of the titlebar's. Same transparent-background,
    // dimmed-text hover treatment.
    $typography_css .= "/* Navbar menu item colors - specific to override button classes */\n";
    $typography_css .= "#navmenu_desktop_domains a.btn-menu, #navmenu_mobile .menu li a, #navmenu_mobile .menu li button, #nav-right-level-2 a, #nav-right-level-2 button {\n";
    $typography_css .= "    color: rgb(var(--colors-{$navbar_text_color}));\n";
    $typography_css .= "}\n";
    $typography_css .= "#navmenu_desktop_domains a.btn-menu:hover, #navmenu_mobile .menu li a:hover, #navmenu_mobile .menu li button:hover, #nav-right-level-2 a:hover, #nav-right-level-2 button:hover {\n";
    $typography_css .= "    color: rgba(var(--colors-{$navbar_text_color}), 0.9);\n";
    $typography_css .= "}\n\n";

    // Dropdown panels always have a white background regardless of the navbar's
    // color, so their text always stays primary rather than following navbar_color.
    $typography_css .= "/* Dropdown menu item colors - always primary, panel background is always white */\n";
    $typography_css .= "#navmenu_desktop_dropdown a.btn-menu, #navmenu_desktop_dropdown .btn-menu {\n";
    $typography_css .= "    color: rgb(var(--colors-primary));\n";
    $typography_css .= "}\n";
    $typography_css .= "#navmenu_desktop_dropdown a.btn-menu:hover, #navmenu_desktop_dropdown .btn-menu:hover {\n";
    $typography_css .= "    color: rgba(var(--colors-primary), 0.9);\n";
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
