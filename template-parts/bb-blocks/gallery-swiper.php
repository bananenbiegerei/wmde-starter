<?php
// get image field (array)
$images = get_field('images'); ?>

<div class="bb-gallery-swiper-block px-10 pb-16 pt-16" id="<?= $block['id'] ?>">
	<h2 class="text-5xl"><?= esc_html(get_field('headline')) ?></h2>

		<div class="swiper-container relative">

			<div class="absolute -top-16 right-0 hidden lg:block">
					<?= bb_icon('swiper-left', 'swiper-button-prev h-14 w-14 hover:text-transparent cursor-pointer') ?>
					<div class="swiper-pagination inline-block text-3xl font-alt align-middle mx-2"></div>
					<?= bb_icon('swiper-right', 'swiper-button-next h-14 w-14 hover:text-transparent cursor-pointer') ?>
			</div>

			<div class="swiper-wrapper">
					<?php foreach ($images as $image): ?>
					<div class="swiper-slide" style="height:unset;">
						 <?php get_template_part('template-parts/bb-blocks/image', null, ['image' => $image]); ?>
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
			autoplay: {
				delay: 2500,
				disableOnInteraction: true,
			},
		};
</script>
