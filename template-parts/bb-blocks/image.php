<?php
$image = get_field('image');
$size = 'full';
$ratio_factor = 0.74; // height compared to a width of 1. Example 4:3 -> .75, or .74 to allow some leeway
if ($image):

	$image_meta_data = wp_get_attachment_metadata($image);
	if ($image_meta_data['width'] * $ratio_factor > $image_meta_data['height']) {
		$image_class = 'landscape';
	} else {
		$image_class = 'portrait';
	}
	$image_caption = wp_get_attachment_caption($image);
	?>
<?php
$width = get_field('options');
if ($width == 'narrow') {
	$width = 'max-w-2xl mx-auto';
}
?>
	<div class="bb-image-block <?php echo $width; ?>">
		<?php if ($image_class == 'landscape'): ?>
			<figure class="relative my-2" role="group">
				<?php echo wp_get_attachment_image($image, $size, '', ['class' => 'w-full h-auto']); ?>
				<?php if ($image_caption): ?>
					<figcaption class="caption hidden lg:block absolute top-0 right-0 bg-secondary w-auto h-auto z-20 p-2 text-sm">
						<?php echo esc_attr($image_caption); ?>
					</figcaption>
				<?php endif; ?>
			</figure>
		<?php else: ?>
			<figure class="flex justify-center bg-secondary my-2" role="group">
				<div class="relative">
					<?php echo wp_get_attachment_image($image, $size, '', ['class' => 'h-auto max-w-2xl mx-auto w-full']); ?>
					<?php if ($image_caption): ?>
						<figcaption class="block caption absolute top-0 right-0 bg-secondary w-auto h-auto z-20 p-2 text-sm">
							<?php echo esc_attr($image_caption); ?>
						</figcaption>
					<?php endif; ?>
				</div>
			</figure>
		<?php endif; ?>
	</div>
<?php
endif; ?>
