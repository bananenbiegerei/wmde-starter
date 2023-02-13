<?php
/*
	NOTES:
	- This block must not have any horizontal padding/margin. It should be full-width.
	- Padding is added to top-level div. For now: px-10.

*/
?>
<?php define('EXCERPT_LENGTH', 30); ?>
<?php $swiper_bg = get_field('background') == 'white' ? 'bg-white' : 'bg-gray-100'; ?>
<?php $slide_bg = get_field('background') == 'white' ? 'bg-gray-100' : ' bg-white'; ?>

<?php if (!is_admin()): ?>
	<div class="bb-projects-swiper-block px-10 pb-16 pt-16 <?= $swiper_bg ?>" id="<?= $block['id'] ?>">
			<h2 class="text-5xl"><?= __('Projects', BB_TEXT_DOMAIN) ?></h2>

			<div class="swiper-container relative mt-4">

				<!-- Navigation -->
				<div class="absolute -top-20 right-0 hiddenlg:block">
					<div class="inline-block swiper-button-prev h-14 w-14 hover:text-transparent cursor-pointer">
						<?= bb_icon('swiper-left') ?>
					</div>
					<div class="inline-block swiper-button-next h-14 w-14 hover:text-transparent cursor-pointer">
						<?= bb_icon('swiper-right') ?>
					</div>
				</div>

				<!-- Slides -->
				<div class="swiper-wrapper">
					<?php foreach (get_field('projects') as $project): ?>
						<div class="swiper-slide rounded-2xl p-8 pt-16 <?= $slide_bg ?>"><!-- Slide size defined in block SCSS -->
							<a class="block flex flex-col items-center" href="<?php echo get_post_permalink($project->ID); ?>">

								<!-- Thumbnail -->
								<div class="mb-10">
										<?php if (has_post_thumbnail($project->ID)): ?>
											<img
												class="h-64 object-contain"
												src="<?php echo get_the_post_thumbnail_url($project->ID, 'medium'); ?>">
										<?php endif; ?>
								</div>

								<!-- Title -->
								<div class="mb-2">
										<h3 class="text-3xl"><?php echo $project->post_title; ?></h3>
								</div>

								<!-- Description -->
								<div class="text-lg text-inherit">
									<?php if (get_field('description', $project->ID)): ?>
										<p><?php echo wp_trim_words(get_field('description', $project->ID), EXCERPT_LENGTH, '... <br>'); ?></p>
									<?php else: ?>
										<p><?php echo get_the_excerpt($project->ID); ?></p>
									<?php endif; ?>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
	</div>
	<script>
			SwipersConfig['#<?= $block['id'] ?>'] = {
					loop: true,
					slidesPerView: 'auto',
					centeredSlides: true,
					spaceBetween: 40, // FIXME: should be rem?
					grabCursor: true,
					draggable: true,
					navigation: {
							nextEl: '.swiper-button-next',
							prevEl: '.swiper-button-prev',
					},
					speed: 1400,
					autoplay: {
							delay: 4000,
							disableOnInteraction: true,
					},
					breakpoints: {}
			};
	</script>
<?php else: ?>
	<!-- Skeleton view for editor -->
	<div class="<?= $swiper_bg ?> p-8">
	<h2><?= __('Projects', BB_TEXT_DOMAIN) ?></h2>
	<div class="overflow-hidden flex gap-10">
		<?php for ($i = 0; $i < 3; $i++): ?>
			<div class="<?= $slide_bg ?> rounded-2xl w-80 p-8 pt-16 flex flex-col items-center" href="<?php echo get_post_permalink($project->ID); ?>">
				<div class="mb-10 h-64 w-64 rounded-xl bg-gray-300 ">
				</div>
				<div class="mb-2">
						<h3 class="text-3xl text-transparent bg-gray-300">Project</h3>
				</div>
				<div class="bg-gray-300 text-transparent text-inherit">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				</div>
			</div>
		<?php endfor; ?>
	</div>
	</div>
<?php endif; ?>
