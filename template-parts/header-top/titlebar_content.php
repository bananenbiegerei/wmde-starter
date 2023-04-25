<div class="flex-1">
	<a href="<?php echo get_home_url(); ?>" class="hidden lg:block">
		<img class="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/wikimedia-logo.svg" alt="Logo">
	</a>
	<a href="<?php echo get_home_url(); ?>" class="block lg:hidden">
		<img class="w-6 h-auto" src="<?php echo get_stylesheet_directory_uri(); ?>/img/wikimedia-logo-mini.svg" alt="Logo">
	</a>
</div>

<div>
	<ul class="flex items-center space-x-2 lg:space-x-5 mb-0">
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
		<li class="hidden lg:block">
			<a
				class="btn btn-ghost btn-sm"
				href="<?php echo esc_url(get_field('link_fur_mitmachen', 'option')); ?>">
				<?php _e('Mitmachen'); ?>
			</a>
		</li>
		<?php endif; ?>
	</ul>
</div>
