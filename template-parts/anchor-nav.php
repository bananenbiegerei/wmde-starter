<script>

// Check if an element is visible
function isVisible(element) {
	return element.offsetWidth > 0 || element.offsetHeight > 0;
}

// Calculate vertical offset of sticky anchor-nav
function calcTopNavOffset() {
	if (isVisible(document.getElementById('navmenu_desktop'))) {
		return this.offset = document.getElementById('navmenu_desktop').getBoundingClientRect().height;
	} else {
		return this.offset = document.getElementById('titlebar_mobile').getBoundingClientRect().height;
	}
}

// Get position of element in page
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

document.addEventListener('alpine:init', () => {
	Alpine.data('anchorNav', () => ({
		anchors: [],
		buffer: 16,
		justifyCenter: false,
		// Init anchor-nav
		init() {
			// Find all headline blocks that have an anchor title
			for (const h of document.querySelectorAll(".bb-headline-block:not([data-anchor-title=''])")) {
				this.anchors.push({'id': h.id, 'title': h.getAttribute('data-anchor-title')});
			}
			if (this.anchors.length == 0) {
				document.getElementById('anchor-nav').style.display = 'none';
			}
			// Adjust vertical offset of sticky anchor-nav
			document.getElementById('anchor-nav').style.top = calcTopNavOffset() + 'px';
			window.addEventListener('resize', function () {
				document.getElementById('anchor-nav').style.top = calcTopNavOffset() + 'px';
			});
		},
		// Scroll to element on page
		scrollTo(anchor) {
			const pos = getCoords(document.getElementById(anchor.id)).top - calcTopNavOffset() - document.getElementById('anchor-nav').getBoundingClientRect().height - this.buffer;
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
};
</script>

<div id="anchor-nav" x-data="anchorNav" class="border-b border-gray-200 sticky z-30 bg-white" x-show="anchors.length > 0">
	<div class="flex items-center container">
		<div class="flex none md:hidden">
			<?= bb_icon('chevron-left', 'swiper-button-prev btn btn-icon-only btn-ghost cursor-pointer') ?>
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
			<?= bb_icon('chevron-right', 'swiper-button-next btn btn-icon-only btn-ghost cursor-pointer') ?>
		</div>
	</div>
</div>
