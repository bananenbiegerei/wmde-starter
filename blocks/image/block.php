<?php
/*
	Image Block: also used by Gallery Swiper block and Wikimedia Commons Media block via `get_template_part()`.
*/

// If call from Image block or Gallery Swiper block
$image_id = get_field('image') ? get_field('image') : $args['image']['id'] ?? false;
// If called from Wikimedia Commons Media block
$wmc_image_data = $args['wmc_data'] ?? false;

if ($image_id) {
	$image_caption = wp_get_attachment_caption($image_id);
	$image_descripton = get_post($image_id)->post_content;
	$image_meta_data = wp_get_attachment_metadata($image_id);
	$wide = get_field('wide');
} elseif ($wmc_image_data) {
	$image_caption = $wmc_image_data['usageterms'] . ' - <a href="' . esc_attr($wmc_image_data['url']) . '">Wikimedia Commons</a>';
	$image_descripton = $wmc_image_data['desc'];
	$dim = explode('x', $wmc_image_data['dim']);
	$image_meta_data = ['width' => (int) $dim[0], 'height' => (int) $dim[1]];
	$wide = $args['wide'];
} else {
	$image_caption = 'Missing image!';
	$image_descripton = '';
	$image_meta_data = ['width' => 180, 'height' => 139];
	$wide = false;
}

// Get values for container and image classes
$width = $wide ? 'FIXME:missing' : 'FIXME:missing';
$figure_classes = 'flex flex-col relative rounded-2xl';
$image_classes = ['class' => "{$width} rounded-2xl w-full h-auto"];
// For vertical images
if ($image_meta_data['width'] * 0.74 < $image_meta_data['height']) {
	$figure_classes = 'flex flex-col rounded-2xl relative justify-center bg-secondary overflow-hidden';
	$image_classes = ['class' => "{$width} h-auto max-w-2xl mx-auto w-full"];
}
$figure_classes .= $image_caption ? '' : ' no_caption';

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
<div class="bb-image-block my-4 <?= $width ?>">
	<figure class="<?= $figure_classes ?> col-span-12 lg:col-span-8 lg:col-start-3" role="group">
		<?= $image ?>
		<?php if ($image_caption): ?>
			<figcaption class="invisible flex absolute rounded-b-2xl absolute left-0 bottom-0 right-0 text-white bg-black w-auto h-auto z-20 p-2 text-sm flex items-start gap-4 break-all" >
				<?= bb_icon('info') ?> <div><?= strip_tags($image_caption, ['a']) ?></div>
			</figcaption>
		<?php endif; ?>
	</figure>
</div>
