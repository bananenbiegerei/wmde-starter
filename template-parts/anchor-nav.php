<script>

// Calculate vertical offset of sticky anchor-nav
function calcTopNavOffset() {
	const navmenuDesktop = document.getElementById('navmenu_desktop');
	const titlebarMobile = document.getElementById('titlebar_mobile');
	const navmenuDesktopVisible = navmenuDesktop.offsetWidth > 0 || navmenuDesktop.offsetHeight > 0;

	if (navmenuDesktopVisible) {
		return this.offset = navmenuDesktop.getBoundingClientRect().height;
	} else {
		return this.offset = titlebarMobile.getBoundingClientRect().height;
	}
}

// Calculate vertical offset of anchor
function getAnchorOffset() {
	return calcTopNavOffset() +  document.getElementById('anchor-nav').getBoundingClientRect().height;
}

// Get position of element in page
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

document.addEventListener('alpine:init', () => {
	Alpine.data('anchorNav', () => ({
		anchors: [],
		// Init anchor-nav
		init() {
			// Find all headline blocks that have an anchor title
			for (const h of document.querySelectorAll(".bb-headline-block:not([data-anchor-title=''])")) {
				this.anchors.push({'id': h.querySelector('.anchor-offset').id, 'title': h.getAttribute('data-anchor-title')});
			}
			if (this.anchors.length == 0) {
				document.getElementById('anchor-nav').style.display = 'none';
			}
			// Adjust vertical offset of sticky anchor-nav
			document.getElementById('anchor-nav').style.top = calcTopNavOffset() + 'px';
			// Adjust vertical offset of sticky anchor-nav and vertical offset of anchors (during window resize)
			window.addEventListener('resize', function () {
				document.getElementById('anchor-nav').style.top = calcTopNavOffset() + 'px';
				for (const h of document.querySelectorAll(".bb-headline-block:not([data-anchor-title='']) .anchor-offset")) {
					h.style.transform = 'translateY(-' + getAnchorOffset() + 'px)';
				}
			});
		},
		// Scroll to element on page
		scrollTo(anchor) {
			const pos = getCoords(document.getElementById(anchor.id)).top;
			window.scrollTo({ 'top': pos , 'behavior': 'smooth'});
		}
	}));
});

SwipersConfig['#anchor-nav'] = {
	loop: false,
	centeredSlides: false,
	spaceBetween: 16,
	speed: 200,
	grabCursor: true,
	draggable: true,
	slidesPerView: 'auto',
	freeMode: {
		enabled: true,
		sticky: true,
	},
	navigation: {
		nextEl: '#anchor-nav .swiper-button-next',
		prevEl: '#anchor-nav .swiper-button-prev',
	},
	on: {
		init: function () {
			// Adjust vertical offset of anchor
			for (const h of document.querySelectorAll(".bb-headline-block:not([data-anchor-title='']) .anchor-offset")) {
				h.style.transform = 'translateY(-' + getAnchorOffset() + 'px)';
			}
		}
	}
};
</script>

<div id="anchor-nav" x-data="anchorNav" class="border-b border-gray-200 sticky z-30 bg-white" x-show="anchors.length > 0">
	<div class="flex items-center container">
		<div class="flex-none md:hidden">
			<?= bb_icon('chevron-left', 'swiper-button-prev btn btn-icon-only btn-ghost cursor-pointer mt-2') ?>
		</div>
		<div class="flex-1 lg:flex-none overflow-hidden">
			<div class="swiper-container">
				<ul class="swiper-wrapper">
					<template x-for="(anchor,i) in anchors">
						<li class="swiper-slide !w-auto py-2 cursor-pointer"><span x-text="anchor.title" @click="scrollTo(anchor)"></span></li>
					</template>
				</ul>
			</div>
		</div>
		<div class="flex-none md:hidden">
			<?= bb_icon('chevron-right', 'swiper-button-next btn btn-icon-only btn-ghost cursor-pointer mt-2') ?>
		</div>
	</div>
</div>
