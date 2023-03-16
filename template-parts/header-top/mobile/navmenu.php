<script>
	// Prepare x-data for 'navMenuMobile' component
	document.addEventListener('alpine:init', () => {
		Alpine.data('navMenuMobile', () => ({
			nav: WPNav,
			isOpen: new Array(WPNav.length).fill(false),
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

<!-- Container for the whole mobile nav menu -->
<div id="navmenu_mobile" x-data="navMenuMobile" class="z-40 block bg-white fixed left-0 right-0  bottom-0 top-12 block lg:hidden overflow-scroll" x-show="$store.open_mobile_nav"
x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90"
>

	<template x-for="(domain,i) in nav">

		<div class="border-b border-gray-200">

			<div  class="relative border-l-8 nav_item" x-bind:class="{ 'border-transparent' : !isOpen[i], 'border-blue-600' : isOpen[i] }" >

				<!-- Domain title -->
				<div x-bind:class="{'current before:w-2 before:h-16 before:bg-primary-600 before:absolute before:-left-2 before:top-0': pageID == domain.ID }">
				<a
					x-bind:href="domain.url"
					class="btn btn-menu h-16">
					<span class="w-full" x-text="domain.title"></span>
				</a>
				</div>
				<!-- TODO: @EL hide plus for pages without children see. Presse -->
				<div @click="toggleNav(i)" class="absolute top-5 right-5" x-bind:class="{ 'item_closed' : !isOpen[i], 'item_open' : isOpen[i] }" >
					<?= bb_icon('menu_open', 'cursor-pointer open') ?>
					<?= bb_icon('menu_close', 'cursor-pointer close') ?>	
				</div>

				<!-- Wrapper for domain items -->
				<div x-show="isOpen[i]" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90">

					<!-- Domain link -->
					<!-- <div>
					<a x-bind:href="domain.url" class="btn btn-menu">
						<span class="w-full" x-text="domain.title"></span>
					</a>
					</div> -->

					<!-- Featured pages -->
					<template x-if="domain.featured.length >0">
						<ul class="pb-5">
							<template x-for="page in domain.featured">
								<li class="px-5" x-bind:class="{'current': pageID == page.ID }">
									<a
										x-bind:href="page.url"
										class="btn btn-menu">
										<div class="w-full h-full w-10 h-10 mr-2 flex justify-center items-center">
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
								<li class="px-5 py-2" x-bind:class="{'current': pageID == page.ID }">
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
						<ul class="border-t border-gray-200 py-4 px-2">
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
