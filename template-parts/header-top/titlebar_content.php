<?php $home_url = is_home() ? 'https://www.wikimedia.de/' : get_home_url(); ?>


<header class="flex w-full items-center">
	<div class="flex-1">
		<a href="<?= $home_url ?>" class="hidden md:block" aria-labelledby="site-name">
			<img class="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/wikimedia-logo.svg" alt="Wikimedia Logo">
		</a>
		<a href="<?= $home_url ?>" class="block md:hidden" aria-labelledby="site-name">
			<img class="w-6 h-auto" src="<?php echo get_stylesheet_directory_uri(); ?>/img/wikimedia-logo-mini.svg" alt="Wikimedia Logo">
		</a>
	</div>

	<div class="flex gap-5">
		<ul class="flex items-center space-x-2 md:space-x-5 mb-0">
			<?php if (get_field('link_fur_spenden', 'option')): ?>
			<li>
				<a
					class="btn btn-red btn-hollow btn-sm btn-icon-left"
					href="<?php echo esc_url(get_field('link_fur_spenden', 'option')); ?>">
					<?= bb_icon('heart', 'heartbeat icon-sm') ?>
					<?php _e('donate'); ?>
				</a>
			</li>
			<?php endif; ?>
			<?php if (get_field('link_fur_mitmachen', 'option')): ?>
			<li class="hidden md:block">
				<a
					class="btn btn-ghost btn-sm"
					href="<?php echo esc_url(get_field('link_fur_mitmachen', 'option')); ?>">
					<?php _e('Mitmachen'); ?>
				</a>
			</li>
			<?php endif; ?>
		</ul>
	</div>

</header>
