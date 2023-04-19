<a href="<?php the_permalink(); ?>">
	<?php
	if ( has_post_thumbnail() ) { ?>
		<div class="aspect-w-16 aspect-h-9 mb-4">
			<?php the_post_thumbnail('medium', array('class' => 'object-cover h-full w-full rounded-xl')); ?>
		</div>
	<?php }
	else {
	}
	?>
	<h2 class="text-xl"><?php the_title(); ?></h2>
</a>