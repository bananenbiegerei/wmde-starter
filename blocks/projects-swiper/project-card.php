<?php $pid = isset($project) ? $project->ID : null; ?>

<a class="flex flex-col gap-5 h-full text-hover-effect image-hover-effect grayscale hover:grayscale-0 " href="<?php echo get_post_permalink($pid); ?>">
	<div class="basis-1/2">
		<div class="w-full h-full flex items-center justify-center p-5">
			<?php if (has_post_thumbnail($pid)): ?>
				<img class="h-40 object-contain mx-auto my-5 mix-blend-multiply " src="<?php echo get_the_post_thumbnail_url($pid, 'medium'); ?>" alt="<?php echo esc_attr(
	get_post_meta(get_post_thumbnail_id($pid), '_wp_attachment_image_alt', true),
); ?>">
			<?php endif; ?>
		</div>
	</div>
	<div class="space-y-2 px-2 pb-2 basis-1/2 flex flex-col justify-end">
		<h2 class="text-2xl font-sans font-medium">
			<?= get_the_title($pid) ?>
		</h2>
		<div class="text-xl font-normal text-inherit">
			<p class="line-clamp-5">
				<?php echo strip_tags(get_the_excerpt($pid)); ?>
			</p>
		</div>
	</div>
</a>
