<div class="aspect-w-3 aspect-h-4">
	<a class="flex flex-col gap-5" href="<?php echo get_post_permalink($project->ID); ?>">
		<div class="basis-1/2">
			<div class="w-full h-full flex items-center justify-center p-5">
				<?php if (has_post_thumbnail($project->ID)): ?>
				<img class="h-40 object-contain mx-auto my-5 grayscale mix-blend-multiply hover:grayscale-0" src="<?php echo get_the_post_thumbnail_url($project->ID, 'medium'); ?>">
				<?php endif; ?>
			</div>
		</div>
		<div class="space-y-2 px-2 pb-2 basis-1/2 flex flex-col justify-end">
			<h2 class="text-2xl font-sans font-medium">
				<?php echo $project->post_title; ?>
			</h2>
			<div class="text-xl font-alt font-normal text-inherit">
				<p class="line-clamp-5">
					<?php echo strip_tags(get_the_excerpt($project->ID)); ?>
				</p>
			</div>
		</div>
	</a>
</div>