<?php
// NOTE: included by `navbar.php`
?>
<div class="flex bg-white items-center py-1 lg:py-3 mx-4">
	<div class="flex-1">
		<a href="<?php echo get_home_url(); ?>" class="hidden lg:block">
			<img class="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/wikimedia-logo.svg" alt="Logo">
		</a>
		<a href="<?php echo get_home_url(); ?>" class="block lg:hidden">
			<img class="w-6 h-auto" src="<?php echo get_stylesheet_directory_uri(); ?>/img/wikimedia-logo-mini.svg" alt="Logo">
		</a>
	</div>
	<div class="flex-none">
		<ul class="menu menu-horizontal text-sm lg:text-base">
			<?php if (get_field('link_fur_spenden', 'option')): ?>
			<li>
				<a
					class="btn btn-red btn-hollow"
					target="_blank"
					href="<?php echo esc_url(get_field('link_fur_spenden', 'option')); ?>">
					<?php pll_e('donate'); ?>
				</a>
			</li>
			<?php endif; ?>
		</ul>
	</div>
	<div class="flex-none">
		<?php
//get_template_part('template-parts/search-modal');
?>
	</div>
	<div class="block lg:hidden flex-none x-data="{ show: false }"">
		<!-- Using the Alpine.store ($store) to save the state of the site header. -->
		<button class="btn btn-ghost btn-icon" x-on:click="$store.open_mobile_nav = ! $store.open_mobile_nav">
			M
		</button>
	</div>
</div>
<hr class="border-b-1 border-gray-200">
