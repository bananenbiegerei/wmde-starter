<?php get_header(); ?>
<?php while (have_posts()): ?>
	<?php the_post(); ?>
	<div class="bg-gray min-h-[12rem] py-10">
		  <div class="container grid grid-cols-12 gap-10">
			  <div class="col-span-12 lg:col-span-3">
					<div class="flex justify-center mt-4">
						  <?php the_post_thumbnail('large', ['class' => 'max-h-[12rem] w-auto max-w-[12rem] h-auto']); ?>
					</div>
			  </div>
			  <div class="col-span-12 lg:col-span-9">
					<h1 class="<?php echo $title_style; ?> my-5"><?php the_title(); ?></h1>
					<?php if (has_excerpt()): ?>
					  <div class="<?php echo $excerpt_style; ?> mb-10 text-2xl font-alt font-normal">
						<?php echo strip_tags(get_the_excerpt()); ?>
					  </div>
					<?php endif; ?>
			  </div>
			
		  </div>
	  </div>

	<div class="content pt-10 container lg:grid lg:grid-cols-12 gap-10">
		<div class="lg:col-span-3 font-alt font-normal flex flex-col space-y-5">
			<?php if ( have_rows( 'meta_infos' ) ) : ?>
				<?php while ( have_rows( 'meta_infos' ) ) : the_row(); ?>
					<div>
						<strong><?php the_sub_field( 'label' ); ?></strong>
						<span class="text-sm text-inherit"><?php the_sub_field( 'text' ); ?></span>
					</div>
				<?php endwhile; ?>
			<?php else : ?>
				<?php // No rows found ?>
			<?php endif; ?>
		</div>
		<div class="lg:col-span-9 content">
			<?php the_content(); ?>
		</div>
	</div>
	<?php endwhile; ?>
<?php get_footer(); ?>
