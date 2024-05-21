<?php
/*
Template Name: 20 Jahre Wikimedia Deutschland
*/
get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>
	<div class="bg-wmde20">
    <?php get_template_part('template-parts/page-header'); ?>
    </div>
	<div class="content pt-10 bg-wmde20">
		<?php the_content(); ?>
	</div>
<?php endwhile; ?>
<?php get_footer(); ?>
