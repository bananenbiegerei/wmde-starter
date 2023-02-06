<?php get_header(); ?>
<?php while (have_posts()):
	the_post(); ?>
	<div class="_container">
		<div class="px-5">
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
	</div>
<?php
endwhile; ?>
<?php get_footer(); ?>
