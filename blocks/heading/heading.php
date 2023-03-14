
<div id="<?= $block['id'] ?>" data-anchor-title="<?= esc_attr(get_field('anchor_title')) ?>" class="bb-headline-block">
	<<?= get_field('level') ?> class="<?= get_field('style')['headline_size'] ?? '' ?> mb-2">
		<?php if (get_field('style')['has_bg_color'] ?? false): ?>
			<span style="background-color: <?= get_field('style')['bg_color'] ?? '' ?>">
			  <?= get_field('headline') ?>
			</span>
		<?php else: ?>
			<?= get_field('headline') ?>
		<?php endif; ?>
	</<?= get_field('level') ?>>
</div>
