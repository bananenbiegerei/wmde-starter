<div class="flex bg-white h-12 items-center py-1 px-2 z-10 sticky top-0 border-b border-gray-200 block lg:hidden">

	<?php get_template_part('template-parts/header-top/title_content'); ?>

	<div class="block flex-none" x-data="{ show: false }">
		<!-- Using the Alpine.store ($store) to save the state of the site header. -->
		<button class="btn btn-ghost btn-icon" x-on:click="$store.open_mobile_nav = ! $store.open_mobile_nav">
			<?= bb_icon('menu-alt-2') ?>
		</button>
	</div>

</div>
