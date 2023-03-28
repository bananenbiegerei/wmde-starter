<?php
/*
Template Name: Projects
*/
get_header();?>
<?php
	$args = array(
		'post_type' => 'projects',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'order' => 'DESC'
	);
	
	$projects = new WP_Query( $args );
	?>
<div class="container py-10">
	<h1><?php the_title(); ?></h1>
	<div class="max-w-4xl text-2xl">
		<?php echo get_the_excerpt(); ?>
	</div>
</div>
<?php the_content(); ?>
<div x-data="{selectedFilter: ''}">
	<div class="flex justify-start my-6 space-x-5 container">
		<button x-on:click="selectedFilter=''" class="btn btn-sm btn-hollow" :class="{'!bg-gray': !selectedFilter}" type="button">All</button>

		<?php
				$terms = get_terms( array(
					'taxonomy' => 'project_types',
					'hide_empty' => true,
				) );
				foreach ( $terms as $term ) :
			?>
		<button x-on:click="selectedFilter='<?php echo $term->slug; ?>'" class="btn btn-sm btn-hollow" :class="{'!bg-gray-200': selectedFilter == '<?php echo $term->slug; ?>'}" type="button"><?php echo $term->name; ?></button>
		<?php endforeach; ?>
	</div>

	<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 container">
		<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
		<?php
				$terms = get_the_terms( get_the_ID(), 'project_types' );
				$classes = '';
				if ( $terms && ! is_wp_error( $terms ) ) :
					$classes = join( ' ', array_map( function( $term ) {
						return $term->slug;
					}, $terms ) );
				endif;
			?>
		<?php include( locate_template( 'template-parts/card-project.php', false, false ) ); ?>
		<?php endwhile; ?>
	</div>

	<?php wp_reset_postdata(); ?>

	<?php get_footer(); ?>