<?php

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
	$anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Get link and text
$link = get_field('content')['link'];
$title = $link['title'] ?? '';

// If it's a local link get the excerpt and image from the post
$text = '';
$image = false;
if (parse_url($link['url'], PHP_URL_HOST) == $_SERVER['HTTP_HOST']) {
	$rpost = get_page_by_path(parse_url($link['url'], PHP_URL_PATH));
	if ($rpost) {
		$text = $rpost->post_excerpt;
		$image = get_post_thumbnail_id($rpost->ID);
	}
}
// Override if alt. versions are provided
$text = get_field('content')['text'] ? get_field('content')['text'] : $text;
$image = get_field('content')['image'] ? get_field('content')['image'] : $image;

// Card meta (theme or format)
$meta = get_field('meta')['theme'] ? get_field('meta')['theme'] : get_field('meta')['format'];

// Configure layout classes
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

<div <?php echo $anchor; ?> class="bb-card-block rounded-3xl p-4 mb-6" style="background-color: <?= get_field('style')['bg_color'] ?>;">
	<a href="<?= $link['url'] ?>" class="flex gap-6 <?= $layout_classes['container'] ?>">

		<!-- Image -->
		<?php if ($image): ?>
			<div class="<?= $layout_classes['image'] ?>">
				<?php echo wp_get_attachment_image($image, [400, 0], false, ['class' => 'rounded-2xl aspect-video object-cover min-w-full']); ?>
			</div>
		<?php endif; ?>

		<!-- Text content -->
		<div class=" <?= $layout_classes['content'] ?> space-y-2">
			<?php if ($meta): ?>
				<div class="uppercase text-base text-primary font-bold text-sm font-alt">
					<?= esc_html($meta->name) ?>
				</div>
			<?php endif; ?>
			<div class="text-2xl font-alt">
				<?= strip_tags($title) ?>
			</div>
			<?php if ($layout != 'h2'): ?>
				<div class="text-xl font-alt font-light text-inherit">
					<?= strip_tags($text) ?>
				</div>
			<?php endif; ?>
		</div>

	</a>
</div>
