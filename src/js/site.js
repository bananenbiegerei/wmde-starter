import * as TW from './tailwindhelpers';
import Alpine from 'alpinejs';
import Swiper, { Navigation, Autoplay, Mousewheel } from 'swiper';

// Init Alpine
Alpine.start();
window.Alpine = Alpine;

// Make Tailwind config available outside of package
window.TW = TW;

// Initialize all swipers
// 'SwipersConfig' is defined in 'head.php', every swiper block adds its config in it.
var Swipers = {};
for (sel in SwipersConfig) {
	Swipers[sel] = new Swiper(`${sel}  .swiper-container`, {
		// include modules
		...{ modules: [Navigation, Autoplay, Mousewheel] },
		// enable mouse-wheel by default
		...{ mousewheel: { forceToAxis: true } },
		// include swiper-specific config
		...SwipersConfig[sel],
	});
}
window.Swipers = Swipers;
