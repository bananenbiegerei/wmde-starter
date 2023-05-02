<?php
$header_bg = get_field('color_for_theme', get_the_ID()); ?>
<?php if (has_post_thumbnail()): ?>
  <div class="min-h-[12rem] rounded-b-3xl check-color-contrast" style="background-color:<?php echo $header_bg; ?>;">
	  <div class="container grid grid-cols-12 gap-10">
		  <div class="col-span-12 lg:col-span-3">
			  <div class="my-5 aspect-w-4 aspect-h-3 relative rounded-tl-3xl rounded-br-3xl overflow-hidden">
				  <figure class="w-full w-full">
					  <?php the_post_thumbnail('large', ['class' => 'object-cover w-full h-full']); ?>
					  <?php if (bbWikimediaCommonsMedia::has_post_thumbnail_caption()): ?>
						  <figcaption class="invisible flex absolute left-0 bottom-0 right-0 text-white bg-black w-auto h-auto z-20 p-2 text-sm flex items-start gap-4 break-all">
							  <?= bb_icon('info', 'flex-shrink-0') ?> <div class="self-center"><?php the_post_thumbnail_caption(); ?></div>
						  </figcaption>
					  <?php endif; ?>
				  </figure>
			  </div>
		  </div>
		  <div class="col-span-12 lg:col-span-9">
				<h1 class="uppercase font-bold font-alt text-sm adjust-color-contrast my-5"><?php the_title(); ?></h1>
				<?php if (has_excerpt()): ?>
				  <div class="font-alt text-2xl lg:text-3xl font-normal mb-10 adjust-color-contrast">
					<?php echo strip_tags(get_the_excerpt()); ?>
				  </div>
				<?php endif; ?>
		  </div>
	  </div>
  </div>
<?php else: ?>
  <div class="rounded-b-3xl min-h-[12rem] py-10"
  style="background-color:<?php echo $header_bg; ?>"
  >
	  <div class="container grid grid-cols-12">
		  <div class="col-span-12">
				<h1 class="topline"><?php the_title(); ?></h1>
				<?php if (has_excerpt()): ?>
				  <div class="font-alt text-xl lg:text-3xl font-normal mb-5">
					<?php echo strip_tags(get_the_excerpt()); ?>
				  </div>
				<?php endif; ?>
		  </div>

	  </div>
  </div>
<?php endif; ?>
<?php get_template_part('template-parts/anchor-nav'); ?>
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

