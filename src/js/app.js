import Alpine from 'alpinejs'
import Swiper, {
  Navigation,
  Pagination,
  Keyboard,
  Autoplay,
  EffectFade,
  Thumbs,
} from 'swiper';

window.Alpine = Alpine;
Alpine.start();

// configure Swiper to use modules
Swiper.use([Navigation, Pagination, Keyboard, Autoplay, EffectFade, Thumbs]);
