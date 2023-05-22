<?php
$theme = get_field('theme');

if (!$theme) {
	echo '<p>Missing Theme</p>';
	return;
}

$color = get_field('color_for_theme', $theme->ID);
$secondary_color = get_field('secondary_color', $theme->ID);
$color_contrast = get_field('has_dark_background_color', $theme->ID);
$related = get_field('related_links');
$thumbnail_id = get_post_thumbnail_id($theme);
$thumbnail_url = get_the_post_thumbnail_url($theme, 'medium');
$thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
$theme_url = get_the_permalink($theme);
?>

<div class="bb-theme-block mb-10 lg:mb-20">
	<div class="rounded-3xl lg:px-10 lg:grid lg:grid-cols-12 overflow-hidden <?= $color_contrast ? 'white-scheme' : '' ?>" style="background-color: <?= $color ?>;">
		<!-- Image -->
			<div class="lg:col-span-4">
				<div class="aspect-w-4 aspect-h-3 relative lg:-translate-x-10 rounded-tl-3xl rounded-br-3xl overflow-hidden">
					<a href="<?= $theme_url ?>">
					<img class="w-full h-full object-cover" src="<?= $thumbnail_url ?>" alt="<?= $thumbnail_alt ?>">
					</a>
				</div>
			</div>
			<div class="lg:col-span-8 flex flex-col p-5 lg:p-0">
				<div class="pt-8">
					<!-- Theme or format -->
					<?php if ($secondary_color): ?>
					<div class="topline">
						<span style="color:<?= $secondary_color ?>;">
							<?= __('Theme', BB_TEXT_DOMAIN) ?>
						</span>
					</div>
					<?php else: ?>
					<div class="topline">
						<?= __('Theme', BB_TEXT_DOMAIN) ?>
					</div>
					<?php endif; ?>
					<!-- Title -->
					<a href="<?php echo $theme_url; ?>">
					<h2 class="text-2xl lg:text-3xl text-black"><?= esc_html($theme->post_title) ?></h2>
					</a>
				</div>

				<!-- Text -->
				<p class="font-normal flex-grow pr-5 pb-5 text-xl text-bg-related text-black">
					<?= $theme->post_excerpt ?>
				</p>

				<!-- Button and extra info -->
				<div class="flex-1 flex items-end lg:pb-8 default-scheme">
					<a href="<?= $theme_url ?>" class="btn btn-hollow btn-icon-left">
						<?= bb_icon('arrow-right', '') ?>
						<?= __('Zum Thema', BB_TEXT_DOMAIN) ?>
					</a>
				</div>

			</div>

			<!-- Related -->
			<?php $secondary_color = get_field('secondary_color', $theme->ID); ?>
			<?php if (have_rows('related_links')): ?>
				<div class="col-span-12 my-10">
				<div class="lg:grid lg:grid-cols-3 px-5 lg:px-0 gap-10">

				<?php while (have_rows('related_links')): ?>
    			<?php the_row(); ?>

					<?php if ($link = get_sub_field('link')): ?>

						<?php if ($secondary_color): ?>
							<a href="<?= esc_url($link['url']) ?>" target="<?= esc_attr($link['target']) ?>">
								<?php if (get_sub_field('alt_meta_info')): ?>
									<p class="topline mb-0" style="color:<?= $secondary_color ?>;"><?php the_sub_field('alt_meta_info'); ?></p>
									<h3 class="text-base lg:text-xl text-black hover:underline transition underline-offset-2 decoration-1 decoration-black transition">
										<?= esc_html($link['title']) ?>
									</h3>
								<?php else: ?>
									<h3 class="text-base lg:text-xl text-black mt-5 hover:underline transition underline-offset-2 decoration-1 decoration-black transition"><?= esc_html($link['title']) ?></h3>
								<?php endif; ?>
							</a>

						<?php else: ?>
							<a href="<?= esc_url($link['url']) ?>" target="<?= esc_attr($link['target']) ?>">
								<?php if (get_sub_field('alt_meta_info')): ?>
									<p class="topline mb-0"><?php the_sub_field('alt_meta_info'); ?></p>
									<h3 class="text-base lg:text-xl text-black hover:underline transition underline-offset-2 decoration-1 decoration-black transition">
										<?= esc_html($link['title']) ?>
									</h3>
								<?php else: ?>
									<h3 class="text-base lg:text-xl text-black mt-5 hover:underline transition underline-offset-2 decoration-1 decoration-black transition">
										<?= esc_html($link['title']) ?>
									</h3>
								<?php endif; ?>
							</a>
						<?php endif; ?>

					<?php endif; ?>
				<?php endwhile; ?>
				</div>
				</div>
			<?php endif; ?>
	</div>
</div>
