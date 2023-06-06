<?php 
/*
Template Name: Events template
*/
get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>
<div class="content">
	<?php the_content(); ?>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>