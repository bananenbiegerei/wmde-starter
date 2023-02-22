<div
<?= get_field('anchor_id') ? 'id="' . get_field('anchor_id') . '"' : '' ?>
class="headline-block container-ten-cols">
	<<?= get_field('level') ?> class="<?= get_field('style')['headline_size'] ?> mb-1">
		<?php if (get_field('style')['has_bg_color']): ?>
			<span style="background-color: <?= get_field('style')['bg_color'] ?>">
  			<?= get_field('headline') ?>
			</span>
		<?php else: ?>
			<?= get_field('headline') ?>
		<?php endif; ?>
	</<?= get_field('level') ?>>
</div>
