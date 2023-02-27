<?php $meta = get_field('meta')['theme'] ? get_field('meta')['theme'] : get_field('meta')['format']; ?>

<div id="<?= $block['id'] ?>" class="container bb-cta-block">
	<div class="rounded-3xl p-10 grid grid-cols-12" style="background-color: <?= get_field('style')['bg_color'] ?>;">
		<!-- Image -->
		<?php if (get_field('style')['image']): ?>
			<div class="col-span-4">
				<div class="aspect-w-4 aspect-h-3 relative -translate-x-10 -translate-y-10 rounded-tl-3xl rounded-br-3xl overflow-hidden">
					<?php echo wp_get_attachment_image(get_field('style')['image'], 'medium', false, ['class' => 'w-full h-full object-cover']); ?>
				</div>
			</div>
			<div class="col-span-8 flex flex-col">
				<div>
					<!-- Theme or format -->
					<?php if ($meta): ?>
					<div class="uppercase text-primary font-bold text-base font-alt">
						<?= esc_html($meta->name) ?>
					</div>
					<?php endif; ?>
	
					<!-- Title -->
					<?php if (get_field('content')['title']): ?>
						<h2 class="text-2xl lg:text-3xl"><?= get_field('content')['title'] ?></h2>
					<?php endif; ?>
				</div>
	
				<!-- Text -->
				<?php if (get_field('content')['text']): ?>
					<div class="text-xl font-normal flex-grow pr-5 pb-5">
						<?= get_field('content')['text'] ?>
					</div>
				<?php endif; ?>
	
				<!-- Button and extra info -->
				<div class="flex-1 flex items-end pb-10">
					<?php if ($link = get_field('cta_button_link')): ?>
						<a class="btn btn-icon-left <?= get_field('cta_button_display')['style'] ?> <?= get_field('cta_button_display')['size'] ?>" href="<?= esc_url($link['url']) ?>" target="<?= $link['target'] ?>">
						<?= bb_icon($icon) ?>
						<?= esc_html($link['title']) ?>
						</a>
					<?php endif; ?>
				</div>
	
			</div>
	
			<div class="col-span-12">
				<!-- Related -->
				<?php $related = get_field('related'); ?>
				<?php if ($related): ?>
					<div class="lg:grid lg:grid-cols-3">
					<?php foreach ($related as $related): ?>
						<?php setup_postdata($related); ?>
						<div class="pr-10">
							<?php if ($terms = get_the_terms($related->ID, 'theme')): ?>
						  <?php $term_names = []; ?>
						  <?php /* prettier-ignore */ foreach ($terms as $term) { $term_names[] = $term->name; } ?>
						  <div class="uppercase text-primary font-bold text-base font-alt"><?php echo implode(', ', $term_names); ?></div>
				  <?php endif; ?>
						<a href="<?php the_permalink(); ?>">
							<h3 class="text-base lg:text-xl"><?php echo get_the_title($related->ID); ?></h3>
						</a>
						</div>
					<?php endforeach; ?>
					</div>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</div>

