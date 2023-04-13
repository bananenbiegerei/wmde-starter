<?php if ( is_singular('theme-releases') ): ?>

<?php 
$title_style = 'uppercase text-primary text-base'; 
$excerpt_style = 'font-alt text-2xl lg:text-3xl font-normal';
else: 
$title_style = 'text-5xl my-5'; 
$excerpt_style = 'font-alt text-2xl font-normal';
?>

<?php endif; ?>
<?php if (has_post_thumbnail()): ?>
  <div class="bg-gray min-h-[12rem]">
	  <div class="container grid grid-cols-12">
		  <div class="col-span-12 lg:col-span-10 lg:col-start-2">
			  <?php get_template_part('template-parts/breadcrumbs'); ?>
				<h1 class="<?php echo $title_style; ?> my-5"><?php the_title(); ?></h1>
				<?php if (has_excerpt()): ?>
				  <div class="<?php echo $excerpt_style; ?> mb-10">
					<?php echo strip_tags(get_the_excerpt()); ?>
				  </div>
				<?php endif; ?>
		  </div>
		<div class="col-span-12 lg:col-span-8 lg:col-start-3">
			<?php get_template_part('template-parts/featured-image'); ?>
		</div>
	  </div>
  </div>
<?php else: ?>
  <div class="bg-gray rounded-b-3xl min-h-[12rem] pb-10">
	  <div class="container grid grid-cols-12">
		  <div class="col-span-12 lg:col-span-8 lg:col-start-3">
			  <?php get_template_part('template-parts/breadcrumbs'); ?>
				<h1 class="<?php echo $title_style; ?>"><?php the_title(); ?></h1>
				<?php if (has_excerpt()): ?>
				  <div class="<?php echo $excerpt_style; ?>">
					<?php the_excerpt(); ?>
				  </div>
				<?php endif; ?>
		  </div>
	  </div>
  </div>
<?php endif; ?>
<?php // FIXME: @EL get_template_part('template-parts/anchor-nav'); ?>