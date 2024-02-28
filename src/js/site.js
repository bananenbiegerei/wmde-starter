import * as TW from './tailwindhelpers';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import Swiper, { Navigation, Autoplay, Pagination, Mousewheel } from 'swiper';
import Swup from 'swup';
import SwupFragmentPlugin from '@swup/fragment-plugin';

const swup = new Swup({
	containers: ['#main-content'],
	plugins: [
		new SwupFragmentPlugin({
			debug: true,
			rules: [
				{
					from: '/timeline/',
					to: '/timeline-item(.*)',
					containers: ['#swup-modal'],
					name: 'open-modal',
				},
				{
					from: '/timeline-item(.*)',
					to: '/timeline/',
					containers: ['#swup-modal'],
					name: 'close-modal',
				},
			],
		}),
	],
});
swup.hooks.on('visit:start', (visit) => {
	console.log(visit);
});
// Init Alpine
window.Alpine = Alpine;
Alpine.plugin(focus);
Alpine.start();

// Make Tailwind config available outside of package
window.TW = TW;

// Initialize all swipers
// 'SwipersConfig' is defined in 'head.php', every swiper block adds its config in it.
var Swipers = {};
for (sel in SwipersConfig) {
	Swipers[sel] = new Swiper(`${sel} .swiper-container`, {
		// include modules
		...{ modules: [Navigation, Autoplay, Pagination, Mousewheel] },
		// enable mouse-wheel by default
		...{ mousewheel: { forceToAxis: true } },
		// include swiper-specific config
		...SwipersConfig[sel],
	});
}
window.Swipers = Swipers;
