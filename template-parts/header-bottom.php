		<!--
		FIXME: split desktop and mobile versions (this is becomig too complex...)
		FIXME: get measurements dynamically
		FIXME: simplify!
-->
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
						idx: -1,
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
						toggleNav(n) {
								var v = this.isOpen[n];
								this.isOpen.fill(false);
								this.isOpen[n] = !v;
								this.idx = this.isOpen[n] ? n : -1;
						},
						openNav(n) {
								var v = this.isOpen[n];
								this.isOpen.fill(false);
								this.isOpen[n] = true;
								this.idx = n;
						},
						closeNav() {
								this.isOpen.fill(false);
								this.idx = -1;
						},
						movePointer() {
								if (this.idx === -1) {
										return;
								}
								var bx = document.getElementById('menu' + this.idx).getBoundingClientRect().left; // button x
								var bw = document.getElementById('menu' + this.idx).offsetWidth; // button width
								// FIXME: get these values dynamically...
								var dxoff = 16; // dropdown h offset
								var pw = 42; // pointer width
								var pyoff = -30; // pointer v offset
								document.getElementById('pointer').style.left = bx - dxoff + bw/2 - pw/2 + 'px';
								document.getElementById('pointer').style.top = pyoff + 'px';
						}
				}));
		});
</script>
<!-- Container for the whole nav menu -->
<div x-data="navMenu"
	class="border-b border-gray-200 sticky top-0 z-40 bg-white py-1 block"
	x-show="$store.open_mobile_nav"
	@mouseleave="closeNav()"
>
	<!-- Domains top bar -->
	<div class="relative z-10 lg:px-2 container">
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
						@mouseenter="openNav(i); movePointer()"
						x-bind:id="'menu' + i"
						>
						<a x-bind:href="domain.url">
							<span x-text="domain.title"></span>
						</a>
					</button>

					<?php get_template_part("template-parts/navbar-mobile"); ?>
					<hr class="border-b-1 border-gray-100 lg:border-0">
				</div>
			</template>
			<!-- End for each domain -->
		</div>
	</div>
	<!-- End domains top bar -->

	<?php get_template_part("template-parts/navbar-desktop"); ?>
</div>
