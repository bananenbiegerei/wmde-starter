
<?php if (!is_admin()): ?>
<div class="bb-custom-teasers-swiper-block overflow-hidden" id="<?= $block['id'] ?>">
	<h2><?= esc_html(get_field('headline')) ?></h2>
	<div class="text-inherit"><?= get_field('description') ?></div>

	<div class="swiper-container">
		<div class="swiper-wrapper">

			<?php while (have_rows('slides')): ?>
				<?php the_row(); ?>
				<div class="swiper-slide bg-gray-100 rounded-3xl p-4 flex flex-col" style="height:unset"><!-- height unset to make all slides full height -->

					<div>
						<?= wp_get_attachment_image(get_sub_field('image'), [400, 0], false, ['class' => 'rounded-2xl aspect-video object-cover min-w-full']) ?>
					</div>

					<?php if ($headline = get_sub_field('headline')): ?>
						<div class="text-xl">
							<?= esc_html($headline) ?>
						</div>
					<?php endif; ?>

					<?php if ($description = get_sub_field('description')): ?>
						<div class="text-base">
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
						el: '.swiper-pagination',
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
		<div>
			<?= wp_get_attachment_image(get_sub_field('image'), [400, 0], false, ['class' => 'rounded-2xl aspect-video object-cover min-w-full']) ?>
			<p class="text-xs"><b><?= get_sub_field('headline') ?></b><br/><?= get_sub_field('description') ?></p>
		</div>
	<?php endwhile; ?>
	</div>
<?php endif; ?>
