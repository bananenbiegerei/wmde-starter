<div
<?= get_field('anchor_id') ? 'id="' . get_field('anchor_id') . '"' : '' ?>
class="bb-headline-block container grid grid-cols-12">
<div class="col-span-12 lg:col-span-8 lg:col-start-3 mb-3">
	<<?= get_field('level') ?> class="<?= get_field('style')['headline_size'] ?> mb-2">
		<?php if (get_field('style')['has_bg_color']): ?>
			<span style="background-color: <?= get_field('style')['bg_color'] ?>">
			  <?= get_field('headline') ?>
			</span>
		<?php else: ?>
			<?= get_field('headline') ?>
		<?php endif; ?>
	</<?= get_field('level') ?>>
</div>
</div>
