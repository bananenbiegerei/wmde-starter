<script>
	function getCoords(elem) {
		let box = elem.getBoundingClientRect();
		let body = document.body;
		let docEl = document.documentElement;
		let scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
		let scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;
		let clientTop = docEl.clientTop || body.clientTop || 0;
		let clientLeft = docEl.clientLeft || body.clientLeft || 0;
		let top  = box.top +  scrollTop - clientTop;
		let left = box.left + scrollLeft - clientLeft;
		return { top: Math.round(top), left: Math.round(left) };
	}

	// Prepare x-data for 'navMenu' component
	document.addEventListener('alpine:init', () => {
		Alpine.data('navMenu', () => ({
			nav: WPNav,
			isOpen: new Array(WPNav.length).fill(false),
			idx: -1,
			showPointer: false,
			isScrolled: false,
			init() {
				// Slide-in logo when sticky navbar
				window.addEventListener('scroll', () => {
					const scrollPosition = window.scrollY;
					const threshold = document.getElementById('titlebar_desktop').getBoundingClientRect().height;
					if (scrollPosition >= threshold) {
						this.isScrolled = true;
					} else {
						this.isScrolled = false;
					}
				});
			},
			openNav(n) {
				this.isOpen.fill(false);
				this.idx = n;
				if ((this.nav[n].featured.length + this.nav[n].pages.length + this.nav[n].sections.length) > 0 ) {
					this.isOpen[n] = true;
				}
			},
			closeNav() {
				this.isOpen.fill(false);
				this.idx = -1;
				this.showPointer = false;
			},
			movePointer() {
				if (this.nav[this.idx].pages.length  + this.nav[this.idx].sections.length == 0) {
					this.showPointer = false;
					return;
				}
				this.showPointer = true;
				let bx = document.getElementById('domain_' + this.idx).getBoundingClientRect().left; // button x
				let bw = document.getElementById('domain_' + this.idx).offsetWidth; // button width
				let dxoff = getCoords(document.getElementById('navdropdown')).left; // dropdown h offset
				let pw = 32; // pointer width
				let pyoff = -20; // pointer v offset
				let ddw = document.getElementById('menu_' + this.idx).offsetWidth;
				let voff = parseInt(window.getComputedStyle(document.querySelector('#navmenu_desktop .container')).getPropertyValue("margin-left").match(/\d+/).pop());
				let ddx = Math.max(dxoff, bx + bw/2 - ddw/2) -voff;
				document.getElementById('menu_' + this.idx).style.left = ddx + 'px';
				document.getElementById('pointer').style.left = bx - dxoff + bw/2 - pw/2 + 'px';
				document.getElementById('pointer').style.top = pyoff + 'px';
			},
		}));
	});
</script>

