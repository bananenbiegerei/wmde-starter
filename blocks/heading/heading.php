<?php

$bgcolor = get_field('style_bg_color_color_light');
$bgcolor = $bgcolor == 'default' ? '' : $bgcolor;
if ($bgcolor) {
	$bgcolor = "bg-{$bgcolor}";
}

$color = get_field('style_text_color_color_dark');
$color = $color == 'default' ? '' : $color;
if ($color) {
	$color = "text-{$color}";
}

$title = get_field('anchor_title');
$id = str_replace(' ', '_', esc_attr($title));
?>


<div data-anchor-title="<?= $title ?>" class="bb-headline-block">
	<div class="anchor-offset" id="<?= $id ?>"></div>
	<?php if (get_field('headline_link')): ?>
		<a class="hover:underline transition" href="<?php echo esc_url('headline_link'); ?>">
			<<?= get_field('level') ?> class="<?= get_field('style')['headline_size'] ?? '' ?> <?= $color ?>">
				<span class="<?= $bgcolor ?>">
					<?= get_field('headline') ?>
				</span>
			</<?= get_field('level') ?>>
		</a>
	<?php else: ?>
		<<?= get_field('level') ?> class="<?= get_field('style')['headline_size'] ?? '' ?> <?= $color ?>">
			<span class="<?= $bgcolor ?>">
				<?= get_field('headline') ?>
			</span>
		</<?= get_field('level') ?>>
	<?php endif; ?>
</div>
