<div class="fullwidth">
	<div class="grid-x grid-margin-x">
		<div class="cell medium-12">
			<div class="cell medium-12">
				<h2><?= get_field('headline') ?></h2>
			</div>
		</div>
</div>
</div>
<section id="bb-organigramm-block" class="acf-block-organigramm padding-top-3 padding-bottom-3">
	<div class="organigramm-content">
		<div class="grid-container">
			<div class="grid-x grid-margin-x">
				<div class="cell medium-12">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<!-- Slide 0 -->
							<div class="swiper-slide start-slide">
								<?php get_template_part('/blocks/organigramm/parts/start-slide'); ?>
							</div>
							<!-- Slide 1 -->
							<div class="swiper-slide wikimedia-slide">
							<?php get_template_part('/blocks/organigramm/parts/wikimedia-slide'); ?>
							</div>
							<!-- Slide 2 -->
							<div class="swiper-slide wikimedia-foundation-slide">
								<?php get_template_part('/blocks/organigramm/parts/wikimedia-foundation-slide'); ?>
							</div>
							<!-- Slide 3 -->
							<div class="swiper-slide wikimedia-chapters-slide">
								<?php get_template_part('/blocks/organigramm/parts/wikimedia-chapters-slide'); ?>
							</div>
						</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	</section>

<script>
	//Organigramm Navigation
	var orgaSwiper;
	jQuery(document).ready(function($) {
		orgaSwiper = new Swiper('#acf-block-organigramm .swiper-container', {
			grabCursor: false,
			draggable: false,
			speed: 1400,
			effect: 'fade',
			fadeEffect: {
				crossFade: true,
			},
			simulateTouch: false,
			keyboard: {
				enabled: true,
			},
			autoHeight: true,
		});
		var blockOrga = $('.acf-block-organigramm');
		$('.orga-back').click(function () {
			orgaSwiper.slidePrev();
			blockOrga.removeClass('solid-background')
		});
		$('.wikimedia-bubbles-close').click(function () {
			orgaSwiper.slideTo(0, 1000);
			blockOrga.removeClass('solid-background')
		});
		$('.start-slide .wikimedia-bubble').click(function () {
			orgaSwiper.slideTo(1, 1000);
			blockOrga.addClass('solid-background')
		});
		$('.wikimedia-chapters-slide .wikimedia-bubble').click(function () {
			orgaSwiper.slideTo(1, 1000);
			blockOrga.addClass('solid-background')
		});
		$('.wikimedia-foundation-slide .wikimedia-bubble').click(function () {
			orgaSwiper.slideTo(1, 1000);
			blockOrga.addClass('solid-background')
		});
		$('.foundation-bubble').click(function () {
			orgaSwiper.slideTo(2, 1000);
			blockOrga.removeClass('solid-background')
		});
		$('.chapters-bubble').click(function () {
			orgaSwiper.slideTo(3, 1000);
			blockOrga.removeClass('solid-background')
		});
	});
</script>
