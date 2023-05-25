<div class="bb-logo-graveyard-block" id="<?= $block['id'] ?>">
	<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 mb-10 lg:mb-20">
		<?php while (have_rows('logo_gallery')): ?>
			<?php the_row(); ?>
			<div class="logo-item flex items-center justify-center rounded-xl min-h-32 p-3">
				<?php if ($link = get_sub_field('link')): ?>
					<a href="<?= esc_url($link['url']) ?>" target="<?= esc_attr($link['target']) ?>">
						<?= wp_get_attachment_image(get_sub_field('logo'), 'full', '', ['class' => 'max-w-36 h-auto max-h-36 w-auto p-3']) ?>
					</a>
				<?php else: ?>
					<?= wp_get_attachment_image(get_sub_field('logo'), 'full', '', ['class' => 'max-w-36 h-auto max-h-36 w-auto p-3']) ?>
				<?php endif; ?>
			</div>
		<?php endwhile; ?>
	</div>
</div>
