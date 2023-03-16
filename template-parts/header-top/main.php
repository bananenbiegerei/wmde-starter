<script>
// Get current page ID (used to set 'current' class to menu item)
const pageID = <?php echo get_the_ID(); ?>;
// Get content of top-nav menu
var WPNav = JSON.parse('<?php echo json_encode(bb_get_nav_menu()); ?>');
// Default icon when featured page thumbnail is missing
const defaultIcon = "<?php echo get_stylesheet_directory_uri(); ?>/img/placeholders/wiki-logo-icon.png";
</script>
<?php get_template_part('template-parts/header-top/mobile/titlebar'); ?>
<?php get_template_part('template-parts/header-top/mobile/navmenu'); ?>
<?php get_template_part('template-parts/header-top/desktop/titlebar'); ?>
<?php get_template_part('template-parts/header-top/desktop/navmenu'); ?>
