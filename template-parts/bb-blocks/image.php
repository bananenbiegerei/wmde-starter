<?php
$image = get_field('image');
$size = 'full';
$ratio_factor = 0.74; // height compared to a width of 1. Example 4:3 -> .75, or .74 to allow some leeway
$image_caption = wp_get_attachment_caption($image);
$image_meta_data = wp_get_attachment_metadata($image);
$width = get_field('wide') ? '' : 'max-w-2xl mx-auto';

$figure_classes = 'relative my-2 rounded-2xl';
$image_classes = ['class' => "{$width} rounded-2xl w-full h-auto"];
if ($image_meta_data['width'] * $ratio_factor > $image_meta_data['height']) {
	$figure_classes = 'flex rounded-2xl relative justify-center bg-secondary my-2 overflow-hidden';
	$image_classes = ['class' => "{$width} z-10 h-auto max-w-2xl mx-auto w-full"];
}
?>
	<div class="bb-image-block <?php echo $width; ?>">
		<figure class="<?= $figure_classes ?>" role="group">
			<?= wp_get_attachment_image($image, $size, '', $image_classes) ?>
			<?php if ($image_caption): ?>
				<figcaption class="invisible flex absolute rounded-b-2xl absolute left-0 bottom-0 right-0 text-white bg-black w-auto h-auto z-20 p-2 text-sm flex items-start gap-4 break-all" >
					<?= bb_icon('info') ?> <div><?= strip_tags($image_caption, ['a']) ?></div>
				</figcaption>
			<?php endif; ?>
		</figure>
	</div>
