<?php

/* ACF BLOCK: Card
 * - A link to a post that is on the same network instance will get title, excerpt, image, and theme & format
 * - These can also be set manually to override fetched values
 */

// Get link or show an error
$link = get_field('content')['link'] ?? false ? get_field('content')['link'] ?? false : ['title' => __('Missing Link!', BB_TEXT_DOMAIN), 'url' => '#'];

$excerpt = '';
$image_id = false;
$blog_id = get_current_blog_id();
$post_id = null;
$theme = [];
$format = [];
$post_type = false;
$placeholder = false;

if ($post_data = bbCard::get_post_data_from_url($link['url'])) {
	// If card is loaded from the Card ACF block, see if there's a post with this URL
	// Use title from post if not manually set
	$link['title'] = $link['title'] != '' ? $link['title'] : $post_data['title'];
	// Get other values from post
	$post_id = $post_data['post_id'];
	$excerpt = $post_data['excerpt'];
	$image_id = $post_data['image_id'];
	$blog_id = $post_data['blog_id'];
	$theme = $post_data['theme'];
	$format = $post_data['format'];
	$post_type = $post_data['post_type'];
	$wkc_image = true;
} elseif (($args['post_id'] ?? false) && ($args['blog_id'] ?? false)) {
	// Else if card is included as a get_template_part() (post_id and blog_id are defined in $args)
	$post_data = bbCard::get_post_data_from_args($args);
	$link['title'] = $post_data['title'];
	$link['url'] = $post_data['url'];
	$post_id = $post_data['post_id'];
	$excerpt = $post_data['excerpt'];
	$image_id = $post_data['image_id'];
	$placeholder = $args['placeholder'] ?? false;
	$blog_id = $post_data['blog_id'] ?? get_current_blog_id();
	$theme = $post_data['theme'];
	$format = $post_data['format'];
	$post_type = $post_data['post_type'];
}

// Override values if alt. versions are provided
if (get_field('content')['alt_details'] ?? false) {
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
// Options: v, vne, h, h2
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
$bgcolor_style = $args['bg_color'] ?? false;
$bgcolor = get_field('style')['color_light'] ?? false;
$bgcolor = $bgcolor == 'default' ? '' : $bgcolor;
if ($bgcolor) {
	$bgcolor = "bg-{$bgcolor}";
	$layout_classes['container'] .= ' p-4';
} elseif ($bgcolor_style) {
	$bgcolor_style = 'background-color: ' . $args['bg_color'];
	$layout_classes['container'] .= ' p-4';
}

// Last check for missing data
if ($link['title'] == '') {
	$link['title'] = __('Missing Link Title!', BB_TEXT_DOMAIN);
}
?>

<div class="bb-card-block rounded-3xl mb-10 lg:mb-5 hover:shadow-xl transition scale-100 hover:scale-cards -mx-2 p-2 z-10 hover:z-20 relative <?= $bgcolor ?>" data-post-id="<?= $post_id ?>" data-blog-id="<?= $blog_id ?>">
<?= $bgcolor_style ?> 	<a href="<?= $link['url'] ?>" class="flex gap-5 <?= $layout_classes['container'] ?>">

		<?php if ($post_type == 'projects' && $image_id): ?>
			<div class="<?= $layout_classes['image'] ?>">
				<div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-xl">
				<div class="w-full h-full flex items-center justify-center p-5">
					<?php echo wp_get_attachment_image($image_id, [400, 0], false, ['class' => 'p-1 w-auto max-h-32']); ?>
				</div>
				</div>
			</div>
		<?php elseif ($image_id || $placeholder): ?>
			<div class="<?= $layout_classes['image'] ?>">
				<div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-2xl overflow-hidden">
					<?php echo bbCard::get_multisite_attachment_image($blog_id, $post_id, $image_id, [400, 0], ['class' => 'object-cover w-full h-full'], $placeholder); ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="<?= $layout_classes['content'] ?> space-y-2 px-2 pb-2">

			<?php if ($theme || $format): ?>
				<div class="uppercase text-primary font-bold text-xs font-alt">
					<?= strip_tags(join(', ', $theme)) ?>
					<?= $theme && $format ? ' | ' : '' ?>
					<?= strip_tags(join(', ', $format)) ?>
				</div>
			<?php endif; ?>

			<h2 class="text-2xl font-alt">
				<?= strip_tags($link['title']) ?>
			</h2>

			<?php if ($layout != 'h2' && $layout != 'vne'): ?>
				<div class="text-xl font-alt font-normal text-inherit line-clamp-2">
					<?= wp_trim_words($excerpt, 20, '...') ?>
				</div>
			<?php endif; ?>

		</div>

	</a>
</div>
