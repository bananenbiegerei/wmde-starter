<?php

/* ACF BLOCK: Card
 * - A link to a post that is on the same network instance will get title, excerpt, image, and theme & format
 * - These can also be set manually to override fetched values
 */

// Get link or show an error
$link = get_field('content')['link'] ? get_field('content')['link'] : ['title' => __('Missing Link!', BB_TEXT_DOMAIN), 'url' => '#'];

$excerpt = '';
$image_id = false;
$blog_id = get_current_blog_id();
$post_id = null;
$theme = [];
$format = [];
$post_type = false;

if ($args['post_id'] ?? (false && $args['blog_id'] ?? false)) {
	// If card is included as a get_template_part()
	$post_data = bbCard::get_post_data_from_include($args['blog_id'], $args['post_id']);
	$link['title'] = $post_data['title'];
	$link['url'] = $post_data['url'];
	$post_id = $post_data['post_id'];
	$excerpt = $post_data['excerpt'];
	$image_id = $post_data['image'];
	$blog_id = $post_data['blog_id'];
	$theme = $post_data['theme'];
	$format = $post_data['format'];
	$post_type = $post_data['post_type'];
} elseif ($post_data = bbCard::find_post_data($link['url'])) {
	// See if there's a post with this URL
	// Use title from post if not manually set
	$link['title'] = $link['title'] != '' ? $link['title'] : $post_data['title'];
	// Get other values from post
	$post_id = $post_data['post_id'];
	$excerpt = $post_data['excerpt'];
	$image_id = $post_data['image'];
	$blog_id = $post_data['blog_id'];
	$theme = $post_data['theme'];
	$format = $post_data['format'];
	$post_type = $post_data['post_type'];
}

// Override values if alt. versions are provided
if (get_field('content')['alt_details']) {
	$excerpt = get_field('content')['text'] ? get_field('content')['text'] : $excerpt;
	$image_id = get_field('content')['image'] ? get_field('content')['image'] : $image_id;
	$alt_theme = array_map(
		function ($a) {
			return $a->name;
		},
		get_field('content')['theme'] ? get_field('content')['theme'] : [],
	);
	$theme = $alt_theme ? $alt_theme : $theme;
	$alt_format = array_map(
		function ($a) {
			return $a->name;
		},
		get_field('content')['format'] ? get_field('content')['format'] : [],
	);
	$format = $alt_format ? $alt_format : $format;
}

// Configure layout classes
$layout = $args['layout'] ?? get_field('style')['layout'];
$layout_classes = [];
if ($layout == 'v' || $layout == 'vne') {
	// 'vne' is 'vertical no excerpt' used by latest-posts block
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

// Add background color and padding
if (get_field('style')['bg_color']) {
	$bgcolor = 'background-color: ' . get_field('style')['bg_color'] . ';';
	$layout_classes['container'] .= ' p-4';
} else {
	$bgcolor = '';
}

// Last check for missing data
if ($link['title'] == '') {
	$link['title'] = __('Missing Link Title!', BB_TEXT_DOMAIN);
}
?>

<div id="<?= $block['id'] ?>" class="bb-card-block rounded-3xl mb-10 hover:shadow-xl transition scale-100 hover:scale-cards" style="<?= $bgcolor ?>" data-post-id="<?= $post_id ?>" data-blog-id="<?= $blog_id ?>">
	<a href="<?= $link['url'] ?>" class="flex gap-5 <?= $layout_classes['container'] ?>">

		<?php if ($post_type == 'projects' && $image_id): ?>
			<div class="<?= $layout_classes['image'] ?>">
				<div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-xl">
				<div class="w-full h-full flex items-center justify-center p-5">
					<?php echo wp_get_attachment_image($image_id, [400, 0], false, ['class' => 'p-1 w-auto max-h-32']); ?>
				</div>
				</div>
			</div>
			<!-- FIXME: @EL please hide if post thumbnail or wikicommons is empty, right now it displays the gray container -->
		<?php elseif ($image_id): ?>
			<div class="<?= $layout_classes['image'] ?>">
				<div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-2xl overflow-hidden">
					<?php echo bbCard::get_multisite_attachment_image($blog_id, $image_id, [400, 0], ['class' => 'object-cover w-full h-full']); ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="<?= $layout_classes['content'] ?> space-y-2 px-2 pb-2">

			<?php if ($theme || $format): ?>
				<div class="uppercase text-base text-primary font-bold text-sm font-alt">
					<?= strip_tags(join(', ', $theme)) ?>
					<?= $theme && $format ? ' | ' : '' ?>
					<?= strip_tags(join(', ', $format)) ?>
				</div>
			<?php endif; ?>

			<h2 class="text-xl font-alt">
				<?= strip_tags($link['title']) ?>
			</h2>

			<?php if ($layout != 'h2' && $layout != 'vne'): ?>
				<div class="text-xl font-alt font-normal">
					<?= strip_tags($excerpt) ?>
				</div>
			<?php endif; ?>

		</div>

	</a>
</div>
