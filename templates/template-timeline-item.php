<?php
/**
 * Template Name: Timeline Item
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>
<?php get_template_part('template-parts/page-header'); ?>
<div class="content pt-10">
    <?php the_content(); ?>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>
