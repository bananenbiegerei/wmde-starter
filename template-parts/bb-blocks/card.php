<?php
// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'bb-card-block';

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
	$anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

$meta = get_field('meta')['theme'] ? get_field('meta')['theme'] : get_field('meta')['format'];

$layout = get_field('style')['layout'];
$layout_classes = [];
if ($layout == 'v') {
	$layout_classes['container'] = 'flex-col';
} else {
	$layout_classes['container'] = 'flex-row';
	$layout_classes['image'] = 'basis-1/2';
	$layout_classes['content'] = 'basis-1/2 self-center';
	if ($layout == 'h2') {
		$layout_classes['image'] = 'basis-1/3';
		$layout_classes['content'] = 'basis-2/3';
	}
}
?>


<div <?php echo $anchor; ?>
	class="bb-card-block rounded-3xl p-4 flex gap-6 mb-6 <?= $layout_classes['container'] ?>"
	style="background-color: <?= get_field('style')['bg_color'] ?>;">

	<?php if (get_field('style')['image']): ?>
		<div class="<?= $layout_classes['image'] ?> rounded-xl">
			<?php echo wp_get_attachment_image(get_field('style')['image'], [400, 0], false, ['class' => 'rounded-3xl aspect-video object-cover min-w-full']); ?>
		</div>
	<?php endif; ?>

	<div class=" <?= $layout_classes['content'] ?>">
		<div class="uppercase text-base text-primary font-bold text-sm mb-6 font-alt">
				<?= esc_html($meta->name) ?>
		</div>
		<div class="text-2xl mb-6 font-alt">
			<?= esc_html(get_field('content')['title']) ?>
		</div>
		<?php if ($layout != 'h2'): ?>
			<div class="text-xl font-alt font-light text-inherit">
				<?= get_field('content')['text'] ?>
			</div>
		<?php endif; ?>
	</div>
</div>
