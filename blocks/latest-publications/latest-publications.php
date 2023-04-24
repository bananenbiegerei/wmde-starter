<?php
$count = get_field('count');
$publications = get_posts(['post_type' => 'publications', 'numberposts' => $count]);
?>
<div class="bb-latest-publications-block mb-20">
	<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-8">
		<?php foreach ($publications as $p): ?>
			<div class="flex flex-col">
				<div class="rounded-3xl basis-2/3">
					<?php if ($post_thumbnail = get_the_post_thumbnail($p->ID, 'medium', ['class' => 'h-3/4 w-auto drop-shadow-xl'])): ?>
						<div class="aspect-w-1 aspect-h-1 overflow-hidden">
							<div class="flex flex-col items-center justify-center">
								<?= $post_thumbnail ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<div class="text-center">
					<h2 class="topline"><?php echo $p->post_title; ?></h2>
					<div>
						<a href="<?= get_field('pdf', $p->ID) ?>" class="btn btn-xs btn-hollow btn-icon-left">
							<?= bb_icon('arrow-down', 'icon-xs') ?> <?php _e('Download', BB_TEXT_DOMAIN); ?>
						</a>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
