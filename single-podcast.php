<?php
get_header(); ?>
<div class="bg-primary p-5">
    <div class="container">
        <a href="<?php echo get_permalink('123'); ?>">
            <img class="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/wikimove/wikimove-logo.png"
                alt="Logo">
        </a>
    </div>
</div>
<div class="bg-primary-200 p-5">
    <div class="container">
        <h1 class="h4 uppercase"><?php the_title(); ?></h1>
        <?php if (get_field('embeded_player')): ?>
        <div class="grid grid-cols-12 mb-5 mt-10">
            <div class="col-span-12 lg:col-span-8 lg:col-start-3">
                <?php the_field('embeded_player'); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php while (have_posts()):
	the_post(); ?>
<div class="container my-16">
    <?php the_content(); ?>
</div>
<?php
endwhile; ?>

<div class="container">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        <?php
        // WP_Query arguments
        $args = [
        	'post_type' => ['podcast'],
        	'post__not_in' => [get_the_id()],
        	'meta_compare' => 'IN',
        	'posts_per_page' => '-1',
        	'order' => 'ASC',
        	'orderby' => 'date'
        ];
        // The Query
        $query = new WP_Query($args);

        // The Loop
        if ($query->have_posts()) {
        	while ($query->have_posts()) {
        		$query->the_post();
        		get_template_part('template-parts/card-wikimove-podcasts');
        	}
        } else {
        	// no posts found
        }

        // Restore original Post Data
        wp_reset_postdata();
        ?>
    </div>
</div>
<?php get_footer();
