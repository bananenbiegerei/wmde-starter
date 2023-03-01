<?php get_header(); ?>
<?php
while ( have_posts() ) : the_post(); ?>
	<div class="content mt-10">
		<?php the_content(); ?>
	</div>
<?php endwhile;
?>
<?php get_footer(); ?>