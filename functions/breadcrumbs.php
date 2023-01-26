<?php

function bb_breadcrumbs()
{
    if (is_front_page() || is_404()) {
        return;
    }
    global $post;
    echo '<nav role="navigation"><ul class="breadcrumbs">';
    echo '<li class="item"><a href="'. get_home_url() .'">'. esc_html('Start') .'</a></li>' ;
    if (is_archive()) {
        echo '<li>'. post_type_archive_title('', false) .'</li>';
    } elseif (is_page()) {
        if ($post->post_parent) {
            $anc = get_post_ancestors($post->ID);
            $anc = array_reverse($anc);
            if (!isset($parents)) {
                $parents = null;
            }
            foreach ($anc as $ancestor) {
                $parents .= '<li><a href="'. get_permalink($ancestor) .'">'. get_the_title($ancestor) .'</a></li>' ;
            }
            echo $parents;
            echo '<li>'. get_the_title() .'</li>';
        } else {
            echo '<li>'. get_the_title() .'</li>';
        }
    } elseif (get_post_type() == 'projects') {
        echo '<li><a href="' . get_post_type_archive_link('projects') . '">Projekte</a></li>';
        echo '<li>'. get_the_title() .'</li>';
    }
    echo '</ul></nav>';
}
