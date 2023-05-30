<?php
$count = get_field('count');
$publications = get_posts(['post_type' => 'publications', 'numberposts' => $count]);
?>
<div class="bb-latest-publications-block mb-10 lg:mb-20">
	<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-10 justify-center">
		<?php foreach ($publications as $p): ?>
			<div class="">
				<div class="rounded-3xl py-10">
					<?php if ($post_thumbnail = get_the_post_thumbnail($p->ID, 'medium', ['class' => 'h-40 w-auto drop-shadow-xl'])): ?>
							<div class="flex flex-col items-center justify-center">
								<?= $post_thumbnail ?>
							</div>
					<?php endif; ?>
				</div>
				<div class="text-center">
					<h2 class="topline"><?php echo $p->post_title; ?></h2>
					<?php if( get_field('pdf', $p->ID) ): ?>
						<div>
							<a href="<?= get_field('pdf', $p->ID) ?>" class="btn btn-xs btn-hollow btn-icon-left">
								<?= bb_icon('arrow-down', 'icon-xs') ?> <?php _e('Download', BB_TEXT_DOMAIN); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
