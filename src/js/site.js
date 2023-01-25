import * as TW from './tailwindhelpers';

import Alpine from 'alpinejs';
import Swiper, { Navigation, Pagination, Keyboard, Autoplay, EffectFade, Thumbs } from 'swiper';

import * as Accordion from './bb-blocks/accordion';

window.Alpine = Alpine;
Alpine.start();

// Tests
Accordion.test();
console.log(TW.fullConfig);
