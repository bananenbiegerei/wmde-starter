<script>
	// Get current page ID (used to set 'current' class to menu item)
	const pageID = <?php echo get_the_ID(); ?>;
	// Get content of top-nav menu
	var WPNav = JSON.parse('<?php echo json_encode(bb_topnav_menu()); ?>');

	// Breakpoint for large, hardcoded for now... (need to get this from the TW config)
	const lgWidth = 1024;

	// Default icon when featured page thumbnail is missing
	const defaultIcon = "<?php echo get_stylesheet_directory_uri(); ?>/dist/img/placeholders/wiki-logo-icon.png";

	// Store site header status in Alpine.store
	document.addEventListener('alpine:init', () => {
		Alpine.store('open_mobile_nav', window.innerWidth >= lgWidth ? true : false);
	});

	// Prepare x-data for 'navMenu' component
	document.addEventListener('alpine:init', () => {
		Alpine.data('navMenu', () => ({
			nav: WPNav,
			isOpen: new Array(WPNav.length).fill(false),
			timeOutFunctionId: 0,
			init() {
				// Set site header to visible each time we resize to bigger than lgWidth
				// This bit is to do this only after we stop resizing and not during the whole resizing...
				window.onresize = function() {
					clearTimeout(this.timeOutFunctionId);
					this.timeOutFunctionId = setTimeout(function() {
						if (window.innerWidth >= lgWidth) {
						Alpine.store('open_mobile_nav', true);
						} else {
							Alpine.store('open_mobile_nav', false);
						}
					}, 100);
				};
			},
			toggleNav(n) {
				var v = this.isOpen[n];
				this.isOpen.fill(false);
				this.isOpen[n] = !v;
			},
			openNav(n) {
				var v = this.isOpen[n];
				this.isOpen.fill(false);
				this.isOpen[n] = true;
			},
			closeNav() { this.isOpen.fill(false); }
		}));
	});
</script>

