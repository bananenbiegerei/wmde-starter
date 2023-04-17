<?php
$args = array(
	'post_type' => 'projects',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'order' => 'DESC'
);
$projects = new WP_Query( $args );
?>
<div class="bb-projects-overview-block">
	<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
		<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
			<?php include( locate_template( 'template-parts/card-project.php', false, false ) ); ?>
		<?php endwhile; ?>
	</div>
</div>
<?php wp_reset_postdata(); ?>