<!-- Container for the whole desktop nav menu -->
<div id="navmenu_desktop" x-data="navMenu" class="border-b border-gray-200 sticky top-0 z-40 bg-white py-1 hidden lg:block" @mouseleave="closeNav()" >

	<!-- Top bar with logo, domains, and search -->
	<div class="relative z-10 container overflow-hidden">

		<!-- Logo -->
		<div class="absolute left-5 top-2 overflow-hidden">
			<div class="transition-all duration-500 ease-in-out opacity-0 -translate-x-10" x-bind:class="{ 'opacity-0 -translate-x-10': !isScrolled, 'opacity-100 translate-x-0': isScrolled }">
				<a href="<?php echo get_home_url(); ?>">
					<img class="mini-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/wikimedia-logo-mini.svg" alt="Logo">
				</a>
			</div>
		</div>

		<!-- Domains & search -->
		<div class="flex items-center">

			<!-- Domains -->
			<div class="navmenu flex-none flex space-x-1 py-3 transition-all duration-500 ease-in-out ml-10" x-bind:class="{ '-translate-x-12': !isScrolled, 'translate-x-10': isScrolled }">
				<!-- Domain items -->
				<template x-for="(domain,i) in nav">
					<button type="button" class="btn btn-menu relative" aria-expanded="false" @mouseenter="openNav(i); movePointer()" x-bind:id="'domain_' + i" x-bind:class="{'current': pageID == domain.ID }">
						<a x-bind:href="domain.url"> <span x-html="domain.title"></span> </a>
					</button>
				</template>
			</div>

			<!-- Search -->
			<div class="flex-1 flex justify-end gap-5 items-center h-full pl-12" x-data="{ open: false }">
				<div class="w-full"
					 x-show="open"
					 x-transition:enter="transition ease-out duration-300"
					 x-transition:enter-start="opacity-0 scale-90"
					 x-transition:enter-end="opacity-100 scale-100"
					 x-transition:leave="transition ease-in duration-300"
					 x-transition:leave-start="opacity-100 scale-100"
					 x-transition:leave-end="opacity-0 scale-90"
					 @click.outside="open = false">
					<form class="flex gap-5 form-sm w-full" action="<?php echo home_url('/'); ?>" method="get">
						<input type="text" name="s" id="search" x-ref="searchInput" value="<?php the_search_query(); ?>" />
						<input type="submit" alt="Search" value="Suchen" class="btn btn-sm" />
					</form>
				</div>
				<button class="btn btn-ghost btn-icon-only !text-black"
						x-on:click="open = ! open; $nextTick(() => $refs.searchInput.focus())">
					<span class="sr-only">Toggle Search Input</span><?php echo bb_icon('search', 'icon-sm'); ?>
				</button>
			</div>

		</div>
	</div>

	<!-- Submenus items go below the navigation bar -->
	<div id="navdropdown" class="relative block container">

		<!-- Pointer to domain button -->
		<div class="z-20 absolute pointer-events-none w-8 h-6" id="pointer" x-show="showPointer">
			<img class="object-cover h-full w-full drop-shadow-xs" src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/pointer-top.png" alt="Logo">
		</div>

		<!-- For each domain... -->
		<template x-for="(domain,i) in nav">
			<div
				show="isOpen[i]"
				x-bind:id="'menu_'+ i"
				class="absolute inset-x-0 z-10 transform shadow-lg bg-white border border-gray-100 max-h-screen-80 rounded-xl shadow-navbar-dropdown p-5 overflow-hidden"
				x-bind:class="{
					'max-w-6xl': domain.featured.length > 0,
					'max-w-md': domain.featured.length == 0,
					'visible': isOpen[i],
					'invisible': !isOpen[i]
				}"
			>

				<!-- If there are featured pages: 2 columns with featured pages + pages -->
				<div class="relative mx-auto grid" x-bind:class="{ 'grid-cols-2' : domain.featured.length > 0, 'grid-cols-1': domain.featured.length == 0}">

					<!-- Featured pages -->
					<template x-if="domain.featured.length > 0">
						<nav class="border-r border-gray-200 pr-5 mr-5">
							<ul role="list" class="flex flex-col max-h-screen-80 overflow-auto">
								<template x-for="page in domain.featured">
									<li class="" x-bind:class="{'current': pageID == page.ID }">
										<a x-bind:href="page.url" class="flex items-center gap-5 transition hover:bg-gray p-1 rounded-xl h-12 p-4">
											<div class="">
												<img class="h-auto w-10" x-bind:src="page.thumbnail || defaultIcon"/>
											</div>
											<div class="">
												<h4 class="text-base m-0" x-html="page.title"></h4>
												<!-- <p class="mt-1 text-sm text-gray-500 block" x-html="page.excerpt"></p> -->
											</div>
										</a>
									</li>
								</template>
							</ul>
						</nav>
					</template>

					<!-- Pages & sections -->
					<nav class="max-h-screen-80 overflow-auto grid" x-bind:class="{ 'grid-cols-2' : domain.pages.length > 0 && domain.sections.length > 0 || domain.sections.length > 1 }">

						<!-- Pages -->
						<template x-if="domain.pages.length > 0">
							<ul role="list" class="items-stretch justify-items-stretch"  xxxx-bind:class="{ 'grid-cols-2' : domain.featured.length > 0}" >
								<template x-for="page in domain.pages">
									<li class="bg-white transition rounded-md"
										x-bind:class="{'current': pageID == page.ID }">
										<a x-bind:href="page.url" class="btn btn-menu btn-expanded font-normal" x-html="page.title"></a>
									</li>
								</template>
							</ul>
						</template>

						<!-- Sections -->
						<template x-for="section in domain.sections">
							<ul role="list" class="items-stretch justify-items-stretch">
								<li class="bg-white transition rounded-md btn btn-menu-section btn-expanded" x-text="section.title"></li>
								<template x-for="page in section.pages">
									<li class="bg-white transition rounded-md"
										x-bind:class="{'current': pageID == page.ID }">
										<a x-bind:href="page.url" class="btn btn-menu btn-expanded font-normal" x-html="page.title"></a>
									</li>
								</template>
							</ul>
						</template>

					</nav>
				</div>
			</div>
		</template>
	</div>
</div>

