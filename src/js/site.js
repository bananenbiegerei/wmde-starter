import * as TW from './tailwindhelpers';
import Alpine from 'alpinejs';
import Swiper, { Navigation, Autoplay } from 'swiper';

window.Alpine = Alpine;
Alpine.start();

// Make Tailwind config available
window.TW = TW;

// Initialize all swipers
// Variable 'Swipers' is defined in 'head.php', every swiper block adds its config in it.
var Swipers = {};
for (sel in SwipersConfig) {
	console.log('Swiper init: ' + sel);
	Swipers[sel] = new Swiper(`${sel}  .swiper-container`, { ...SwipersConfig[sel], ...{ modules: [Navigation, Autoplay] } });
}
window.Swipers = Swipers;
