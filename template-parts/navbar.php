<script>
	// Get current page ID (used to set 'current' class to menu item)
	const pageID = <?php echo get_the_ID(); ?>;
	// Get content of top-nav menu
	var WPNav = JSON.parse('<?php echo json_encode(bb_get_nav_menu()); ?>');

	// Breakpoint for large
	const lgWidth = 1024;
	if (typeof(TW) !== 'undefined') {
		lgWidth = parseInt(TW.fullConfig.theme.screens.lg);
	}

	// Default icon when featured page thumbnail is missing
	const defaultIcon = "<?php echo get_stylesheet_directory_uri(); ?>/img/placeholders/wiki-logo-icon.png";

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
		class="navbar border-b border-gray-200 sticky top-0 z-40 bg-white block"
		transition x-show="$store.open_mobile_nav"
		X@mouseleave="closeNav()"
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
								class="btn btn-menu relative"
								aria-expanded="false"
								X@mouseenter="openNav(i)"
								@click="toggleNav(i)">
								<span x-text="domain.title"></span>
								<svg class="w-auto h-4 fill-white absolute" viewBox="0 0 32 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M16.2469 0L31.5 15.2531L0.993896 15.2531L16.2469 0Z" fill="red"/>
								</svg>

							</button>

							<!-- For mobile: add the items right underneath the domain -->
							<div class="lg:hidden" x-show="isOpen[i]">

								<!-- Featured pages (mobile) -->
								<ul>
									<template x-for="page in domain.featured">
										<li class="" x-bind:class="{'current': pageID == page.ID }">
											<a
												x-bind:href="page.url"
												class="btn btn-menu">
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
												class="btn btn-menu">
												<span class="w-full" x-text="page.title"></span>
											</a>
										</li>
									</template>
								</ul>

							</div>
							<!-- End Mobile -->
							<hr class="border-b-1 border-gray-100 lg:border-0">
						</div>
					</template>
					<!-- End for each domain -->
			</div>
			<!-- End domains top bar -->

			<!-- For desktop: domain submenus go below the navigation bar -->
			<div  class="hidden lg:block">

				<!-- For each domain... -->
				<template x-for="(domain,i) in nav">
					<div class="absolute inset-x-0 z-10 transform shadow-lg bg-white max-h-screen  max-w-6xl mx-8 rounded-xl shadow-navbar-dropdown py-8" x-show="isOpen[i]">
						<div class="relative mx-auto grid grid-cols-1 lg:grid-cols-2 divide-y divide-gray-200 lg:divide-y-0 space-y-5 lg:space-y-0">

							<!-- Overview & featured pages -->
							<div class="lg:border-r lg:border-gray-100 px-2">
								<h3 class="text-base font-bold sr-only">Hervorgehobenen Menüpunkte</h3>
								<ul role="list" class="space-y-1 lg:space-y-6">

									<!-- Featured pages -->
									<template x-for="page in domain.featured">
										<li class="flow-root" x-bind:class="{'current': pageID == page.ID }">
											<a
												x-bind:href="page.url"
												class="btn btn-menu">
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
													class="btn btn-menu">
													<span class="w-full" x-text="page.title"></span>
												</a>
											</li>
										</template>
									</template>
									<!-- End menu items -->

								</ul>
							</div>
							<!-- End overview & featured -->

							<!-- If there *are* featured pages other menu items go here -->
							<template x-if="domain.featured.length > 0">
								<nav class="bg-white py-5 lg:py-6" aria-labelledby="solutions-heading">
									<h2 id="solutions-heading" class="sr-only" x-text="domain.title"></h2>
									<div class="lg:max-h-screen overflow-auto">
										<ul role="list" class="grid grid-cols-2 gap-4">

										<!-- For each menu item... -->
										<template x-for="page in domain.pages">
											<li class="lg:flow-root" x-bind:class="{'current': pageID == page.ID }">
												<a x-bind:href="page.url" class="btn btn-menu ">
													<span class="w-full text-gray" x-text="page.title"></span>
												</a>
											</li>
										</template>
										<!-- End -->

										</ul>
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
</div>
