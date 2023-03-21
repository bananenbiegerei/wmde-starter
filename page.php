<?php get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>

	<?php if (bb_has_post_thumbnail()): ?>

	  <div class="bg-gray py-8 min-h-[12rem]">
		  <div class="container grid grid-cols-12 py-5">
			  <div class="col-span-12 lg:col-span-10 lg:col-start-2">
				  <?php get_template_part('template-parts/breadcrumbs'); ?>
					<h1 class="text-2xl lg:text-5xl"><?php the_title(); ?></h1>
					<?php if (has_excerpt()): ?>
					  <div class="font-alt text-xl font-normal">
						<?php echo get_the_excerpt(); ?>
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

					<!-- Featured Image -->
					<div class="bb-image-block aspect-w-16 aspect-h-9">
						<figure class="w-full w-full">
							<?php bb_the_post_thumbnail('large', ['class' => 'rounded-3xl object-cover w-full h-full']); ?>
							<figcaption class="invisible flex absolute left-0 bottom-0 right-0 text-white bg-black w-auto h-auto z-20 p-2 text-sm flex items-start gap-4 break-all rounded-b-2xl">
								<?= bb_icon('info') ?> <div class="self-center"><?= bb_get_post_thumbnail_caption() ?></div>
							</figcaption>
						</figure>
					</div>
					<!-- End Featured Image -->

				</div>
			</div>
		</div>

	<?php else: ?>

	  <div class="bg-gray rounded-b-3xl py-8 min-h-[12rem]">
		  <div class="container grid grid-cols-12">
			  <div class="col-span-12 lg:col-span-8 lg:col-start-3">
				  <?php get_template_part('template-parts/breadcrumbs'); ?>
					<h1 class="text-5xl"><?php the_title(); ?></h1>
					<?php if (has_excerpt()): ?>
					  <div class="font-alt text-xl font-normal">
						<?php echo get_the_excerpt(); ?>
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
