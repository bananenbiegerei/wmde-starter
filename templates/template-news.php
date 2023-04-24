<?php 
/*
Template Name: News template
*/
get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>
	<?php if (has_post_thumbnail()): ?>

	  <div class="min-h-[12rem]">
		  <div class="container grid grid-cols-12">
			  <div class="col-span-12">
				  <?php get_template_part('template-parts/breadcrumbs'); ?>
					<h1 class="text-2xl lg:text-5xl pt-5"><?php the_title(); ?></h1>
					<?php if (has_excerpt()): ?>
					  <div class="font-alt text-xl font-normal">
						<?php the_excerpt(); ?>
					  </div>
					<?php endif; ?>
			  </div>
		  </div>
	  </div>

	  <div class="relative">
		  <div class="absolute top-0 left-0 rounded-b-3xl h-20 w-full">
		  </div>
		  <div class="relative flex justify-center container grid grid-cols-12">
				<div class="col-span-12">
					<?php get_template_part('template-parts/featured-image'); ?>
				</div>
			</div>
		</div>

	<?php else: ?>

	  <div class="rounded-b-3xl py-8 min-h-[12rem]">
		  <div class="container grid grid-cols-12">
			  <div class="col-span-12">
				  <?php get_template_part('template-parts/breadcrumbs'); ?>
					<h1 class="text-5xl"><?php the_title(); ?></h1>
					<?php if (has_excerpt()): ?>
					  <div class="font-alt text-xl font-normal">
						<?php the_excerpt(); ?>
					  </div>
					<?php endif; ?>
			  </div>
		  </div>
	  </div>
	<?php endif; ?>

	<div class="content pt-10">
		<?php the_content(); ?>
	</div>

<?php endwhile; ?>
<?php get_footer(); ?>
