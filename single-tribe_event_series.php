<?php get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>
no idea why nav is not loading
	<?php //get_template_part('template-parts/page-header'); ?>
	<div class="content pt-10">
		<?php the_content(); ?>
	</div>
<?php endwhile; ?>
<?php get_footer(); ?>