<!DOCTYPE html>
<html <?php language_attributes(); ?> class="h-full no-js" data-theme="wmde">
<?php get_template_part('head'); ?>
<?php
$site_title = get_bloginfo('name');
$site_url = network_site_url('/');
$site_description = get_bloginfo('description');

//echo 'The Network Home URL is: ' . $site_url;
//echo 'The Network Home Name is: ' . $site_title;
//echo 'The Network Home Tagline is: ' . $site_description;
?>
<body <?php body_class(); ?>>
    <?php get_template_part('template-parts/navbar'); ?>
    <main class="main-content min-h-screen">
