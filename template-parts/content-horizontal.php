<a class="col-span-2 grid grid-cols-2 gap-10 items-center" href="<?php the_permalink(); ?>">
<?php
if ( has_post_thumbnail() ) { ?>
	<div>
		<div class="aspect-w-16 aspect-h-9">
			<?php the_post_thumbnail('medium', array('class' => 'object-cover h-full w-full rounded-xl')); ?>
		</div>
	</div>
<?php } ?>
<div>
	<h2><?php the_title(); ?></h2>
	<div class="mb-2">
		<?php the_excerpt(); ?>
	</div>
</div>
</a>