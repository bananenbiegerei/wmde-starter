<?php
// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'bb-cta-block';

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
	$anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

if (!empty($block['className'])) {
	$class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$class_name .= ' align' . $block['align'];
}
?>

<div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?> rounded-2xl p-4" style="background-color: <?= get_field('bg_color') ?>;">

	<div class="flex flex-wrap sm:flex-nowrap gap-4  mb-6 sm:mb-0">

		<div class="basis-full sm:basis-1/4 flex-shrink-0 rounded-xl bg-white">
			<?php echo wp_get_attachment_image(get_field('image'), [400, 0], false, ['class' => 'rounded-xl aspect-video sm:aspect-square object-cover min-w-full']); ?>
		</div>

		<div class="flex flex-col">
			<div class="uppercase text-primary font-bold text-sm font-alt mb-0">
				<?= esc_html(get_field('headline')) ?>
			</div>
			<div class="font-alt mb-4">
				<?= esc_html(get_field('title')) ?>
			</div>
			<div class="font-alt font-light text-xs flex-grow">
				<?= get_field('text', false, false) ?>
			</div>
			<div class="mt-6 sm:mt-0 mb-2">
				<a class="bg-white text-black border border-black rounded p-2 mr-2 button" href="<?= esc_attr(get_field('link')['url']) ?>"><?= esc_html(get_field('link')['title']) ?></a>
				<span><?= esc_html(get_field('link_meta')) ?></span>
			</div>
		</div>

	</div>

	<div class="flex gap-4 sm:gap-5 flex-wrap">
		<?php while (have_rows('related')): ?>
			<?php the_row(); ?>
			<div class="sm:mt-9 sm:basis-1/4">
				<a href="<?= esc_attr(get_sub_field('link')['url']) ?>">
					<div class="uppercase text-black font-bold text-xs mb-4 font-alt">
						<?= esc_html(get_sub_field('title')) ?>
					</div>
					<div class="text-black text-xs font-alt">
						<?= esc_html(get_sub_field('description')) ?>
					</div>
				</a>
			</div>
			<?php endwhile; ?>
	</div>

</div>
