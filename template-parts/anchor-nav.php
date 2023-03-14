<script>
// hide for mobile...

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

document.addEventListener('alpine:init', () => {
	Alpine.data('anchorNav', () => ({
		anchors: [],
		offset: 0,
		buffer: 140, // manual for now...
		init() {
			for (const h of document.querySelectorAll('.bb-headline-block[id]')) {
				this.anchors.push({'id': h.id, 'title': h.getAttribute('data-anchor-title')});
			}
			if (this.anchors.length == 0) {
				document.getElementById('anchor-nav').style.display = 'none';
			}
			document.getElementById('anchor-nav').style.top = calcTopNavOffset() + 'px';
			window.addEventListener('resize', function () {
				document.getElementById('anchor-nav').style.top = calcTopNavOffset() + 'px';
			});
		},
		 getCoords(elem) {
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
		},
		scrollTo(id) {
			const pos = this.getCoords(document.getElementById(id)).top;
			console.log(id, pos);
			window.scrollTo({ 'top': pos - this.offset - this.buffer, 'behavior': 'smooth'});
		}
	}));
});
</script>

<div id="anchor-nav" x-data="anchorNav" class="border-b border-gray-200  sticky z-30 bg-white">
	<ul>
		<template x-for="(anchor,i) in anchors">
			<li class="inline-block cursor-pointer py-2 px-8"><span x-text="anchor.title" @click="scrollTo(anchor.id)"></span></li>
		</template>
	</ul>
</div>
