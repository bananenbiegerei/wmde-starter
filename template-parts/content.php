<article id="post-<?php the_ID(); ?>" <?php post_class('space-bottom-huge'); ?>>
	<p><?php echo get_the_date(); ?></p>
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<h2><?php the_title(); ?></h2>
	</a>
	<?php the_excerpt(); ?>
</article>
