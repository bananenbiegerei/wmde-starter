<div class="flex-1">
	<a href="<?php echo get_home_url(); ?>" class="hidden lg:block">
		<img class="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/wikimedia-logo.svg" alt="Logo">
	</a>
	<a href="<?php echo get_home_url(); ?>" class="block lg:hidden">
		<img class="w-6 h-auto" src="<?php echo get_stylesheet_directory_uri(); ?>/img/wikimedia-logo-mini.svg" alt="Logo">
	</a>
</div>

<div>
	<ul class="flex items-baseline space-x-5">
		<?php if (get_field('link_fur_spenden', 'option')): ?>
		<li>
			<a
				class="btn btn-base btn-red btn-hollow btn-icon-left"
				target="_blank"
				href="<?php echo esc_url(get_field('link_fur_spenden', 'option')); ?>">
				<?= bb_icon('heart') ?>
				<?php pll_e('donate'); ?>
			</a>
		</li>
		<?php endif; ?>
		<?php if (get_field('link_fur_mitmachen', 'option')): ?>
		<li>
			<a
				class="btn btn-ghost"
				target="_blank"
				href="<?php echo esc_url(get_field('link_fur_mitmachen', 'option')); ?>">
				<?php pll_e('Mitmachen'); ?>
			</a>
		</li>
		<?php endif; ?>
	</ul>
</div>
