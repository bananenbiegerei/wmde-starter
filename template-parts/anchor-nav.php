<script>
function isVisible(element) {
	return element.offsetWidth > 0 || element.offsetHeight > 0;
}

function calcTopNavOffset() {
	if (isVisible(document.getElementById('navmenu_desktop'))) {
		return this.offset = document.getElementById('navmenu_desktop').getBoundingClientRect().height;
	} else {
		return this.offset = document.getElementById('titlebar_mobile').getBoundingClientRect().height;
	}
}

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
		init() {
			for (const h of document.querySelectorAll(".bb-headline-block:not([data-anchor-title=''])")) {
				this.anchors.push({'id': h.id, 'title': h.getAttribute('data-anchor-title')});
			}
			if (this.anchors.length == 0) {
				document.getElementById('anchor-nav').style.display = 'none';
			}

			document.getElementById('anchor-nav').style.top = calcTopNavOffset() + 'px';

			var anchorNavWidth = document.querySelector('#anchor-nav ul').scrollWidth;
			var bodyWidth = document.querySelector('body').getBoundingClientRect().width;
			if (anchorNavWidth <  bodyWidth ) {
				this.justifyCenter = true;
			} else {
			}

			window.addEventListener('resize', function () {
				document.getElementById('anchor-nav').style.top = calcTopNavOffset() + 'px';
				var anchorNavWidth = document.querySelector('#anchor-nav ul').scrollWidth;
				var bodyWidth = document.querySelector('body').getBoundingClientRect().width;
				console.log(anchorNavWidth, bodyWidth);
				if (anchorNavWidth > bodyWidth ) {
					this.justifyCenter = false;
				} else {					console.log('justifyCenter');
					this.justifyCenter = true;
				}
			});
		},
		scrollTo(anchor) {
			const pos = getCoords(document.getElementById(anchor.id)).top - calcTopNavOffset() - document.getElementById('anchor-nav').getBoundingClientRect().height - this.buffer;
			window.scrollTo({ 'top': pos , 'behavior': 'smooth'});
		}
	}));
});
</script>
<div id="anchor-nav" x-data="anchorNav" class="border-b border-gray-200 sticky z-30 bg-white" x-show="anchors.length > 0">
	<ul class="md:flex container md:justify-center hidden" XXXx-bind:class="{ 'justify-center': justifyCenter }">
		<template x-for="(anchor,i) in anchors">
			<li class="sm:inline-block cursor-pointer sm:py-2 sm:px-8 text-base sm:text-base"><span x-text="anchor.title" @click="scrollTo(anchor)"></span></li>
		</template>
	</ul>
	<div class="flex items-center block md:hidden">
		<div class="flex none">
			<?= bb_icon('chevron-left', 'swiper-button-prev btn btn-icon-only btn-ghost cursor-pointer') ?>
		</div>
		<div class="flex-1 overflow-hidden">
			<div class="swiper-container">
				<ul class="swiper-wrapper"
				class="container hidden" XXXx-bind:class="{ 'justify-center': justifyCenter }"
				>
					<template x-for="(anchor,i) in anchors">
						<li class="swiper-slide !w-auto px-2"><span x-text="anchor.title" @click="scrollTo(anchor)"></span></li>
					</template>
				</ul>
			</div>
		</div>
		<div class="flex-none">
			<?= bb_icon('chevron-right', 'swiper-button-next btn btn-icon-only btn-ghost cursor-pointer') ?>
		</div>
	</div>
</div>

<script>
	SwipersConfig['#anchor-nav'] = {
		loop: false,
		centeredSlides: false,
		spaceBetween: 0,
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