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