<!-- Top container for site header and nav menu -->
<div x-data="navMenu" >

	<!-- Site header -->
	<?php get_template_part('template-parts/header-top'); ?>

	<!-- Container for the whole nav menu -->
	<div
		class="navbar border-b border-gray sticky top-0 z-40 bg-white block"
		transition x-show="$store.open_mobile_nav"
		@mouseleave="closeNav()"
		@click.outside="closeNav()">

		<div class="relative z-0">

			<!-- Domains top bar -->
			<div class="relative z-10 bg-white lg:px-2">
				<div class="lg:flex lg:space-x-1 lg:py-2 lg:py-3">

					<!-- For each domain... -->
					<template x-for="(domain,i) in nav">
						<div
							x-bind:class="{
							'border-l-4 border-l-transparent lg:border-0': !isOpen[i],
							'border-l-4 border-l-primary lg:border-0': isOpen[i] }">

							<!-- Domain name -->
							<button
								type="button"
								class="group inline-flex items-center rounded-md bg-white text-sm lg:text-base px-2 py-2 lg:px-3 lg:py-2 font-bold hover:text-gray-900 lg:w-auto w-full justify-between space-x-2 my-1 lg:my-0"
								aria-expanded="false"
								@mouseenter="openNav(i)"
								@click="toggleNav(i)">
								<span x-text="domain.title"></span>
								<span class="block lg:hidden font-icon text-4xl leading-none transition rotate-0" x-bind:class="{ '': !isOpen[i], 'transition rotate-45': isOpen[i] }">p</span>
								<span class="hidden lg:block font-icon text-4xl leading-none transition -rotate-90" x-bind:class="{ 'transition -rotate-90': !isOpen[i], 'transition rotate-0': isOpen[i] }">c</span>
							</button>

							<!-- For mobile: add the items right underneath the domain -->
							<div class="lg:hidden" x-show="isOpen[i]">

								<!-- Featured pages (mobile) -->
								<ul>
									<template x-for="page in domain.featured">
										<li class="" x-bind:class="{'current': pageID == page.ID }">
											<a
												x-bind:href="page.url"
												class="flex items-center rounded-md px-3 py-2  transition duration-150 ease-in-out hover:bg-gray-200">
												<div class="w-full h-full w-4 h-4 mr-2 flex justify-center items-center">
													<img class="h-auto w-10" x-bind:src="page.thumbnail || defaultIcon"/>
												</div>
												<span class="w-full" x-text="page.title"></span>
											</a>
										</li>
									</template>
								</ul>

								<!-- Other pages (mobile)-->
								<ul>
									<template x-for="page in domain.pages">
										<li class="pl-6" x-bind:class="{'current': pageID == page.ID }">
											<a
												x-bind:href="page.url"
												class="flex items-center rounded-md px-3 py-2  transition duration-150 ease-in-out hover:bg-gray-200">
												<span class="w-full" x-text="page.title"></span>
											</a>
										</li>
									</template>
								</ul>

							</div>
							<!-- End Mobile -->
							<hr class="border-b-1 border-gray-200 lg:border-0">
						</div>
					</template>
					<!-- End for each domain -->
			</div>
			<!-- End domains top bar -->

			<!-- For desktop: domain submenus go below the navigation bar -->
			<div  class="hidden lg:block">

				<!-- For each domain... -->
				<template x-for="(domain,i) in nav">
					<div class="absolute inset-x-0 z-10 transform shadow-lg bg-white max-h-screen overflow-auto" x-show="isOpen[i]">
						<div class="relative mx-auto grid grid-cols-1 lg:grid-cols-3 py-5 divide-y divide-gray-200 lg:divide-y-0 space-y-5 lg:space-y-0">

							<!-- Overview & featured pages -->
							<div class="lg:border-r lg:border-gray-200 px-2">
								<h3 class="text-base font-bold sr-only">Hervorgehobenen Menüpunkte</h3>
								<ul role="list" class="space-y-1 lg:space-y-6">

									<!-- Overview -->
									<li class="flow-root border-b border-gray-200 pb-5">
										<a x-bind:href="domain.url" class="flex rounded-lg px-3 lg:py-2 transition duration-150 ease-in-out hover:bg-gray-100">
											<div class="min-w-0 flex-1">
												<h4 class="text-sm lg:text-base">Übersicht</h4>
												<p class="mt-1 text-sm lg:text-md" x-html="domain.excerpt"</p>
											</div>
										</a>
									</li>
									<!-- End overview -->

									<!-- Featured pages -->
									<template x-for="page in domain.featured">
										<li class="flow-root" x-bind:class="{'current': pageID == page.ID }">
											<a
												x-bind:href="page.url"
												class="flex rounded-lg lg:py-2 transition duration-150 ease-in-out hover:bg-gray-100 items-center">
												<div class="w-full h-full w-16 h-16 flex justify-center items-center">
													<!-- FIXME: get icon from ACF field? -->
													<img class="h-auto w-10" x-bind:src="page.thumbnail || defaultIcon"/>
												</div>
												<div class="min-w-0 flex-1 sm:ml-8">
													<h4 class="text-sm lg:text-base" x-text="page.title"></h4>
													<p class="mt-1 text-sm text-gray-500 hidden lg:block" x-html="page.excerpt"></p>
												</div>
											</a>
										</li>
									</template>
									<!-- End featured pages -->

									<!-- If there are *no* featured pages menu items go here -->
									<template x-if="domain.featured.length == 0">
										<template x-for="page in domain.pages">
											<li class="lg:flow-root" x-bind:class="{'current': pageID == page.ID }">
												<a
													x-bind:href="page.url"
													class="flex items-center rounded-md px-3 py-2  transition duration-150 ease-in-out hover:bg-gray-200">
													<span class="w-full" x-text="page.title"></span>
												</a>
											</li>
										</template>
									</template>
									<!-- End menu items -->

									<!-- If there are no featured pages add search here -->
									<template x-if="domain.featured.length == 0">
										<li class="lg:flow-root">
											<label for="default-search" class="mb-2 text-primary dark:text-primary">
												<?php _e('Suche in: ', 'wkmde-theme'); ?>
												<span x-text="domain.title"></span>
											</label>
											<?php get_search_form(); ?>
										</li>
									</template>
									<!-- End -->

								</ul>
							</div>
							<!-- End overview & featured -->

							<!-- If there *are* featured pages other menu items go here -->
							<template x-if="domain.featured.length > 0">
								<nav class="bg-white col-span-2 py-5 lg:py-0" aria-labelledby="solutions-heading">
									<h2 id="solutions-heading" class="sr-only" x-text="domain.title"></h2>
									<div class="lg:max-h-screen overflow-auto">
										<ul role="list" class="text-sm lg:text-base lg:space-y-2 mx-2 lg:mx-5 lg:flex lg:flex-wrap items-baseline">

										<!-- For each menu item... -->
										<template x-for="page in domain.pages">
											<li class="lg:flow-root lg:w-1/3" x-bind:class="{'current': pageID == page.ID }">
												<a x-bind:href="page.url" class="flex items-center rounded-md px-3 py-2  transition duration-150 ease-in-out hover:bg-gray-200">
													<span class="w-full" x-text="page.title"></span>
												</a>
											</li>
										</template>
										<!-- End -->

										</ul>
										<!-- Search -->
										<div class="mx-8 max-w-xl mt-10">
											<label for="default-search" class="mb-2 text-primary dark:text-primary">
											<?php _e('Suche in: ', 'wkmde-theme'); ?>
											<span x-text="domain.title"></span>
										</label> <?php get_search_form(); ?>
										</div>
										<!-- End -->
									</div>
								</nav>
							</template>
							<!-- End -->

						</div>
					</div>
				</template>
				<!-- End for each domain -->
			</div>
			<!-- End desktop -->

		</div>
	</div>

</div>
