<?php

if (is_front_page() || is_404()) {
    return;
}

global $post;
$breadcrumbs = [];
if ($post->post_parent) {
    $anc = get_post_ancestors($post->ID);
    $anc = array_reverse($anc);
    foreach ($anc as $k => $ancestor) {
        $breadcrumbs[] =
            '<li class="flex items-center">' .
            ($k > 0 ? bb_icon('caret-right', 'text-warning icon-xs') : '') .
            '<a class="text-base !no-underline" href="' .
            get_permalink($ancestor) .
            '">' .
            get_the_title($ancestor) .
            '</a></li>';
    }
} elseif (get_post_type() == 'projects') {
    $breadcrumbs[] = '<li><a href="' . get_post_type_archive_link('projects') . '">' . __('Projekte', BB_TEXT_DOMAIN) . '</a></li>';
}

if (count($breadcrumbs) == 0) {
    return;
}
?>

<div class="lg:flex lg:items-center mt-5">
    <ul class="lg:flex lg:gap-1">
        <?= join('', $breadcrumbs) ?>
    </ul>
</div>