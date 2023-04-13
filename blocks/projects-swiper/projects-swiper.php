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
<div class="bb-projects-swiper-block mb-20 <?= $swiper_bg ?>" id="<?= $block['id'] ?>">
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
	<div class="swiper-container relative mb-10">
		<!-- Slides -->
		<div class="swiper-wrapper h-full">
			<?php foreach (get_field('projects') as $project): ?>
			<div class="swiper-slide rounded-2xl p-5 <?= $slide_bg ?> self-stretch"><!-- Slide size defined in block SCSS -->
			<?php include( locate_template( 'template-parts/card-project-inner.php', false, false ) ); ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<a class="btn btn-base btn-icon-left" href="<?php the_permalink('23'); ?>">
		<?= bb_icon('arrow-right','icon-base'); ?>
		<?= __('Alle Projekte', BB_TEXT_DOMAIN) ?>
	</a>
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
