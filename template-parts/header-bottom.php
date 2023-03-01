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

	function getCoords(elem) {
		var box = elem.getBoundingClientRect();
		var body = document.body;
		var docEl = document.documentElement;
		var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
		var scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;
		var clientTop = docEl.clientTop || body.clientTop || 0;
		var clientLeft = docEl.clientLeft || body.clientLeft || 0;
		var top  = box.top +  scrollTop - clientTop;
		var left = box.left + scrollLeft - clientLeft;
		return { top: Math.round(top), left: Math.round(left) };
	}

	// Prepare x-data for 'navMenu' component
	document.addEventListener('alpine:init', () => {
		Alpine.data('navMenu', () => ({
			nav: WPNav,
			isOpen: new Array(WPNav.length).fill(false),
			timeOutFunctionId: 0,
			idx: -1,
			showPointer: false,
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
					}, 50);
				};
			},
			openNav(n) {
				var v = this.isOpen[n];
				this.isOpen.fill(false);
				this.idx = n;
				if (this.nav[n].pages.length > 0) {
				this.isOpen[n] = true;
				}
			},
			closeNav() {
				this.isOpen.fill(false);
				this.idx = -1;
			},
			movePointer() {
				if (this.nav[this.idx].pages.length == 0) {
					this.showPointer = false;
					return;
				}
				this.showPointer = true;
				var bx = document.getElementById('menu' + this.idx).getBoundingClientRect().left; // button x
				var bw = document.getElementById('menu' + this.idx).offsetWidth; // button width
				var dxoff = getCoords(document.getElementById('navbar')).left; // dropdown h offset
				var pw = 42; // pointer width
				var pyoff = -30; // pointer v offset
				document.getElementById('pointer').style.left = bx - dxoff + bw/2 - pw/2 + 'px';
				document.getElementById('pointer').style.top = pyoff + 'px';
			}
		}));
	});
</script>

<!-- Container for the whole desktop nav menu -->
<div x-data="navMenu" class="border-b border-gray-200 sticky top-0 z-40 bg-white py-1 block" x-show="$store.open_mobile_nav" XX@mouseleave="closeNav()" >

	<!-- Domains top bar -->
	<div id="navbar" class="relative z-10 px-2 container">
		<div class="flex space-x-1 py-3">

			<!-- Domain items -->
			<template x-for="(domain,i) in nav">
				<!-- Domain name -->
				<button type="button" class="btn btn-menu relative" aria-expanded="false" @mouseenter="openNav(i); movePointer()" x-bind:id="'menu' + i" >
					<a x-bind:href="domain.url"> <span x-text="domain.title"></span> </a>
				</button>
			</template>

		</div>
	</div>

	<!-- Submenus items go below the navigation bar -->
	<div id="navdropdown" class="relative block container">

		<!-- Pointer to domain button -->
		<div class="z-20 absolute pointer-events-none" id="pointer" x-show="showPointer">
			<svg viewBox="-4 -9 42 42" width="42px" height="42px"><path d="M 16 10 L 32 26 L 0 26 L 16 10 Z" style="	filter: drop-shadow(rgba(0, 0, 0, 0.05) 0px -10px 10px); fill: rgb(255, 255, 255);" bx:shape="triangle 0 10 32 16 0.5 0 1@8dd5f6f9"></path></svg>
		</div>

		<!-- For each domain... -->
		<template x-for="(domain,i) in nav">
			<div x-show="isOpen[i]" class="absolute inset-x-0 z-10 transform shadow-lg bg-white max-h-screen rounded-xl shadow-navbar-dropdown p-5" x-bind:class="{'max-w-6xl': domain.featured.length > 0, 'max-w-2xl': domain.featured.length == 0}">


				<!-- If there are featured pages: 2 columns with featured pages + pages -->
				<div class="relative mx-auto grid" x-bind:class="{ 'grid-cols-2' : domain.featured.length > 0, 'grid-cols-1': domain.featured.length == 0}">

					<!-- Featured pages -->
					<template x-if="domain.featured.length > 0">
						<nav class="border-r border-gray-200 pr-5">
							<ul role="list" class="flex flex-col">
								<template x-for="page in domain.featured">
									<li class="bg-white transition hover:bg-gray p-1 rounded-xl" x-bind:class="{'current': pageID == page.ID }">
										<a x-bind:href="page.url" class="btn btn-menu">
											<div class="w-full h-full w-16 h-16 flex justify-center items-center">
												<img class="h-auto w-10" x-bind:src="page.thumbnail || defaultIcon"/>
											</div>
											<div class="min-w-0 flex-1 ml-8">
												<h4 class="text-base" x-text="page.title"></h4>
												<p class="mt-1 text-sm text-gray-500 block" x-html="page.excerpt"></p>
											</div>
										</a>
									</li>
								</template>
							</ul>
						</nav>
					</template>

					<!-- Pages & sections -->
					<nav class="pl-5 overflow-auto" aria-labelledby="solutions-heading">
						<ul role="list" class="grid grid-cols-1 gap-2 items-stretch justify-items-stretch"  x-bind:class="{ 'grid-cols-2' : domain.featured.length > 0}" >

							<!-- Pages -->
							<template x-for="page in domain.pages">
								<li class="bg-white transition hover:bg-gray hover:drop-shadow-sm rounded-md" x-bind:class="{'current': pageID == page.ID }">
									<a x-bind:href="page.url" class="btn btn-menu btn-expanded font-normal" x-text="page.title"></a>
								</li>
							</template>

							<!-- Sections -->
							<template x-for="(section_pages, section_title) in domain.sections">
								<li class="font-bold border-2 border-red">
									<span class="pl-2" x-text="section_title.split('#')[0]"></span>
									<ul role="list" class="grid grid-cols-1 gap-2 items-stretch justify-items-stretch">
										<template x-for="page in section_pages">
											<li class="bg-white transition hover:bg-gray hover:drop-shadow-sm rounded-md" x-bind:class="{'current': pageID == page.ID }">
												<a x-bind:href="page.url" class="btn btn-menu btn-expanded font-normal" x-text="page.title"></a>
											</li>
										</template>
									</ul>
								</li>
							</template>

						</ul>
					</nav>

				</div>
			</div>
		</template>

		</div>
	</div>

