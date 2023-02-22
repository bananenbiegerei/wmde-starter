<?php get_header(); ?>
<?php while (have_posts()):
	the_post(); ?>
	<?php if ( has_post_thumbnail() ) : ?>
	  <div class="bg-gray">
		  <div class="container-ten-cols pb-5">
			  <?php get_template_part("template-parts/breadcrumb"); ?>
			  <h1 class="text-5xl"><?php the_title(); ?></h1>
			  <?php if ( has_excerpt() ) : ?>
				<div class="font-alt text-xl font-normal">
				  <?php echo get_the_excerpt(); ?>
				</div>
			  <?php endif; ?>
		  </div>
	  </div>
	  <div class="relative">
		  <div class="absolute top-0 left-0 bg-gray rounded-b-3xl h-20 w-full">
			  
		  </div>
		  <div class="relative z-40 flex justify-center container-eight-cols">
				<div class="aspect-video">
					<?php the_post_thumbnail('large', array('class' => 'rounded-3xl w-full h-full oject-cover')); ?>
				</div>
			</div>
		</div>
	  <div class="container-eight-cols">
			  <div class="max-w-xl mx-auto">
				  <?php the_content(); ?>
			  </div>
	  </div>
	<?php else : ?>
	  <div class="bg-gray rounded-b-3xl pb-8">
		  <div class="container-eight-cols">
			  <?php get_template_part("template-parts/breadcrumb"); ?>
			  <h1 class="text-5xl"><?php the_title(); ?></h1>
			  <?php if ( has_excerpt() ) : ?>
				<div class="font-alt text-xl font-normal">
				  <?php echo get_the_excerpt(); ?>
				</div>
			  <?php endif; ?>
	  
		  </div>
	  </div>
	  <div class="container">
			  <div class="max-w-xl mx-auto">
				  <?php //the_content(); ?>
			  </div>
	  </div>
	<?php endif; ?>

	
<?php
endwhile; ?>
<?php get_footer(); ?>
