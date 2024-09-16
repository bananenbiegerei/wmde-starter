//import * as TW from './tailwindhelpers';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import Swiper, { Navigation, Autoplay, Pagination, Mousewheel } from 'swiper';

// Init Alpine
window.Alpine = Alpine;
Alpine.plugin(focus);
Alpine.start();

// Make Tailwind config available outside of package
//window.TW = TW;

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

// Adjust text color of dynamic buttons based on background color
function adjustTextColor(button) {
    const bgColor = window.getComputedStyle(button).backgroundColor;
    const [r, g, b] = bgColor.match(/\d+/g).map(Number);

    // Calculate luminance to determine if the background is light or dark
    const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;

    if (luminance > 0.5) {
      button.style.color = 'black'; // Light background
    } else {
      button.style.color = 'white'; // Dark background
    }
  }

  document.querySelectorAll('.dynamic-text-color').forEach(adjustTextColor);