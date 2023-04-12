<?php get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>
	<?php if (has_post_thumbnail()): ?>
	  <div class="bg-gray min-h-[12rem]">
		  <div class="container grid grid-cols-12">
			  <div class="col-span-12 lg:col-span-10 lg:col-start-2">
				  <?php get_template_part('template-parts/breadcrumbs'); ?>
					<h1 class="text-2xl lg:text-5xl mt-5"><?php the_title(); ?></h1>
					<?php if (has_excerpt()): ?>
					  <div class="font-alt text-2xl font-normal mb-10">
						<?php echo strip_tags(get_the_excerpt()); ?>
					  </div>
					<?php endif; ?>
			  </div>
		  </div>
	  </div>
	  <div class="relative">
		  <div class="absolute top-0 left-0 bg-gray rounded-b-3xl h-20 w-full">
		  </div>
		  <div class="relative flex justify-center container grid grid-cols-12">
				<div class="col-span-12 lg:col-span-8 lg:col-start-3">
					<?php get_template_part('template-parts/featured-image'); ?>
				</div>
			</div>
		</div>
	<?php else: ?>
	  <div class="bg-gray rounded-b-3xl min-h-[12rem] pb-10">
		  <div class="container grid grid-cols-12">
			  <div class="col-span-12 lg:col-span-8 lg:col-start-3">
				  <?php get_template_part('template-parts/breadcrumbs'); ?>
					<h1 class="text-5xl mt-5"><?php the_title(); ?></h1>
					<?php if (has_excerpt()): ?>
					  <div class="font-alt text-xl font-normal">
						<?php the_excerpt(); ?>
					  </div>
					<?php endif; ?>
			  </div>
		  </div>
	  </div>
	<?php endif; ?>
	<?php get_template_part('template-parts/anchor-nav'); ?>
	<div class="content pt-10">
		<?php the_content(); ?>
	</div>

<?php endwhile; ?>
<?php get_footer(); ?>
