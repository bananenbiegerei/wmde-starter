import * as TW from './tailwindhelpers';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import Swiper, { Navigation, Autoplay, Pagination, Mousewheel } from 'swiper';
import Swup from 'swup';
import SwupFragmentPlugin from '@swup/fragment-plugin';

new Swup({
	containers: ['#main-content'],
	plugins: [
		new SwupFragmentPlugin({
			debug: true,
			rules: [
				{
					from: '/',
					to: '/detail-(.*)',
					containers: ['#modal'],
					name: 'open-modal',
				},
				{
					from: '/detail-(.*)',
					to: '/',
					containers: ['#modal'],
					name: 'close-modal',
				},
				{
					from: '/detail-(.*)',
					to: '/detail-(.*)',
					containers: ['#detail'],
				},
			],
		}),
	],
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
