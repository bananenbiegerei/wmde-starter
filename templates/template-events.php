<?php 
/*
Template Name: Events template
*/
get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>

<div class="container pt-10">
	<?php get_template_part('template-parts/breadcrumbs'); ?>
	<h1 class="lg:text-5xl"><?php the_title(); ?></h1>
	<?php if (has_excerpt()): ?>
	<div class="font-alt text-xl font-normal">
		<?php the_excerpt(); ?>
	</div>
	<?php endif; ?>
	<div class="mt-10 lg:mt-20">
		<?php echo do_shortcode('[tribe_events]'); ?>
	</div>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>