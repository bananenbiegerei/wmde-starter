<?php
$theme = get_field('theme');
$color = get_field('color_for_theme', $theme->ID);
$related = get_field('related');
$thumbnail_url = get_the_post_thumbnail_url($theme, 'medium');
$theme_url = get_the_permalink($theme);
?>

<div class="bb-theme-block mb-10 lg:mb-20">
	<div class="rounded-3xl px-10 grid grid-cols-12 " style="background-color: <?= $color ?>;">
		<!-- Image -->
			<div class="col-span-4">
				<div class="aspect-w-4 aspect-h-3 relative -translate-x-10 rounded-tl-3xl rounded-br-3xl overflow-hidden">
					<?php
					  echo '<img class="w-full h-full object-cover" src="' . $thumbnail_url . '" />';
					?>
				</div>
			</div>
			<div class="col-span-8 flex flex-col">
				<div class="pt-10">
					<!-- Theme or format -->
					<div class="topline">
						<?= __('Theme', BB_TEXT_DOMAIN) ?>
					</div>
					<!-- Title -->
					<h2 class="text-2xl lg:text-3xl text-bg-related"><?= esc_html($theme->post_title) ?></h2>
				</div>

				<!-- Text -->
				<p class="font-normal flex-grow pr-5 pb-5 text-2xl text-bg-related">
					<?= $theme->post_excerpt ?>
				</p>

				<!-- Button and extra info -->
				<div class="flex-1 flex items-end pb-10">
					<a href="<?php echo $theme_url; ?>" class="btn btn-hollow">
						<?= bb_icon('arrow-right',''); ?>
						<?= __('Zum Thema', BB_TEXT_DOMAIN) ?>						
					</a>
				</div>

			</div>
			
			<?php if ( get_field( 'internal_external_link' ) ): ?>
			
			<?php if ( have_rows( 'external_links' ) ) : ?>
				<div class="col-span-12">
				<div class="lg:grid lg:grid-cols-3">
				<?php while ( have_rows( 'external_links' ) ) : the_row(); ?>
					<?php $external_link = get_sub_field( 'external_link' ); ?>
					
					<?php if ( $external_link ) : ?>
						<div class="py-5">
						<a href="<?php echo esc_url( $external_link['url'] ); ?>" target="<?php echo esc_attr( $external_link['target'] ); ?>">
						<h3 class="text-base lg:text-xl text-bg-related">
							<?php echo esc_html( $external_link['title'] ); ?>
						</h3>
						</a>
						</div>
					<?php endif; ?>
					
				<?php endwhile; ?>
				</div>
				</div>
			<?php endif; ?>
			
			<?php else: ?>
			
			<!-- Related -->
			<?php if ($related): ?>
				<div class="col-span-12">
				<div class="lg:grid lg:grid-cols-3">
				<?php foreach ($related as $related): ?>
					<?php setup_postdata($related); ?>
					<div class="py-5">
						<?php if ($terms = get_the_terms($related->ID, 'theme')): ?>
						  <?php $term_names = []; ?>
						  <?php /* prettier-ignore */ foreach ($terms as $term) { $term_names[] = $term->name; } ?>
						  <div class="topline"><?php echo implode(', ', $term_names); ?></div>
						 <?php endif; ?>
						<a href="<?php the_permalink(); ?>">
							<h3 class="text-base lg:text-xl text-bg-related"><?php echo get_the_title($related->ID); ?></h3>
						</a>
					</div>
				<?php endforeach; ?>
				</div>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
			
			<?php endif; ?>

	</div>
</div>
<!-- <script>
  // Get all elements with the class "text-inherit"
  const elements = document.querySelectorAll('.text-bg-related');

  // Loop through all elements and adjust their text color
  elements.forEach(element => {
	// Get the background color of the element
	const bgColor = window.getComputedStyle(element.parentElement).getPropertyValue('background-color');

	// Convert the color to an RGB value
	const rgbColor = bgColor.match(/\d+/g);

	// Calculate the relative luminance of the color
	const relativeLuminance = (0.2126 * rgbColor[0] + 0.7152 * rgbColor[1] + 0.0722 * rgbColor[2]) / 255;

	// Set the text color based on the relative luminance
	if (relativeLuminance > 0.5) {
	  element.style.color = '#000'; // Set text color to black
	} else {
	  element.style.color = '#fff'; // Set text color to white
	}
  });
</script> -->

