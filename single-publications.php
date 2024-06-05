<?php get_header(); ?>
<?php while (have_posts()): ?>
	<?php the_post(); ?>
	<div class="bg-neutral min-h-[12rem] py-3 lg:py-10">
		  <div class="container lg:grid lg:grid-cols-12 lg:gap-10">
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
		<div class="lg:col-span-3">
			<?php the_post_thumbnail('large', ['class' => '']); ?>
		</div>
		<?php if ( get_field('pdf') ) : ?>
			<div class="lg:col-span-5">
				<a class="btn" href="<?php the_field('pdf'); ?>" ><?php _e('Datei herunterladen', BB_TEXT_DOMAIN) ?></a>
			</div>
		<?php endif; ?>
	</div>
	<?php endwhile; ?>
<?php get_footer(); ?>
