<?php

if (!is_multisite()) {
	echo 'This block only works on a multisite instance.';
	return;
}

// Try to find the Wikimove site
$wikimove_site = get_site_by_path(parse_url(get_site_url(), PHP_URL_HOST), 'wikimove-site');

if (!$wikimove_site) {
	echo 'Could not find Wikimove site...';
	return;
}

switch_to_blog($wikimove_site->blog_id);
$podcasts = get_posts(['post_type' => 'podcast', 'numberposts' => 4]);
?>
<div class="bb-latest-wikimove-podcasts-block">
	<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-8">
		<?php foreach ($podcasts as $p): ?>
			<a href="<?= get_the_permalink($p->ID) ?>">
				<div class="flex flex-col rounded-3xl mb-10 lg:mb-5 hover:shadow-xl transition scale-100 hover:scale-cards -mx-2 p-2 bg-white z-10 hover:z-20">
					<div class="rounded-3xl basis-2/3 mb-4">
						<?php if ($post_thumbnail = get_the_post_thumbnail($p->ID, 'medium', ['class' => 'w-full h-auto rounded-xl w-auto drop-shadow-xl'])): ?>
							<div class="aspect-w-1 aspect-h-1 overflow-hidden">
								<div class="flex flex-col items-center justify-center">
									<?= $post_thumbnail ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<div class="text-left">
						<h2 class="uppercase text-primary font-bold text-xs font-alt"><?= $p->post_title ?></h2>
						<div class="font-alt text-xs">
							<?= get_the_excerpt($p->ID) ?>
						</div>
					</div>
				</div>
			</a>
		<?php endforeach; ?>
	</div>
</div>
<?php restore_current_blog(); ?>
