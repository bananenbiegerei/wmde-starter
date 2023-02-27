<?php

$image = get_field('image') ? get_field('image') : $args['image']['id'];
$width = get_field('wide');

$ratio_factor = 0.74; // height compared to a width of 1. Example 4:3 -> .75, or .74 to allow some leeway
$image_caption = wp_get_attachment_caption($image);
$image_descripton = get_post($image)->post_content;
$image_meta_data = wp_get_attachment_metadata($image);

$figure_classes = 'flex flex-col relative rounded-2xl';
$image_classes = ['class' => "{$width} rounded-2xl w-full h-auto"];
if ($image_meta_data['width'] * $ratio_factor < $image_meta_data['height']) {
	$figure_classes = 'flex flex-col rounded-2xl relative justify-center bg-secondary overflow-hidden';
	$image_classes = ['class' => "{$width} h-auto max-w-2xl mx-auto w-full"];
}
$figure_classes .= $image_caption ? '' : ' no_caption';
?>
<div class="bb-image-block	 <?php /* echo $width; */ ?> container grid grid-cols-12">
	<figure class="<?= $figure_classes ?> col-span-12 lg:col-span-8 lg:col-start-3" role="group">
		<?= wp_get_attachment_image($image, 'full', '', $image_classes) ?>
		<?php if ($image_caption): ?>
			<figcaption class="invisible flex absolute rounded-b-2xl absolute left-0 bottom-0 right-0 text-white bg-black w-auto h-auto z-20 p-2 text-sm flex items-start gap-4 break-all" >
				<?= bb_icon('info') ?> <div><?= strip_tags($image_caption, ['a']) ?></div>
			</figcaption>
		<?php endif; ?>
	</figure>
	<?= $image_descripton ?>
</div>
