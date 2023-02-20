<?php $meta = get_field('meta')['theme'] ? get_field('meta')['theme'] : get_field('meta')['format']; ?>

<div id="<?= $block['id'] ?>" class="bb-cta-block rounded-3xl p-4" style="background-color: <?= get_field('style')['bg_color'] ?>;">

	<div class="flex flex-wrap sm:flex-nowrap gap-8 h-full">

		<!-- Image -->
		<?php if (get_field('style')['image']): ?>
			<div class="basis-full sm:basis-1/4 flex-shrink-0">
				<?php echo wp_get_attachment_image(get_field('style')['image'], [400, 0], false, ['class' => 'rounded-2xl aspect-video sm:aspect-square object-cover min-w-full']); ?>
			</div>
		<?php endif; ?>

		<!-- Content -->
		<div class="flex flex-col">

			<!-- Theme or format -->
			<div class="uppercase text-primary font-bold text-base font-alt mb-0">
				<?= esc_html($meta->name) ?>
			</div>

			<!-- Title -->
			<div class="font-alt text-3xl mb-4">
				<?= esc_html(get_field('content')['title']) ?>
			</div>

			<!-- Text -->
			<div class="font-alt font-light font-sans text-2xl text-inherit flex-grow">
				<?= get_field('content')['text'] ?>
			</div>

			<!-- Button and extra info -->
			<div class="mt-6 mb-0 sm:mb-2 flex flex-wrap gap-y-8">
				<div class="flex-shrink-0 text-xl">
					<a class="button mr-8" href="<?= esc_attr(get_field('link')['url']) ?>">
						<?= bb_icon('arrow-right') ?>
						<?= esc_html(get_field('button')['link']['title']) ?>
					</a>
					</div>
				<div>
					<span class="text-xl"><?= esc_html(get_field('button')['link_meta']) ?></span>
				</div>
			</div>

		</div>
	</div>

	<!-- Related -->
	<?php if (have_rows('related')): ?>
		<div class="flex gap-4 sm:gap-5 flex-wrap pb-2 mt-6 sm:mt-0">
			<?php while (have_rows('related')): ?>
				<?php the_row(); ?>

				<div class="sm:mt-9 sm:basis-1/4">
					<a href="<?= esc_attr(get_sub_field('link')['url']) ?>">
						<div class="uppercase font-bold text-lg mb-4 font-alt">
							<?= esc_html(get_sub_field('link')['title']) ?>
						</div>
						<div class="text-black text-base font-sans">
							<?= esc_html(get_sub_field('description')) ?>
						</div>
					</a>
				</div>

			<?php endwhile; ?>
		</div>
	<?php endif; ?>
</div>
