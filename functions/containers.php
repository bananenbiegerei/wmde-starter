<?php
/* Container Magic for blocks

Blocks can have one of three width:
    - default
    - wide
    - full width

Full width blocks get a minimal padding by default (see src/scss/ui/containers.scss)
except if they have the 'bb-fullwidth-no-padding' class.

*/

// Possible values of width
define('BB_CONTAINER_WIDTHS', [
    'default' => 'Default',
    'wide' => 'Wide',
    'full' => 'Full Width'
]);

// Name of the ACF field for width
define('BB_WIDTH_FIELD', 'container_width');

// Classes to assign to width (see src/scss/ui/containers.scss)
define(
    'BB_WIDTH_CLASSES',
    [
        'wide' => 'bb-container-wide' ,
        'default' => 'bb-container-default',
    ]
);

// Add parent block information to blocks (to avoid getting a container during render_block)
add_filter(
    'render_block_data',
    function ($parsed_block, $source_block, $parent_block) {
        $parsed_block['parentBlock'] = $parent_block;
        return $parsed_block;
    },
    10,
    3
);


// Get ACF value for block width (looking for BB_WIDTH_FIELD)
function bb_get_block_width($block)
{
    $width = 'default';
    foreach ($block['attrs']['data'] ?? [] as $key => $value) {
        if ($key === BB_WIDTH_FIELD || (str_ends_with($key, '_' . BB_WIDTH_FIELD) && !str_starts_with($key, '_'))) {
            $width = $value;
        }
    }
    return $width;
}


// Magically wrap blocks with a container to implement page layout
add_filter(
    'render_block',
    function ($block_content, $block) {
        // Get value of width from ACF field
        $width = bb_get_block_width($block);

        // Full width blocks get no containers
        if ($width == 'full') {
            return $block_content;
        }

        // If the block has a parent... for now a parent can only be a group block (?)
        if ($block['parentBlock']) {
            $parent_width = bb_get_block_width($block['parentBlock']->parsed_block);
            if ($parent_width != 'full') {
                return $block_content;
            }
        }

        $inner_container_classes = BB_WIDTH_CLASSES[$width];
        $outer_container_classes = 'outer-container';
        $content = "<div class='{$outer_container_classes}'><div class='{$inner_container_classes}'>" . $block_content . '</div></div>';
        return $content;
    },
    10,
    2
);

// Add options for block width
add_filter('acf/load_field/name=container_width', function ($field) {
    $field['choices'] = BB_CONTAINER_WIDTHS;
    return $field;
});
