<?php

// FIXME: re-implement excerpt and add option to show excerpt

/* ACF BLOCK: Card
 * Notes:
 * - Title, excerpt, image, and theme & format will be fetched for link to a post that is on any subsite of the same network instance
 * - If there are issues with links, try refreshing permalinks on that subsite
 */

// Get link from ACF or show an error
// FIXME: this is way to obscure...
$link = get_field('content')['link'] ?? false ? get_field('content')['link'] ?? false : ['title' => __('Missing Link!', BB_TEXT_DOMAIN), 'url' => '#'];

// Set default values
$blog_id = get_current_blog_id();
$post_id = null;
$excerpt = null;
$theme = [];
$format = [];
$post_type = false;
$placeholder = false;
$alt_image_id = false;

// Try to find the post that we're linking to
if (($args['post_id'] ?? false) && ($args['blog_id'] ?? false)) {
	// If card is included as a get_template_part() (post_id, blog_id, and layout are defined in $args)
	// get_template_part('blocks/card/card', null, ['blog_id' => $blog_id, 'post_id' => $post_id, 'layout' => $layout]);
	$post_data = bbCard::get_post_data_from_args($args);
	$link['title'] = $post_data['title'];
	$link['url'] = $post_data['url'];
	$post_id = $post_data['post_id'];
	$blog_id = $post_data['blog_id'];
	$excerpt = $post_data['excerpt'];
	$placeholder = $args['placeholder'] ?? false;
	$theme = $post_data['theme'];
	$format = $post_data['format'];
	$post_type = $post_data['post_type'];
} elseif ($post_data = bbCard::get_post_data_from_url($link['url'])) {
	// If card is loaded from the Card ACF block, see if there's a post with this URL
	// Use the title from the post if it has not been manually set
	$link['title'] = $link['title'] != '' ? $link['title'] : $post_data['title'];
	// Get other values from post
	$post_id = $post_data['post_id'];
	$blog_id = $post_data['blog_id'];
	$excerpt = $post_data['excerpt'];
	$theme = $post_data['theme'];
	$format = $post_data['format'];
	$post_type = $post_data['post_type'];
} else {
}

// Override values if alt. versions are provided
if (get_field('content')['alt_details'] ?? false) {
	$excerpt = get_field('content')['excerpt'] ? get_field('content')['excerpt'] : $excerpt;
	$alt_image_id = get_field('content')['image'];
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

// Set featured image
$featured_image = null;
if ($post_type == 'projects' && !$alt_image_id && ($image_id = get_post_thumbnail_id($post_id))) {
	// If it's a project w/o an alt. image
	$featured_image = wp_get_attachment_image($image_id, 'full', false, ['class' => 'p-5 w-auto max-h-32 rounded-2xl']);
} elseif ($alt_image_id) {
	// If there's an alt. image, use it
	$featured_image = wp_get_attachment_image($alt_image_id, 'full', false, ['class' => 'object-cover w-full h-full rounded-2xl']);
} else {
	// Otherwise get the featured image of the post
	$featured_image = bbCard::get_multisite_featured_image($blog_id, $post_id, 'full', ['class' => 'object-cover w-full h-full rounded-2xl'], $placeholder);
}

// Configure layout classes
// Layout options: v (vertical), vne (vertical no excerpt), h (horizontal 1-1), h2 (horizontal 1-2)
$layout = $args['layout'] ?? get_field('style')['layout'];
$layout_classes = [];
if ($layout == 'v' || $layout == 'vne') {
	$layout_classes['container'] = 'flex-col';
	$layout_classes['image'] = '';
	$layout_classes['content'] = '';
} elseif ($layout == 'h' || $layout == 'hwe' || $layout == 'hwexl') {
	$layout_classes['container'] = 'flex-col lg:flex-row';
	$layout_classes['image'] = 'lg:basis-1/2';
	$layout_classes['content'] = 'lg:basis-1/2 lg:self-center';
} elseif ($layout == 'h2' || $layout == 'h2we') {
	$layout_classes['container'] = 'flex-col lg:flex-row';
	$layout_classes['image'] = 'basis-full lg:basis-1/3';
	$layout_classes['content'] = 'basis-full lg:basis-2/3';
}

// Add background color and padding
// FIXME: not sure if $args['bg_color'] is still used somewhere
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
// FIXME: not sure if it's still needed
if ($link['title'] == '') {
	$link['title'] = __('Missing Link Title!', BB_TEXT_DOMAIN);
}
?>

<div class="bb-card-block mb-5 lg:mb-10 z-10 relative <?= $bgcolor ?>" data-post-id="<?= $post_id ?>" data-blog-id="<?= $blog_id ?>" style="<?= $bgcolor_style ?>">

	<?php if (!is_admin()): ?>
	<a href="<?= $link['url'] ?>" class="flex gap-5 <?= $layout_classes['container'] ?> text-hover-effect image-hover-effect">
	<?php endif; ?>

		<?php if ($post_type == 'projects' && $featured_image && !$alt_image_id): ?>
			<div class="<?= $layout_classes['image'] ?>">
				<div class="aspect-w-16 aspect-h-9">
				<div class="flex items-center justify-center">
					<?= $featured_image ?>
				</div>
				</div>
			</div>
		<?php elseif ($featured_image): ?>
			<div class="<?= $layout_classes['image'] ?>">
				<div class="aspect-w-16 aspect-h-9">
					<?= $featured_image ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="<?= $layout_classes['content'] ?> space-y-2 px-2 pb-2 card-content">

			<?php if ($theme || $format): ?>
				<div class="topline">
					<?= strip_tags(join(', ', $theme)) ?>
					<?= $theme && $format ? ' | ' : '' ?>
					<?= strip_tags(join(', ', $format)) ?>
				</div>
			<?php endif; ?>

			<h2 class="<?= $layout == 'hwexl' ? 'text-base lg:text-3xl' : 'text-base lg:text-2xl' ?> font-alt">
				<?= htmlspecialchars_decode(strip_tags($link['title'])) ?>
			</h2>

			<?php if (in_array($layout, ['v', 'hwe', 'hwexl', 'h2we'])): ?>
				<p class="<?= $layout == 'hwexl' ? 'text-sm lg:text-xl' : 'text-sm lg:text-xl' ?> font-normal line-clamp-3">
					<?= $excerpt ?>
				</p>
			<?php endif; ?>

		</div>

	<?php if (!is_admin()): ?>
	</a>
	<?php endif; ?>
</div>
