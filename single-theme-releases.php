<?php get_header(); ?>
<?php
$post_id = get_the_ID();
$taxonomy = 'theme';
$terms = get_the_terms($post_id, $taxonomy);
$term_slug = ''; // Initialize the variable before the condition
if ($terms && !is_wp_error($terms)) {
    foreach ($terms as $term) {
        $term_slug = $term->slug;
    }
}
?>
<?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('template-parts/page-header-theme-releases'); ?>
    <?php
    $events = tribe_get_events([
        'posts_per_page' => 5,
        'tax_query' => [
            [
                'taxonomy' => 'theme',
                'field' => 'slug',
                'terms' => $term_slug,
            ],
        ],
    ]);
    if (count($events) > 0) {
    ?>
        <div class="container">
			<div class="lg:grid grid-cols-12 gap-5">
			<div class="content col-span-8 no-container-styles">
        		<?php the_content(); ?>
    		</div>
            <div class="col-span-4 mt-20">
				<div class="rounded-xl border border-gray-300 p-5 flex- flex-col space-y-3">
					<h3>
					<?php _e('Related Events', BB_TEXT_DOMAIN); ?>
				</h3>
				<div class="grid grid-cols-2 gap-4">
					<?php foreach ($events as $post) {
                setup_postdata($post);
                get_template_part('template-parts/content-related-events');
            	} ?>
				</div>
				</div>
			</div>
        </div>
		</div>
    <?php } else { ?>
        <div class="content col-span-8 no-container-styles">
        		<?php the_content(); ?>
    	</div>
    <?php }
    // Restore the original post data
    wp_reset_postdata();
    ?>
    
<?php endwhile; ?>
<?php get_footer(); ?>
