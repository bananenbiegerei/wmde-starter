<?php get_header(); ?>
<?php while (have_posts()): ?>
	<?php the_post(); ?>
	<div class="bg-neutral min-h-[12rem] py-3 lg:py-10">
		  <div class="container lg:grid lg:grid-cols-12 lg:gap-10">
			  <div class="lg:col-span-3">
					<div class="flex lg:justify-center mt-4">
						  <?php the_post_thumbnail('large', ['class' => 'max-h-[12rem] w-auto max-w-[12rem] h-auto']); ?>
					</div>
			  </div>
			  <div class="lg:col-span-9">
					<h1 class="my-5"><?php the_title(); ?></h1>
					<?php if (has_excerpt()): ?>
					  <div class="mb-10 text-xl lg:text-2xl font-alt font-normal">
						<?php echo strip_tags(get_the_excerpt()); ?>
					  </div>
					<?php endif; ?>
			  </div>

		  </div>
	</div>

	<div class="content pt-10 container lg:grid lg:grid-cols-12 gap-10 no-container-styles">
		<div class="lg:col-span-3 font-alt font-normal flex flex-col space-y-5">
			<?php if (have_rows('meta_infos')): ?>
				<?php while (have_rows('meta_infos')): the_row(); ?>
					<div>
						<strong><?= get_sub_field('label'); ?></strong>
						<span class="text-sm text-inherit"><?= get_sub_field('text'); ?></span>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<div class="lg:col-span-9">
			<?php the_content(); ?>
		</div>
	</div>
	<?php endwhile; ?>
<?php get_footer(); ?>