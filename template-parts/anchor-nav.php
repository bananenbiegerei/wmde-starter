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
		narrow: false,
		init() {
			for (const h of document.querySelectorAll(".bb-headline-block:not([data-anchor-title=''])")) {
				this.anchors.push({'id': h.id, 'title': h.getAttribute('data-anchor-title')});
			}
			if (this.anchors.length == 0) {
				document.getElementById('anchor-nav').style.display = 'none';
			}

			document.getElementById('anchor-nav').style.top = calcTopNavOffset() + 'px';

			var anchorNavWidth = document.querySelector('#anchor-nav ul').getBoundingClientRect().width ;
			var bodyWidth = document.querySelector('body').getBoundingClientRect().width;
			if (anchorNavWidth <  bodyWidth ) {
				this.narrow = true;
			}

			window.addEventListener('resize', function () {
				document.getElementById('anchor-nav').style.top = calcTopNavOffset() + 'px';
				var anchorNavWidth = document.querySelector('#anchor-nav ul').getBoundingClientRect().width ;
				var bodyWidth = document.querySelector('body').getBoundingClientRect().width;
				if (anchorNavWidth > bodyWidth ) {
					this.narrow = false;
				} else {
					this.narrow = true;
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
<div id="anchor-nav" x-data="anchorNav" class="border-b border-gray-200  sticky z-30 bg-white" x-show="anchors.length > 0">
	<ul class="sm:flex" x-bind:class="{ 'justify-center': 'narrow' }">
		<template x-for="(anchor,i) in anchors">
			<li class="sm:inline-block cursor-pointer py-1 sm:py-2 px-5 sm:px-8 text-xs sm:text-sm"><span x-text="anchor.title" @click="scrollTo(anchor)"></span></li>
		</template>
	</ul>
</div>
