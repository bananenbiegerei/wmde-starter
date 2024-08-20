<?php
$home_url = is_home() ? 'https://www.wikimedia.de/' : get_home_url();
$logo_big = esc_attr(get_field('logo_big', 'options') ?: get_stylesheet_directory_uri() . '/img/wikimedia-logo.svg');
$logo_small = esc_attr(get_field('logo_small', 'options') ?: get_stylesheet_directory_uri() . '/img/wikimedia-logo-mini.svg');
?>


<div class="flex w-full items-center">
    <div class="flex-1">
        <a href="<?= $home_url ?>" class="hidden md:block">
            <img class="logo" style="max-height: 41px" src="<?= $logo_big ?>" alt="Wikimedia Logo">
        </a>
        <a href="<?= $home_url ?>" class="block md:hidden">
            <img style="max-height: 41px" src="<?= $logo_small ?>" alt="Wikimedia Logo">
        </a>
    </div>

    <div class="hidden md:block">
        <?php get_template_part('template-parts/header-top/cta'); ?>
    </div>
</div>