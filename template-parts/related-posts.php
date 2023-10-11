<?php
// Get the category ID of the current post
$categories = get_the_category();
if ($categories) {
    $current_category_id = $categories[0]->term_id; // Assuming you want the first category, change the index if needed
} else {
    $current_category_id = 0; // Default value if no categories are found
}

// Query the last three related posts from the same category
$related_posts = new WP_Query(array(
    'category__in' => array($current_category_id), // Specify the category ID
    'posts_per_page' => 4, // Number of posts to retrieve
    'post__not_in' => array(get_the_ID()), // Exclude the current post
    'orderby' => 'date', // Order by date
    'order' => 'DESC' // Descending order
));

if ($related_posts->have_posts()) : ?>
    <h3><?php _e('Related Posts', BB_TEXT_DOMAIN); ?></h3>
    <hr class="mb-5">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
    <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
        <div>
          <?php get_template_part('template-parts/content'); ?>
        </div>
    <?php endwhile; ?>
    </div>
<?php endif;

// Restore the main query loop
wp_reset_postdata();
?>