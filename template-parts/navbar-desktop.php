<!-- For desktop: domain submenus go below the navigation bar -->
<div id="navdropdown" class="relative lg:block container">

	<!-- Pointer to domain button -->
	<div class="z-20 absolute pointer-events-none" id="pointer" x-show="idx != -1">
		<svg viewBox="-4 -9 42 42" width="42px" height="42px"><path d="M 16 10 L 32 26 L 0 26 L 16 10 Z" style="	filter: drop-shadow(rgba(0, 0, 0, 0.05) 0px -10px 10px); fill: rgb(255, 255, 255);" bx:shape="triangle 0 10 32 16 0.5 0 1@8dd5f6f9"></path></svg>
	</div>

	<!-- For each domain... -->
	<template x-for="(domain,i) in nav">
		<div
			x-show="isOpen[i]"
			class="absolute inset-x-0 z-10 transform shadow-lg bg-white max-h-screen rounded-xl shadow-navbar-dropdown p-5"
			x-bind:class="{'max-w-6xl': domain.featured.length > 0, 'max-w-2xl': domain.featured.length == 0}"
		>

			<div
				class="relative mx-auto grid grid-cols-1 divide-y divide-gray-200 lg:divide-y-0"
				x-bind:class="{'lg:grid-cols-2': domain.featured.length > 0}"
			>

				<!-- Overview & featured pages -->
				<div class="" x-bind:class="{'lg:border-r lg:border-gray-200 lg:pr-5': domain.featured.length > 0}">
					<h3 class="text-base font-bold sr-only"><?php _e('Hervorgehobenen Menüpunkte', 'wmde'); ?></h3>
					<ul role="list" class="flex flex-col">

						<!-- Featured pages -->
						<template x-for="page in domain.featured">
							<li class="bg-white transition hover:bg-gray p-1 rounded-xl" x-bind:class="{'current': pageID == page.ID }">
								<a
									x-bind:href="page.url"
									class="btn btn-menu">
									<div class="w-full h-full w-16 h-16 flex justify-center items-center">
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
										class="btn btn-menu w-full">
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
					<nav class="lg:pl-5" aria-labelledby="solutions-heading">
						<h2 id="solutions-heading" class="sr-only" x-text="domain.title"></h2>
						<div class="lg:max-h-screen overflow-auto">
							<ul role="list" class="grid grid-cols-2 gap-2 items-stretch justify-items-stretch">

							<!-- For each menu item... -->
							<template x-for="page in domain.pages">
								<li class="bg-white transition hover:bg-gray hover:drop-shadow-sm rounded-md" x-bind:class="{'current': pageID == page.ID }">
									<a x-bind:href="page.url" class="btn btn-menu btn-expanded font-normal" x-text="page.title">
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