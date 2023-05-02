<?php
$theme = get_field('theme');
$color = get_field('color_for_theme', $theme->ID);
$related = get_field('related_links');
$thumbnail_url = get_the_post_thumbnail_url($theme, 'medium');
$theme_url = get_the_permalink($theme);
?>
<div class="bb-theme-block mb-10 lg:mb-20">
	<div class="rounded-3xl lg:px-10 lg:grid lg:grid-cols-12 overflow-hidden check-color-contrast"
	style="background-color: <?= $color ?>;">
		<!-- Image -->
			<div class="lg:col-span-4">
				<div class="aspect-w-4 aspect-h-3 relative lg:-translate-x-10 rounded-tl-3xl rounded-br-3xl overflow-hidden">
					<?php
					  echo '<img class="w-full h-full object-cover" src="' . $thumbnail_url . '" />';
					?>
				</div>
			</div>
			<div class="lg:col-span-8 flex flex-col p-5 lg:p-0">
				<div class="pt-8">
					<!-- Theme or format -->
					<div class="uppercase font-bold font-alt text-sm adjust-color-contrast">
						<?= __('Theme', BB_TEXT_DOMAIN) ?>
						
					</div>
					<!-- Title -->
					<h2 class="text-2xl lg:text-3xl adjust-color-contrast"><?= esc_html($theme->post_title) ?></h2>
				</div>

				<!-- Text -->
				<p class="font-normal flex-grow pr-5 pb-5 text-xl text-bg-related adjust-color-contrast">
					<?= $theme->post_excerpt ?>
				</p>

				<!-- Button and extra info -->
				<div class="flex-1 flex items-end lg:pb-8">
					<a href="<?php echo $theme_url; ?>" class="btn btn-hollow">
						<?= bb_icon('arrow-right',''); ?>
						<?= __('Zum Thema', BB_TEXT_DOMAIN) ?>						
					</a>
				</div>

			</div>
	
			<!-- Related -->
			<?php if ( have_rows( 'related_links' ) ) : ?>
				<div class="col-span-12 my-10">
				<div class="lg:grid lg:grid-cols-3 px-5 lg:px-0 gap-10">
				<?php while ( have_rows( 'related_links' ) ) : the_row(); ?>
					<?php $link = get_sub_field( 'link' ); ?>
					<?php if ( $link ) : ?>
						<a class="hover:underline transion" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>">
						<?php if( get_sub_field('alt_meta_info') ): ?>
							<p class="uppercase font-bold font-alt text-sm adjust-color-contrast">
								<?php the_sub_field('alt_meta_info'); ?>
							</p>
						<?php endif; ?>
						<h3 class="text-base lg:text-xl adjust-color-contrast">
						<?php echo esc_html( $link['title'] ); ?>
						</h3>
						</a>
					<?php endif; ?>
				<?php endwhile; ?>
				</div>
				</div>
			<?php endif; ?>

	</div>
</div>
<script>
  // Get all the check-color-contrast elements
  const checkColorContrasts = document.getElementsByClassName("check-color-contrast");

  // Loop through each check-color-contrast element and set the text color of all adjust-color-contrast elements based on its background color
  for (let i = 0; i < checkColorContrasts.length; i++) {
	const checkColorContrast = checkColorContrasts[i];

	// Get the background color of the check-color-contrast element
	const backgroundColor = window.getComputedStyle(checkColorContrast).backgroundColor;

	// Get all adjust-color-contrast elements of the current check-color-contrast element
	const adjustColorContrasts = checkColorContrast.getElementsByClassName("adjust-color-contrast");

	// Set the text color of all adjust-color-contrast elements based on the background color of the check-color-contrast
	for (let j = 0; j < adjustColorContrasts.length; j++) {
	  const adjustColorContrast = adjustColorContrasts[j];
	  adjustColorContrast.style.color = getTextColor(backgroundColor);
	}
  }

  // Function to determine the text color based on the background color
  function getTextColor(backgroundColor) {
	// Convert the background color to an RGB value
	const rgb = backgroundColor.match(/\d+/g);
	const brightness = (parseInt(rgb[0]) * 299 + parseInt(rgb[1]) * 587 + parseInt(rgb[2]) * 114) / 1000;
	return brightness > 128 ? "black" : "white"; // Return black or white depending on the brightness of the background color
  }
</script>
