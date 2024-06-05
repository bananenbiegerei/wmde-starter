<?php
$args = array(
    'post_type' => 'tribe_events',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'theme', // Replace 'theme' with your actual taxonomy name
            'field' => 'slug',     // Use 'slug' or 'term_id' depending on how you reference your terms
            'terms' => $term_slug, // Replace 'your-theme-slug' with the desired theme term
        ),
    ),
);

$custom_query = new WP_Query( $args );

if ( $custom_query->have_posts() ) :
    while ( $custom_query->have_posts() ) : $custom_query->the_post();
        the_title();
    endwhile;
    wp_reset_postdata(); // Reset the query
else :
    echo 'No custom posts found with the specified theme.';
endif;
?>