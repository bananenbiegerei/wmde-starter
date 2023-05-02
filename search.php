<?php get_header(); ?>
<div class="grid grid-cols-12 container">
	<div class="col-span-12 mb-20">
		<?php if (have_posts()) : ?>
			<h1 class="mt-6 mb-10"><?php printf(__('Suchergebnisse für: %s', 'wmde'), get_search_query()); ?></h1>
			<div class="sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
				<?php while (have_posts()) :
					the_post();
					$image_id = get_post_thumbnail_id();
				?>
				<div class="bb-card-block bg-gray rounded-xl mb-10 lg:mb-5 p-5 z-10 hover:z-20 relative " data-post-id="" data-blog-id="29">
					<a href="<?php the_permalink(); ?>" class="flex gap-5 flex-col">
						<?php
						if ( has_post_thumbnail() ) { ?>
							<div class="">
								<div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-2xl overflow-hidden">
									<?php if ($image_id) : ?>
										<?php echo wp_get_attachment_image($image_id, [400, 0], false, ['class' => 'h-full w-full object-cover']); ?>
									<?php endif; ?>
								</div>
							</div>
						<?php }
						else {
						}
						?>
						<div class=" space-y-2 px-2 pb-2">
							<h2 class="text-2xl font-alt"><?php the_title(); ?></h2>
							<div class="text-xl font-alt font-normal text-inherit"><?= wp_trim_words(get_the_excerpt(), 99, '...') ?></div>
						</div>
					</a>
				</div>
				<?php
				endwhile; ?>
			</div>
		<?php else : ?>
			<div class="container py-20 flex justify-center items-center">
				<div class="translate-y-5 max-w-4xl">
					<h1><?php _e('Nichts gefunden', BB_TEXT_DOMAIN); ?></h1>
					<p class="mb-5">
						<?php _e('Es tut uns leid, aber nichts passte zu Ihren Suchbegriffen. Bitte versuchen Sie es noch einmal mit anderen Suchbegriffen.', BB_TEXT_DOMAIN); ?></p>
					<div class="flex gap-5 items-center h-full">
							<form class="flex gap-5" action="<?php echo home_url('/'); ?>" method="get">
								<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
								<input type="submit" alt="Search" value="Suchen" class="btn btn-sm" />
							</form>
						</div>
				</div>
			</div>
		<?php endif; ?>

	</div>
</div>
<?php get_footer(); ?>