<div class="rounded-b-3xl min-h-[12rem] py-10 bg-neutral">
	  <div class="container grid grid-cols-12">
		  <div class="col-span-12">
			  	<p class="text-sm"><?php echo get_the_date('d.m.Y'); ?></p>
				<h1><?php the_title(); ?></h1>
				<?php if (has_excerpt()): ?>
				  <div class="font-alt text-xl lg:text-3xl font-normal mb-5">
					<?php echo strip_tags(get_the_excerpt()); ?>
				  </div>
				<?php endif; ?>
		  </div>
	  </div>
  </div>
<?php get_template_part('template-parts/anchor-nav'); ?>
