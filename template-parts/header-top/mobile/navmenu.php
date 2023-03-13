<script>
	// pageID, defaultIcon coming from 'navmenu-desktop.php'

	var WPNavMobile = JSON.parse('<?php echo json_encode(bb_get_nav_menu()); ?>');

	// Prepare x-data for 'navMenu' component
	document.addEventListener('alpine:init', () => {
		Alpine.data('navMenuMobile', () => ({
			nav: WPNavMobile,
			isOpen: new Array(WPNavMobile.length).fill(false),
			timeOutFunctionId: 0,
			init() {
			},
			toggleNav(n) {
				var v = this.isOpen[n];
				this.isOpen.fill(false);
				this.isOpen[n] = !v;
			}
		}));
	});
</script>

<!-- Container for the whole desktop nav menu -->
<div x-data="navMenuMobile" class="z-40 block bg-white fixed left-0 right-0  bottom-0 top-12 block lg:hidden overflow-scroll" x-show="$store.open_mobile_nav">

	<template x-for="(domain,i) in nav">

		<div class="border-b border-gray-200">

			<div  class="relative border-l-8 nav_item" x-bind:class="{ 'border-transparent item_closed' : !isOpen[i], 'border-blue-600 item_open' : isOpen[i] }" >

				<!-- Domain title -->
				<div @click="toggleNav(i)" class="py-4"><span class="btn btn-menu" x-text="domain.title"></span></div>

				<!-- Wrapper for domain items -->
				<div x-show="isOpen[i]">

					<!-- Domain link -->
					<div>
					<a x-bind:href="domain.url" class="btn btn-menu">
						<div class="w-full h-full w-4 h-4 mr-2 flex justify-center items-center">
							<img class="h-auto w-10" x-bind:src="domain.thumbnail || defaultIcon"/>
						</div>
						<span class="w-full" x-text="domain.title"></span>
					</a>
					</div>

					<!-- Featured pages -->
					<template x-if="domain.featured.length >0">
						<ul>
							<template x-for="page in domain.featured">
								<li class="py-2" x-bind:class="{'current': pageID == page.ID }">
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
					</template>

					<!-- Pages -->
					<template x-if="domain.pages.length > 0">
						<ul class="border-t border-gray-200 py-4">
							<template x-for="page in domain.pages">
								<li class="pl-6 py-2" x-bind:class="{'current': pageID == page.ID }">
									<a
										x-bind:href="page.url"
										class="btn btn-menu">
										<span class="w-full" x-text="page.title"></span>
									</a>
								</li>
							</template>
						</ul>
					</template>

					<!-- Sections -->
					<template x-for="(section_pages, section_title) in domain.sections">
						<ul class="border-t border-gray-200 py-4">
								<li class="pl-6">
									<span class="btn btn-menu-section" x-text="section_title.split('#')[0]"></span>
									<ul>
										<template x-for="page in section_pages">
											<li  class="py-2" x-bind:class="{'current': pageID == page.ID }">
												<a x-bind:href="page.url" x-text="page.title" class="btn btn-menu"></a>
											</li>
										</template>
									</ul>
								</li>
						</ul>
					</template>

				</div>
			</div>
		</div>
	</template>
</div>
