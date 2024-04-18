import * as TW from './tailwindhelpers';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import Swiper, { Navigation, Autoplay, Pagination, Mousewheel } from 'swiper';
import Swup from 'swup';
import SwupFragmentPlugin from '@swup/fragment-plugin';
import JSConfetti from 'js-confetti';

const canvas = document.getElementById('confetti-canvas');
const button = document.getElementById('confetti-button');

if (canvas && button) {
	const jsConfetti = new JSConfetti({ canvas });

	setTimeout(() => {
		jsConfetti.addConfetti({
			confettiColors: ['#7A75DF', '#F3BD2C', '#5FA87D', '#BCDEC6', '#F9E48E', '#CED3F7', '#3E3877', '#743713', '#1A3A2B'],
		});
	}, 1500);

	button.addEventListener('click', () => {
		jsConfetti.addConfetti({
			confettiColors: ['#7A75DF', '#F3BD2C', '#5FA87D', '#BCDEC6', '#F9E48E', '#CED3F7', '#3E3877', '#743713', '#1A3A2B'],
		});
	});
}

const swup = new Swup({
	containers: ['#swup', '#main-content'],
	plugins: [
		new SwupFragmentPlugin({
			debug: true,
			rules: [
				{
					from: '/timeline(.*)',
					to: '/timeline-item(.*)',
					containers: ['#swup-modal'],
					name: 'open-modal',
				},
				{
					from: '/timeline-item(.*)',
					to: '/timeline(.*)',
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
