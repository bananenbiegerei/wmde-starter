<?php 
/*
Template Name: Events template
*/
get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>

<div class="container pt-10">
	<?php get_template_part('template-parts/breadcrumbs'); ?>
	<h1 class="lg:text-5xl"><?php _e('Veranstaltungen', BB_TEXT_DOMAIN); ?></h1>
	<p class="lg:text-2xl"><?php _e('Veranstaltungen Text Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto molestiae voluptatem nemo illo odit, iste enim quis veniam fugiat! Enim ea saepe quas obcaecati odit.', BB_TEXT_DOMAIN); ?></p>
	<?php if (has_excerpt()): ?>
	<div class="font-alt text-xl font-normal">
		<?php the_excerpt(); ?>
	</div>
	<?php endif; ?>
	<div class="mt-10 lg:mt-20 grid grid-cols-12">
		<div class="col-span-12 lg:col-span-8 lg:col-start-3">
			<?php echo do_shortcode('[tribe_events]'); ?>
		</div>
	</div>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>