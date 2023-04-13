<?php
$blog_id = get_current_blog_id();
$count = get_field('show_all') ? -1 : get_field('count');
$posts = get_posts(['post_type' => 'press-releases', 'numberposts' => $count]);
?>

<div class="bb-latest-press-releases-block mb-20">
	<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5 mb-5">
			<?php foreach ($posts as $p): ?>
				<?php include( locate_template( 'template-parts/card-press-release.php', false, false ) ); ?>
			<?php endforeach; ?>
	</div>
	<?php if ( get_field( 'show_all' ) ): ?>	
	<?php else: ?>
		<a class="btn btn-base" href="<?php echo get_page_link('pressemittelungen'); ?>">
			<?= _e('Alle Pressemitteilungen', BB_TEXT_DOMAIN) ?>
		</a>
	<?php endif; ?>
</div>
