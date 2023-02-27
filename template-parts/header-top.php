<?php
// NOTE: included by `navbar.php`
?>
<div class="flex bg-white container items-center py-1 lg:py-3 mx-4">
	<div class="flex-1">
		<a href="<?php echo get_home_url(); ?>" class="hidden lg:block">
			<img class="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/wikimedia-logo.svg" alt="Logo">
		</a>
		<a href="<?php echo get_home_url(); ?>" class="block lg:hidden">
			<img class="w-6 h-auto" src="<?php echo get_stylesheet_directory_uri(); ?>/img/wikimedia-logo-mini.svg" alt="Logo">
		</a>
	</div>
	<div class="">
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
	<div class="block lg:hidden flex-none x-data="{ show: false }"">
		<!-- Using the Alpine.store ($store) to save the state of the site header. -->
		<button class="btn btn-ghost btn-icon" x-on:click="$store.open_mobile_nav = ! $store.open_mobile_nav">
			<?=bb_icon('menu-alt-2')?>
		</button>
	</div>
</div>
<hr class="border-b-1 border-gray-200">