<?php get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>
	<div class="pb-10 rounded-b-3xl bg-gray">
		  <div class="container grid grid-cols-12">
			  <div class="col-span-12 pt-5">
					<h1><?php the_title(); ?></h1>
					<?php if (has_excerpt()): ?>
					  <div class="font-alt text-xl lg:text-2xl font-normal mb-5">
						<?php the_excerpt(); ?>
					  </div>
					<?php endif; ?>
			  </div>
		  </div>
	</div>
	<div class="container pt-10">
		<?php the_content(); ?>
	</div>
<?php endwhile; ?>
<?php get_footer(); ?>