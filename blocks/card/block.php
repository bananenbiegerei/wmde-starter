<?php

// Get link and text
$link = get_field('content')['link'];
$title = $link['title'] ?? 'missing title';
$text = '';
$image = false;
$theme = [];
$format = [];

// See if there's a post with this URL
if ($local_post_id = url_to_postid($link['url'])) {
	$local_post = get_post($local_post_id);
	$text = $local_post->post_excerpt;
	$image = get_post_thumbnail_id($local_post_id); // Get themes and formats
	foreach (wp_get_post_terms($local_post_id, ['format', 'theme']) as $term) {
		if ($term->taxonomy == 'format') {
			$format[] = $term->name;
		}
		if ($term->taxonomy == 'theme') {
			$theme[] = $term->name;
		}
	}
}

// Override if alt. versions are provided
if (get_field('content')['alt_details']) {
	$alt_theme = array_map(function ($a) {
		return $a->name;
	}, get_field('content')['theme']);
	$alt_format = array_map(function ($a) {
		return $a->name;
	}, get_field('content')['format']);
	$theme = $alt_theme ? $alt_theme : $theme;
	$format = $alt_format ? $alt_format : $format;
	$text = get_field('content')['text'] ? get_field('content')['text'] : $text;
	$image = get_field('content')['image'] ? get_field('content')['image'] : $image;
}

// Configure layout classes
$layout = get_field('style')['layout'];
$layout_classes = [];
if ($layout == 'v') {
	$layout_classes['container'] = 'flex-col';
	$layout_classes['image'] = '';
	$layout_classes['content'] = '';
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

<div id="<?= $block['id'] ?>" class="bb-card-block rounded-3xl p-4" style="background-color: <?= get_field('style')['bg_color'] ?>;">
	<a href="<?= $link['url'] ?>" class="flex gap-6 <?= $layout_classes['container'] ?>">

		<?php if ($image): ?>
			<div class="<?= $layout_classes['image'] ?>">
				<?php echo wp_get_attachment_image($image, [400, 0], false, ['class' => 'rounded-2xl aspect-video object-cover min-w-full']); ?>
			</div>
		<?php endif; ?>

		<div class="<?= $layout_classes['content'] ?> space-y-2">

			<?php if ($theme || $format): ?>
				<div class="uppercase text-base text-primary font-bold text-sm font-alt">
					<?= join(', ', $theme) ?>
					<?= $theme && $format ? ' | ' : '' ?>
					<?= join(', ', $format) ?>
				</div>
			<?php endif; ?>

			<h2 class="text-2xl font-alt">
				<?= strip_tags($title) ?>
			</h2>

			<?php if ($layout != 'h2'): ?>
				<div class="text-xl font-alt font-normal text-inherit">
					<?= strip_tags($text) ?>
				</div>
			<?php endif; ?>

		</div>

	</a>
</div>
