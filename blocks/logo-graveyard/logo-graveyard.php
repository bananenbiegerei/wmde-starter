<div class="bb-logo-graveyard-block" id="<?= $block['id'] ?>">
	<h2><?= esc_html(get_field('headline')) ?></h2>
	<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5 mb-10 lg:mb-20">
		<?php while (have_rows('logo_gallery')): ?>
			<?php the_row(); ?>
			<div class="logo-item bg-gray flex items-center justify-center rounded-xl min-h-32 p-3">
				<?php if ($link = get_sub_field('link')): ?>
					<a href="<?= esc_url($link['url']) ?>" target="<?= esc_attr($link['target']) ?>">
						<?= wp_get_attachment_image(get_sub_field('logo'), 'full', '', ['class' => 'max-w-32 h-auto max-h-28 w-auto p-3']) ?>
					</a>
				<?php else: ?>
					<?= wp_get_attachment_image(get_sub_field('logo'), 'full', '', ['class' => 'max-w-32 h-auto max-h-28 w-auto p-3']) ?>
				<?php endif; ?>
			</div>
		<?php endwhile; ?>
	</div>
</div>
