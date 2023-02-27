<?php
// get image field (array)
$images = get_field('images'); ?>

<div class="bb-gallery-swiper-block" id="<?= $block['id'] ?>">
	<div class="container grid grid-cols-12">
		<div class="col-span-12 lg:col-span-8 lg:col-start-3">
			<div class="flex items-center">
				<div class="grow">
					<h2 class="text-5xl text-primary">
						<?= esc_html(get_field('headline')) ?>
					</h2>
				</div>
				<div class="flex-none space-x-2">
					<?= bb_icon('chevron-left', 'swiper-button-prev btn btn-icon-only btn-hollow cursor-pointer') ?>
					<div class="swiper-pagination inline-block text-3xl font-alt align-middle mx-2"></div>
					<?= bb_icon('chevron-right', 'swiper-button-next btn btn-icon-only btn-hollow cursor-pointer') ?>
				</div>
			</div>
		</div>
	</div>
		<div class="swiper-container relative">
			<div class="swiper-wrapper">
					<?php foreach ($images as $image): ?>
					<div class="swiper-slide" style="height:unset;">
						 <?php get_template_part('blocks/image/block', null, ['image' => $image]); ?>
					</div>
					<?php endforeach; ?>
			</div>
		</div>
</div>

<script>
		SwipersConfig['#<?php echo $block['id']; ?>'] = {
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
			// autoplay: {
			// 	delay: 2500,
			// 	disableOnInteraction: true,
			// },
		};
</script>
