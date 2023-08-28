</main>
<footer class="bg-white text-primary mt-36 site-footer" aria-labelledby="footer-heading">
  <h2 id="footer-heading" class="sr-only">Footer</h2>
  <div class="border-t-2 border-b border-b-gray-200 py-8 mb-12 lg:mb-0">
  <div class="container grid grid-cols-1 sm:grid-cols-2 md:flex md:flex-wrap gap-10 xl:gap-20">
    <div class="md:flex-none">
    <?php get_template_part("template-parts/social-media-menu"); ?>
    </div>
    <?php /*
  <div  class="flex-none">
  <?php //get_template_part("template-parts/newsletter-signup-form-minimal"); ?>
  </div>
  */ ?>
  <?php if(get_field('kontakt_spendenservice', 'option')): ?>
  <div class="md:flex-none font-alt">
    <h3 class="text-base text-primary"><?= _e('Spendenservice', BB_TEXT_DOMAIN) ?></h3>
    <?php the_field('kontakt_spendenservice', 'option'); ?>
  </div>
  <?php endif; ?>
  <?php if(get_field('kontakt', 'option')): ?>
  <div class="md:flex-none font-alt">
    <h3 class="text-base text-primary"><?= _e('Kontakt', BB_TEXT_DOMAIN) ?></h3>
    <?php the_field('kontakt', 'option'); ?>
  </div>
  <?php endif; ?>
  <div class="md:flex-1 flex justify-start xl:justify-end items-start">
    <?php echo shortcode_exists('cookie_settings') ? do_shortcode('[cookie_settings]') : ''; ?>
  </div>
  </div>
  </div>
  <div class="container lg:flex lg:items-center lg:h-24">
  <div class="lg:flex-1">
    <?php bb_wp_nav_menu(['container' => 'nav', 'menu' => 'footer', 'menu_class' => 'flex flex-col md:flex-row gap-5', 'theme_location' => 'footer']); ?>
  </div>
  <div class="lg:flex-none py-12 lg:py-0">
    <h3 class="mb-0 text-base">Wir befreien Wissen</h3>
  </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>