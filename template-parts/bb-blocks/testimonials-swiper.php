<?php if (!is_admin()): ?>
	<div class="bb-testimonials-swiper-block" id="<?= $block['id'] ?>">
		<div class="swiper-container overflow-hidden">
			<div class="swiper-wrapper">
				<?php foreach (get_field('testimonials') as $testimonial): ?>
					<div class="swiper-slide">
							<blockquote class="text-2xl flex gap-4">
								<div class="flex-shrink-0"><?= bb_icon('chat', 'bg-red-100 rounded-full p-3 w-14 h-14 grid place-items-center') ?></div>
								<div><?= $testimonial->post_title ?></div>
								<!--cite>Spendenkommentar <?php echo get_the_date('Y', $testimonial->ID); ?></cite-->
							</blockquote>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<script>
		SwipersConfig['#<?php echo $block['id']; ?>'] = {
			loop: true,
			centeredSlides: false,
			spaceBetween: 30,
			speed: 1400,
			autoplay: {
				delay: 4000,
				disableOnInteraction: true,
			},
			grabCursor: true,
			draggable: true,
			slidesPerView: 3,
			spaceBetween: 40,
			// init: false,
			breakpoints: {
				640: {
					slidesPerView: 1,
					spaceBetween: 40,
				},
				768: {
					slidesPerView: 2,
					spaceBetween: 40,
				},
				1024: {
					slidesPerView: 3,
					spaceBetween: 40,
				},
			},
		};
	</script>
<?php else: ?>
	<div class="">
		<blockquote class="text-sm flex">
			<div class="flex-shrink-0"><?= bb_icon('chat', 'bg-red-100 rounded-full p-3 w-14 h-14 grid place-items-center') ?></div>
			<ul>
				<?php foreach (get_field('testimonials') as $testimonial): ?>
					<li><?= $testimonial->post_title ?></li>
				<?php endforeach; ?>
			</ul>
		</blockquote>
	</div>
<?php endif; ?>
