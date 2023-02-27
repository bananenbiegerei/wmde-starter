<?php

// If call from Image block or Gallery Swiper block
$image_id = get_field('image') ? get_field('image') : $args['image']['id'] ?? false;
// If called from Wikimedia Commons Media block
$image_data = $args['wkcm_data'] ?? false;

if ($image_data) {
	$image_caption = $image_data['usageterms'] . ' - <a href="' . esc_attr($image_data['url']) . '">Wikimedia Commons</a>';
	$image_descripton = $image_data['desc'];
	$dim = explode('x', $image_data['dim']);
	$image_meta_data = ['width' => $dim[0], 'height' => $dim[1]];
} else {
	$image_caption = wp_get_attachment_caption($image);
	$image_descripton = get_post($image)->post_content;
	$image_meta_data = wp_get_attachment_metadata($image);
}

$width = get_field('wide');
$figure_classes = 'flex flex-col relative rounded-2xl';
$image_classes = ['class' => "{$width} rounded-2xl w-full h-auto"];
if ($image_meta_data['width'] * 0.74 < $image_meta_data['height']) {
	$figure_classes = 'flex flex-col rounded-2xl relative justify-center bg-secondary overflow-hidden';
	$image_classes = ['class' => "{$width} h-auto max-w-2xl mx-auto w-full"];
}

if ($image_data) {
	$image = "<img src='{$image_data['media_url']}' srcset='{$image_data['srcset']}' alt='{$image_data['desc']}' loading='lazy' sizes='(max-width: 1024px) 100vw, 1024px' class='{$image_classes['class']}'>";
} else {
	$image = wp_get_attachment_image($image_id, 'full', '', $image_classes);
}

$figure_classes .= $image_caption ? '' : ' no_caption';
?>
<div class="bb-image-block my-4 <?php echo $width; ?>">
	<figure class="<?= $figure_classes ?>" role="group">
		<?= $image ?>
		<?php if ($image_caption): ?>
			<figcaption class="invisible flex absolute rounded-b-2xl absolute left-0 bottom-0 right-0 text-white bg-black w-auto h-auto z-20 p-2 text-sm flex items-start gap-4 break-all" >
				<?= bb_icon('info') ?> <div><?= strip_tags($image_caption, ['a']) ?></div>
			</figcaption>
		<?php endif; ?>
	</figure>
</div>
