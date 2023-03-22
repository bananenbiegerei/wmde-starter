<?php
$blog_id = get_current_blog_id();
$count = get_field('show_all') ? -1 : get_field('count');
$posts = get_posts(['post_type' => 'press-releases', 'numberposts' => $count]);
?>

<div class="bb-latest-press-releases-block">
	<div class="container grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-8">
			<?php foreach ($posts as $p): ?>
				<?php get_template_part('blocks/card/card', null, ['blog_id' => $blog_id, 'post_id' => $p->ID, 'layout' => 'vne']); ?>
		<?php endforeach; ?>
	</div>
</div>
