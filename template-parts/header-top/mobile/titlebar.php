<?php
$titlebar_color = bb_get_component_color('titlebar_color');
?>
<script>
// Store mobile menu status in Alpine.store
document.addEventListener('alpine:init', () => {
  Alpine.store('open_mobile_nav', false);
});

document.addEventListener('alpine:init', () => {
  Alpine.data('navMenuMobileToggle', () => ({
  init() {},
  toggleNav() {
    // Make body unscrollable when menu is open
    var overflow = document.querySelector('body').style.overflow;
    document.querySelector('body').style.overflow = overflow == 'hidden' ? 'scroll' : 'hidden';
  }
  }))
});
</script>

<header aria-hidden="true" tabindex='-1' id="titlebar_mobile" class="flex <?= $titlebar_color['class']; ?> h-14 items-center py-1 px-5 left-0 right-0 fixed  border-b border-neutral z-40  md:hidden nohover:flex" <?php if ($titlebar_color['style']): ?>style="<?= $titlebar_color['style']; ?>"<?php endif; ?>>
  <?php get_template_part('template-parts/header-top/titlebar_content'); ?>
  <div class="flex-none block" x-data="navMenuMobileToggle">
  <!-- Using the Alpine.store ($store) to save the state of the site header. -->
  <button class="text-white btn btn-ghost btn-lg btn-icon" x-on:click="$store.open_mobile_nav = ! $store.open_mobile_nav; toggleNav()">
    <?= bb_icon('menu-alt-2', '') ?>
  </button>
  </div>

</header>