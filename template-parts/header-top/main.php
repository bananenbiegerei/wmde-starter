<?php $WPNav = json_encode(bb_get_nav_menu()); ?>

<script>
  // Get current page ID (used to set 'current' class to menu item)
  const pageID = <?php echo get_the_ID() ?: 'null' ?>;
  // Get content of top-nav menu
  const WPNav = JSON.parse('<?= $WPNav ?>');
  // Default icon when featured page thumbnail is missing
  const defaultIcon = "<?= get_stylesheet_directory_uri() ?>/img/placeholders/wiki-logo-icon.png";
</script>
<header role="banner" class="container flex">
  <a href="#main-content" class="sr-only focus:not-sr-only m-2"><?= __('Skip to Content', BB_TEXT_DOMAIN) ?></a>
</header>
<?php get_template_part('template-parts/header-top/mobile/titlebar'); ?>
<?php get_template_part('template-parts/header-top/mobile/navmenu'); ?>
<?php get_template_part('template-parts/header-top/desktop/titlebar'); ?>
<?php get_template_part('template-parts/header-top/desktop/navmenu'); ?>