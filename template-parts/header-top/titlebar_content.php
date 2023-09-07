<?php
$home_url = is_home() ? 'https://www.wikimedia.de/' : get_home_url();
$logo_big = esc_attr(get_field('logo_big', 'options') ?: get_stylesheet_directory_uri() . "/img/wikimedia-logo.svg");
$logo_small = esc_attr(get_field('logo_small', 'options') ?: get_stylesheet_directory_uri() . "/img/wikimedia-logo-mini.svg");
?>


<header class="flex w-full items-center">
  <div>
  <a href="<?= $home_url ?>" class="hidden md:block" aria-labelledby="site-name and link to homepage">
    <img class="logo" style="max-height: 41px" src="<?= $logo_big ?>" alt="Logo" aria-labelledby="site logo">
  </a>
  <a href="<?= $home_url ?>" class="block md:hidden" aria-labelledby="site-name and link to homepage">
    <img style="max-height: 41px" src="<?= $logo_small ?>" alt="Logo" aria-labelledby="site logo">
  </a>
  </div>

  <div class="flex justify-end grow gap-5">
  <ul class="flex items-center space-x-2 md:space-x-5 mb-0">
    <?php if (get_field('link_fur_spenden', 'options')): ?>
    <li>
    <a class="btn btn-red btn-hollow btn-sm btn-icon-left" href="<?php echo esc_url(get_field('link_fur_spenden', 'option')); ?>">
      <?= bb_icon('heart', 'heartbeat icon-sm') ?>
      <?php _e('donate', BB_TEXT_DOMAIN); ?>
    </a>
    </li>
    <?php endif; ?>
    <?php if (get_field('link_fur_mitmachen', 'options')): ?>
    <li class="hidden md:block">
    <a class="btn btn-ghost btn-sm" href="<?php echo esc_url(get_field('link_fur_mitmachen', 'option')); ?>">
      <?php _e('Mitmachen', BB_TEXT_DOMAIN); ?>
    </a>
    </li>
    <?php endif; ?>
  </ul>
  </div>

</header>