<?php
/*
	Image Block: also used by Gallery Swiper block and Wikimedia Commons Media block via `get_template_part()`.
*/

// If called from Image block or Gallery Swiper block
$image_id = get_field('image') ? get_field('image') : $args['image']['id'] ?? false;
// If called from Wikimedia Commons Media block
$wmc_image_data = $args['wmc_data'] ?? false;

// Setup image parameters
if ($image_id) {
	// If called from Image ACF block or Gallery Swiper block
	$image_caption = strip_tags(wp_get_attachment_caption($image_id), ['a']);
	$image_descripton = get_post($image_id)->post_content;
	$image_meta_data = wp_get_attachment_metadata($image_id);
	$rounded = get_field('style')['rounded'] ?? ($args['rounded'] ?? false);
} elseif ($wmc_image_data) {
	// If called from Wikimedia Commons Media block as get_template_part()
	$image_caption = '<a href="' . esc_attr($wmc_image_data['url']) . '">' . $wmc_image_data['creator'] . ' - ' . $wmc_image_data['usageterms'] . '</a>';
	$image_descripton = $wmc_image_data['desc'];
	$dim = explode('x', $wmc_image_data['dim']);
	$image_meta_data = ['width' => (int) $dim[0], 'height' => (int) $dim[1]];
	$rounded = $args['rounded'] ?? false;
} else {
	$image_caption = 'Missing image!';
	$image_descripton = '';
	$image_meta_data = ['width' => 180, 'height' => 139];
	$rounded = false;
}

// Get values for container and image classes
if ($image_meta_data['width'] * 0.74 < $image_meta_data['height']) {
	// For portrait
	$figure_classes = 'flex flex-col relative justify-center bg-secondary overflow-hidden ' . ($rounded ? 'rounded-2xl ' : '');
	$image_classes = ['class' => 'h-auto max-w-2xl mx-auto w-full'];
} else {
	// For landscape
	$figure_classes = 'flex flex-col relative ';
	$image_classes = ['class' => 'w-full h-auto ' . ($rounded ? 'rounded-2xl ' : '')];
}

$figure_classes .= $image_caption ? '' : ' no_caption';
$caption_classes = 'invisible flex absolute left-0 bottom-0 right-0 text-white bg-black w-auto h-auto z-20 p-2 text-sm flex items-start gap-4 break-all ' . ($rounded ? 'rounded-b-2xl' : '');

// Create image tag
if ($image_id) {
	$image = wp_get_attachment_image($image_id, 'full', '', $image_classes);
} elseif ($wmc_image_data) {
	$image = "<img src='{$wmc_image_data['media_url']}' srcset='{$wmc_image_data['srcset']}' alt='{$wmc_image_data['desc']}' loading='lazy' sizes='(max-width: 1024px) 100vw, 1024px' class='{$image_classes['class']}'>";
} else {
	$placeholder = esc_url(get_template_directory_uri() . '/blocks/image/placeholder.svg');
	$image = "<img src='{$placeholder}' class='{$image_classes['class']}'>";
}
?>
<div class="bb-image-block my-4">
	<figure class="<?= $figure_classes ?>" role="group">
		<?= $image ?>
		<?php if ($image_caption): ?>
			<figcaption class="<?= $caption_classes ?>">
				<?= bb_icon('info', 'flex-shrink-0') ?> <div class="self-center"><?= $image_caption ?></div>
			</figcaption>
		<?php endif; ?>
	</figure>
</div>
