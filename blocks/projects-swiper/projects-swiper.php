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
<div class="bb-projects-swiper-block pb-20 <?= $swiper_bg ?>" id="<?= $block['id'] ?>">
	<!-- Headline and Navigation -->
			<div class="flex mb-5">
				<div class="grow">
					<h2 class="text-5xl text-primary"><?= __('Projects', BB_TEXT_DOMAIN) ?></h2>
				</div>
				<div class="relative hidden lg:flex space-x-2 items-center">
					<?= bb_icon('chevron-left', 'swiper-button-prev btn btn-icon-only btn-hollow cursor-pointer') ?>
					<?= bb_icon('chevron-right', 'swiper-button-next btn btn-icon-only btn-hollow cursor-pointer') ?>
				</div>
	</div>
	<!-- Swiper -->
	<div class="swiper-container relative">
		<!-- Slides -->
		<div class="swiper-wrapper h-full">
			<?php foreach (get_field('projects') as $project): ?>
			<div class="swiper-slide rounded-2xl p-5 hover:shadow-xl transition hover:scale-cards <?= $slide_bg ?> self-stretch"><!-- Slide size defined in block SCSS -->
				<a class="block flex flex-col space-y-5" href="<?php echo get_post_permalink($project->ID); ?>">
					<!-- Thumbnail -->
					<div class="">
						<?php if (has_post_thumbnail($project->ID)): ?>
						<img class="h-40 object-contain mx-auto my-5 grayscale mix-blend-multiply hover:grayscale-0" src="<?php echo get_the_post_thumbnail_url($project->ID, 'medium'); ?>">
						<?php endif; ?>
					</div>

					<!-- Title -->
					<div>
						<h3 class="text-3xl break-words font-alt font-normal"><?php echo $project->post_title; ?></h3>
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
		slidesPerView: '1',
		centeredSlides: false,
		spaceBetween: 40,
		grabCursor: true,
		draggable: true,
		navigation: {
			nextEl: '#<?= $block['id'] ?> .swiper-button-next',
			prevEl: '#<?= $block['id'] ?> .swiper-button-prev',
		},
		//speed: 100,
		// autoplay: {
		// 	delay: 4000,
		// 	disableOnInteraction: true,
		// },
		breakpoints: {
			// when window width is >= 320px
			320: {
			  slidesPerView: 1,
			  spaceBetween: 20
			},
			// when window width is >= 480px
			480: {
			  slidesPerView: 1,
			  spaceBetween: 30
			},
			// when window width is >= 640px
			640: {
			  slidesPerView: 2,
			  spaceBetween: 40
			},
			1028: {
			  slidesPerView: 3,
			  spaceBetween: 40
			},
			1200: {
			  slidesPerView: 4,
			  spaceBetween: 40
			}
		  }
	};
</script>
<?php else: ?>
<!-- Skeleton view for editor -->
<div class="<?= $swiper_bg ?>">
	<b><?= __('Projects Swiper', BB_TEXT_DOMAIN) ?></b>

	<div class="grid grid-cols-4 gap-4">
		<?php foreach (get_field('projects') as $project): ?>
		<div class="rounded-3xl p-4 <?= $slide_bg ?>">
			<?php if (has_post_thumbnail($project->ID)): ?>
			<img class="h-32 object-contain" src="<?php echo get_the_post_thumbnail_url($project->ID, 'medium'); ?>">
			<?php endif; ?>
			<p class="text-s"><?php echo $project->post_title; ?></p>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
