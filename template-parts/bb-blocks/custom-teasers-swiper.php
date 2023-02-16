<?php
/*
	NOTES:
	- This block must not have any horizontal padding/margin. It should be full-width.
	- Padding is added to top-level div. For now: px-10.

*/
?>
<?php if (!is_admin()): ?>
<div class="bb-custom-teasers-swiper-block overflow-hidden px-10 pb-16 pt-16 " id="<?= $block['id'] ?>">

	<h2 class="text-5xl"><?= esc_html(get_field('headline')) ?></h2>

	<div class="swiper-container relative">

		<!-- Navigation -->
		<div class="absolute -top-16 right-0 hidden lg:block">
				<?= bb_icon('swiper-left', 'swiper-button-prev h-14 w-14 hover:text-transparent cursor-pointer') ?>
				<div class="swiper-pagination inline-block text-3xl font-alt align-middle mx-2"></div>
				<?= bb_icon('swiper-right', 'swiper-button-next h-14 w-14 hover:text-transparent cursor-pointer') ?>
		</div>

		<div class="swiper-wrapper">

			<?php while (have_rows('slides')): ?>
				<?php the_row(); ?>
				<div class="swiper-slide rounded-3xl p-4 flex flex-col" style="height:unset; background-color: <?= get_sub_field('bg_color') ?>">
					<!-- height unset to make all slides full height -->

					<div>
						<?= wp_get_attachment_image(get_sub_field('image'), [400, 0], false, ['class' => 'rounded-2xl aspect-video object-cover min-w-full']) ?>
					</div>

					<?php if ($headline = get_sub_field('headline')): ?>
						<div class="text-xl mt-4">
							<?= esc_html($headline) ?>
						</div>
					<?php endif; ?>

					<?php if ($description = get_sub_field('description')): ?>
						<div class="text-base mt-4">
							<?= esc_html($description) ?>
						</div>
					<?php endif; ?>

					<?php if ($link = get_sub_field('link')): ?>
						<div class="mt-4 h-full flex items-end">
							<a class="" href="<?= esc_url($link['url']) ?>" target="<?php echo esc_attr($link_target); ?>">
								<?= bb_icon('arrow-right', 'bg-white rounded p-1') ?>
							</a>
						</div>
					<?php endif; ?>

				</div>
			<?php endwhile; ?>

		</div>
	</div>
</div>
<script>
		SwipersConfig['#<?= $block['id'] ?>'] = {
				slidesPerView: 1,
				spaceBetween: 40,
				loop: true,
				grabCursor: true,
				draggable: true,
				pagination: {
						el: '#<?= $block['id'] ?> .swiper-pagination',
						type: 'fraction',
				},
				navigation: {
						nextEl: '#<?= $block['id'] ?> .swiper-button-next',
						prevEl: '#<?= $block['id'] ?> .swiper-button-prev',
				},
				breakpoints: {
						640: {
								slidesPerView: 2,
								spaceBetween: 20,
						},
						768: {
								slidesPerView: 2,
								spaceBetween: 30,
						},
						1024: {
								slidesPerView: 3,
								spaceBetween: 40,
						},
				},
				autoplay: {
						delay: 2500,
						disableOnInteraction: true,
				},
		};
</script>
<?php else: ?>
	<b><?= __('Custom Teasers Swiper', BB_TEXT_DOMAIN) ?></b>
	<div class="grid grid-cols-4 gap-4">
	<?php while (have_rows('slides')): ?>
		<?php the_row(); ?>
		<div class="p-4 rounded-3xl" style=" background-color: <?= get_sub_field('bg_color') ?>">
			<?= wp_get_attachment_image(get_sub_field('image'), [400, 0], false, ['class' => 'rounded-2xl aspect-video object-cover min-w-full']) ?>
			<p class="text-xs"><b><?= get_sub_field('headline') ?></b><br/><?= get_sub_field('description') ?></p>
		</div>
	<?php endwhile; ?>
	</div>
<?php endif; ?>
