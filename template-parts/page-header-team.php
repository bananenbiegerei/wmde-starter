
<div class="pb-10 bg-gray rounded-b-3xl">
	  <div class="container grid grid-cols-12">
		  <div class="col-span-12 pt-5">
			  <?php get_template_part('template-parts/breadcrumbs'); ?>
				<h1><?php the_title(); ?></h1>
				<?php if (has_excerpt()): ?>
				  <div class="font-alt text-2xl font-normal mb-5">
					<?php the_excerpt(); ?>
				  </div>
				<?php endif; ?>
		  </div>
	  </div>
  </div>