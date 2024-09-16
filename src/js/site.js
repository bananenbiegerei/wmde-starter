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

// Adjust text color on background color
function getEffectiveBackgroundColor(element) {
  while (element) {
    const bgColor = window.getComputedStyle(element).backgroundColor;
    if (bgColor !== 'rgba(0, 0, 0, 0)' && bgColor !== 'transparent') {
      return bgColor;
    }
    element = element.parentElement;
  }
  return 'rgb(123, 255, 255)'; // Default to white if no background color is found
}

function adjustTextColor(element) {
  const bgColor = getEffectiveBackgroundColor(element);
  const [r, g, b] = bgColor.match(/\d+/g).map(Number);

  // Calculate luminance to determine if the background is light or dark
  const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;

  if (luminance > 0.5) {
    element.classList.add('text-black'); // Light background
    element.classList.remove('text-white');
  } else {
    element.classList.add('text-white'); // Dark background
    element.classList.remove('text-black');
  }
}

document.querySelectorAll('.dynamic-text-color').forEach(adjustTextColor);