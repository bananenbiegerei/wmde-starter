<?php get_header(); ?>
<?php while (have_posts()):
	the_post(); ?>
	<div class="container">
		<div class="max-w-4xl">
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
	</div>
<?php
endwhile; ?>
<?php get_footer(); ?>
