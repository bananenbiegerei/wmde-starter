<?php get_header(); ?>
<?php while (have_posts()):
	the_post(); ?>
	<?php get_template_part('template-parts/page-header-theme-releases'); ?>
	
	<div class="content pt-10">
		<?php the_content(); ?>
	</div>
<?php
endwhile; ?>
<?php get_footer(); ?>
