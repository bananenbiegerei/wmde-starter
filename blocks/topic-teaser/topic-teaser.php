<?php if ($selected_topic = get_field('select_topic')): ?>

	<?php $topic_color = get_post_meta($selected_topic->ID, 'color_for_theme', true); ?>

	<div class="bb-topic-teaser-block">
		<div class="rounded-3xl p-10 grid grid-cols-12" style="background-color: <?= $topic_color ?>">

			<?php if (has_post_thumbnail($selected_topic->ID)): ?>
				<div class="col-span-4">
					<div class="aspect-w-4 aspect-h-3 relative -translate-x-10 -translate-y-10 rounded-tl-3xl rounded-br-3xl overflow-hidden">
						<?= get_the_post_thumbnail($selected_topic->ID, 'large', ['class' => 'h-full w-full object-cover']) ?>
					</div>
				</div>
			<?php endif; ?>>

				<div class="col-span-8 flex flex-col">
					<h2 class="uppercase text-primary font-bold text-base font-alt">
						<!-- Title -->
						<?= esc_html($selected_topic->post_title) ?>
					</h2>

					<!-- Text -->
						<div class="font-normal flex-grow pr-5 pb-5 text-lg lg:text-xl">
							<?= esc_html($selected_topic->post_excerpt) ?>
						</div>

					<!-- Button and extra info -->
					<div class="flex-1 flex items-end pb-10">
						<a href="<?= esc_url(get_permalink($selected_topic->ID)) ?>" class="btn btn-hollow">
							<?php _e('More', BB_TEXT_DOMAIN); ?>
						</a>
					</div>

				</div>

				<div class="col-span-12">
					repeater
				</div>
		</div>
	</div>
<?php endif; ?>
