<div x-show="!selectedFilter || '<?php echo $classes; ?>' == selectedFilter" class="<?php echo $classes; ?> rounded-3xl mb-5 lg:mb-0 hover:shadow-xl transition scale-100 hover:scale-cards p-5 bg-gray z-10 hover:z-20 relative">
	<div class="aspect-w-3 aspect-h-4">
		<a class="flex flex-col gap-5" href="<?php the_permalink(); ?>">
			<div class="basis-1/2">
				<div class="w-full h-full flex items-center justify-center p-5">
					<?php the_post_thumbnail( 'medium', array( 'class' => 'p-1 w-auto max-h-32 grayscale hover:grayscale-0' ) ); ?>
				</div>
			</div>
			<div class="space-y-2 px-2 pb-2 basis-1/2 flex flex-col justify-end">
				<h2 class="text-2xl font-alt">
					<?php the_title(); ?>
				</h2>

				<div class="text-xl font-alt font-normal text-inherit">
					<p class="text-gray-600"><?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?></p>
				</div>
			</div>
		</a>
	</div>

</div>