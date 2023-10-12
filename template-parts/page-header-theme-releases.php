<?php
$header_bg = get_field('color_for_theme', get_the_ID());
$color_contrast = get_field('has_dark_background_color', get_the_ID());
$secondary_color = get_field('secondary_color', get_the_ID()); 
?>
<?php if (has_post_thumbnail()): ?>
  <div class="min-h-[12rem] rounded-b-3xl check-color-contrast" style="background-color:<?php echo $header_bg; ?>;">
	  <div class="container md:grid grid-cols-12 gap-10
	  <?php if( $color_contrast ):
		  echo 'white-scheme';
	  endif;?>
	  ">
		  <div class="md:col-span-6 lg:col-span-3">
			  <div class="my-5 aspect-w-4 aspect-h-3 relative rounded-tl-3xl rounded-br-3xl overflow-hidden -translate-x-6 -mr-12 md:-translate-y-6">
				  <figure class="w-full h-full">
					  <?php the_post_thumbnail('large', ['class' => 'object-cover w-full h-full']); ?>
					  <?php if (bbWikimediaCommonsMedia::has_post_thumbnail_caption()): ?>
						  <figcaption class="invisible flex absolute left-0 bottom-0 right-0 text-white bg-gray-900 w-auto h-auto z-20 p-2 text-sm flex items-start gap-4 break-all">
							  <?= bb_icon('info', 'flex-shrink-0') ?> <div class="self-center"><?php the_post_thumbnail_caption(); ?></div>
						  </figcaption>
					  <?php endif; ?>
				  </figure>
			  </div>
		  </div>
		  <div class="md:col-span-6 lg:col-span-9">
			  	<?php if ( $secondary_color): ?>
				  
				  <h1 class="uppercase font-bold font-alt text-sm my-5"
				  style="color:<?php echo $secondary_color ?>;"
				  ><?php the_title(); ?></h1>
				  
				  <?php else: ?>
				  
				  <h1 class="uppercase font-bold font-alt text-sm my-5 text-primary"><?php the_title(); ?></h1>
				  
				  <?php endif; ?>
				
				<?php if (has_excerpt()): ?>
				  <div class="font-alt text-lg lg:text-3xl font-normal mb-10 text-black pb-6">
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

