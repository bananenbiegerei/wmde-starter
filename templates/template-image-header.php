<?php
/*
Template Name: Big Image Header
*/
get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>
<?php get_template_part('template-parts/page-header-image'); ?>
<div class="content pt-10">
    <?php the_content(); ?>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>
