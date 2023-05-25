<!DOCTYPE html>
<html <?php language_attributes(); ?> class="h-full no-js" data-theme="wmde">
<?php get_template_part('head'); ?>
<body <?php body_class('flex flex-col min-h-screen'); ?>>
  <?php get_template_part('template-parts/header-top/main'); ?>
  <main class="main-content flex-grow pt-12 lg:pt-0 overflow-hidden">
  <?php
  if (is_front_page()) { ?>
    <h1 class="sr-only">
      <?php
      $site_title = get_bloginfo('name');
      echo $site_title;
      ?>
    </h1>
  <?php } else { ?> 
  <?php }
  ?>
