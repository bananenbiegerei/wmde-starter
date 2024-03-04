<?php get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>test
<?php
	//get_template_part('template-parts/page-header');
	?>
<div id="swup">
    <div class="fixed top-0 left-0 w-full h-full z-40 content" id="swup-modal">
	<div class="relative h-full w-full p-10">
	    <a class="block absolute top-0 left-0 w-full h-full bg-black bg-opacity-60" href="/timeline/">close</a>
	    <div class="relative max-w-2xl mx-auto z-10 bg-white border-4 border-black">
		<?php the_content(); ?>
	    </div>
	</div>
    </div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>
