<?php

$image = get_field('image'); ?>

<div class="bb-block-card rounded-2xl p-4">
	<img src="<?= $image['url'] ?>" class="rounded-2xl mb-6">
	<div>
		<div class="uppercase text-primary font-bold text-sm mb-6 font-alt">
			<?= the_field('domain') ?>
		</div>
		<div class="text-2xl mb-6 font-alt">
			<?= the_field('title') ?>
		</div>
		<div class="hidden text-xl md:block font-alt font-light">
			<?= the_field('text', false, false) ?>
			</div>
	</div>
	<?= the_field('bg_color') ?>
</div>
