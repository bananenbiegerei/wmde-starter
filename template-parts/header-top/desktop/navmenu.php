<script>
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
			nav: [],
			isOpen: new Array(WPNav.length).fill(false),
			idx: -1,
			showPointer: false,
			isScrolled: false,
			curSection: 0,
			init() {
				// Build Nav structure: needs to be adapted to handle sections properly in template loop...
				for(var domain of WPNav ) {
					var dom = { 'ID': domain.ID, 'excerpt':domain.excerpt, 'title': domain.title, 'url': domain.url, 'featured': domain.featured };
					var featured = domain.featured;
					var pagesAndSections = [];
					for(var page of domain.pages) {
						page.type = 'link';
						pagesAndSections.push(page);
					}
					for(var titleId in domain.sections) {
						var section = { 'type': 'section', 'title': titleId.split('#')[0] };
						pagesAndSections.push(section);
						for(var page of domain.sections[titleId]) {
							page.type = 'link';
							pagesAndSections.push(page);
						}
					}
					dom.pagesAndSections = pagesAndSections;
					this.nav.push(dom);
				}
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
				var v = this.isOpen[n];
				this.isOpen.fill(false);
				this.idx = n;
				if ((this.nav[n].featured.length + this.nav[n].pagesAndSections.length) > 0 ) {
					this.isOpen[n] = true;
				}
			},
			closeNav() {
				this.isOpen.fill(false);
				this.idx = -1;
				this.showPointer = false;
			},
			movePointer() {
				if (this.nav[this.idx].pagesAndSections.length == 0) {
					this.showPointer = false;
					return;
				}
				this.showPointer = true;
				var bx = document.getElementById('domain_' + this.idx).getBoundingClientRect().left; // button x
				var bw = document.getElementById('domain_' + this.idx).offsetWidth; // button width
				var dxoff = getCoords(document.getElementById('navdropdown')).left; // dropdown h offset
				var pw = 32; // pointer width
				var pyoff = -20; // pointer v offset
				var ddw = document.getElementById('menu_' + this.idx).offsetWidth;
				var voff = parseInt(window.getComputedStyle(document.querySelector('#navmenu_desktop .container')).getPropertyValue("margin-left").match(/\d+/).pop());
				var ddx = Math.max(dxoff, bx + bw/2 - ddw/2) -voff;
				//console.log({'bx': bx, 'bw': bw, 'dxoff': dxoff, 'ddw': ddw, 'voff': voff, 'ddx': ddx});
				document.getElementById('menu_' + this.idx).style.left = ddx + 'px';
				document.getElementById('pointer').style.left = bx - dxoff + bw/2 - pw/2 + 'px';
				document.getElementById('pointer').style.top = pyoff + 'px';
			},
		}));
	});
</script>
<!-- Container for the whole desktop nav menu -->
<div id="navmenu_desktop" x-data="navMenu" class="border-b border-gray-200 sticky top-0 z-40 bg-white py-1 hidden lg:block" @mouseleave="closeNav()" >

	<!-- Domains top bar -->
	<div class="relative z-10 container">
		<div class="absolute left-5 top-2 overflow-hidden">
			<div class="transition-all duration-500 ease-in-out opacity-0 -translate-x-10" x-bind:class="{ 'opacity-0 -translate-x-10': !isScrolled, 'opacity-100 translate-x-0': isScrolled }">
				<a href="<?php echo get_home_url(); ?>">
					<img class="mini-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/wikimedia-logo-mini.svg" alt="Logo">
				</a>
			</div>
		</div>
		<div class="flex space-x-1 py-3 transition-all duration-500 ease-in-out" x-bind:class="{ 'translate-x-0': !isScrolled, 'translate-x-10': isScrolled }">

			<!-- Domain items -->
			<template x-for="(domain,i) in nav">
				<!-- Domain name -->
				<button type="button" class="btn btn-menu relative" aria-expanded="false" @mouseenter="openNav(i); movePointer()" x-bind:id="'domain_' + i" x-bind:class="{'current': pageID == domain.ID }">
					<a x-bind:href="domain.url"> <span x-text="domain.title"></span> </a>
				</button>
			</template>

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
				XXx-show="isOpen[i]"
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
					<nav class="max-h-screen-80 overflow-auto" aria-labelledby="solutions-heading">
						<ul role="list" class="items-stretch justify-items-stretch"  x-bind:class="{ 'grid-cols-2' : domain.featured.length > 0}" >

							<!-- Pages -->
							<template x-for="page in domain.pagesAndSections">
								<li class="bg-white transition rounded-md"
									x-bind:class="{'hover:bg-gray hover:drop-shadow-sm' : page.type == 'link', 'current': pageID == page.ID }">
									<span class="inline-block font-bold pt-8 px-1.5 py-0.5 uppercase" x-text="page.title" x-show="page.type == 'section'"></span>
									<a x-bind:href="page.url" class="btn btn-menu btn-expanded font-normal" x-text="page.title" x-show="page.type == 'link'"></a>
								</li>
							</template>

						</ul>
					</nav>

				</div>
			</div>
		</template>

		</div>
	</div>

