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
<?php while (have_posts()):
	the_post(); ?>
<?php get_template_part('template-parts/page-header-theme-releases'); ?>
<?php
$events = tribe_get_events(['posts_per_page' => 5, 'tax_query' => [['taxonomy' => 'theme', 'field' => 'slug', 'terms' => $term_slug]]]);

$projects_args = ['post_type' => 'projects', 'posts_per_page' => -1, 'tax_query' => [['taxonomy' => 'theme', 'field' => 'slug', 'terms' => $term_slug]]];
$projects = new WP_Query($projects_args);

$publications_args = ['post_type' => 'publications', 'posts_per_page' => -1, 'tax_query' => [['taxonomy' => 'theme', 'field' => 'slug', 'terms' => $term_slug]]];
$publications = new WP_Query($publications_args);

if (count($events) > 0  || $projects->have_posts() || $publications->have_posts()) { ?>
<div class="container">
    <div class="lg:grid grid-cols-12 gap-5">
        <div class="content col-span-8 no-container-styles mt-20">
            <?php the_content(); ?>
        </div>
        <div class="col-span-4 mt-20 flex flex-col space-y-10">
            <!-- related events -->
            <?php if (count($events) > 0) { ?>
            <div class="rounded-xl border border-gray-300 p-5 flex- flex-col space-y-3">
                <h3>
                    <?php _e('Related Events', BB_TEXT_DOMAIN); ?>
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <?php foreach ($events as $post) {
                    	setup_postdata($post);
                        $event_id = get_the_ID();
                        $event_time_start = tribe_get_start_date($event_id, false, 'H:i'); // Get event start time
				        $event_time_end = tribe_get_end_date($event_id, false, 'H:i');
                        include locate_template('template-parts/content-related-events.php', false, false);
                    } ?>
                </div>
            </div>
            <?php } ?>
            <!-- related projects -->
            <?php if ($projects->have_posts()) { ?>
                <div>
                    <h3>
                        <?php _e('Related Projects', BB_TEXT_DOMAIN); ?>
                    </h3>
                    <div class="grid grid-cols-2 gap-5">
                        
                    <?php while ($projects->have_posts()) {
                        $projects->the_post();
                        // Display the post content here
                        ?>
                        <div class="bg-gray rounded-xl">
                            <?php include locate_template('blocks/projects-swiper/project-card.php', false, false); ?>
                        </div>                
                    <?php } ?>
                    </div>
            	</div>
            <?php wp_reset_postdata();
            } else {
            } ?>
            <!-- related publications -->
            <?php if ($publications->have_posts()) { ?>
                <div>
                    <h3>
                        <?php _e('Related Publications', BB_TEXT_DOMAIN); ?>
                    </h3>
                    <div class="grid grid-cols-2 gap-5">
                    <?php while ($publications->have_posts()) {
                        $publications->the_post();
                        ?>
                        <?php include locate_template('template-parts/content-related-publications.php', false, false); ?>
                    <?php } ?>
                    
                    </div>
            	</div>
            <?php wp_reset_postdata();
            } else {
            } ?>
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

<?php
endwhile; ?>
<?php get_footer(); ?>
