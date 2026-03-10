<?php
$footer_color = bb_get_component_color('footer_color');
?>
</main>
<footer class="<?= $footer_color['class']; ?> text-black mt-36 site-footer text-white" <?php if ($footer_color['style']): ?>style="<?= $footer_color['style']; ?>"<?php endif; ?> role="contentinfo" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <?php
    $has_social_links = get_field('social_media_links', 'option');
    $has_contacts = have_rows('contacts', 'option');
    $has_newsletter = get_field('show_wikimedia_newsletter_signup_form', 'option') == 1;
    ?>
    <?php if ($has_social_links || $has_contacts || $has_newsletter): ?>
    <div class="py-8 mb-12 border-t-2 lg:mb-0">
        <div class="container grid grid-cols-1 gap-6 md:grid-cols-2 xl:flex xl:flex-wrap xl:gap-20">
            <?php if ($has_social_links) : ?>
                <div>
                    <?php get_template_part('template-parts/social-media-menu'); ?>
                </div>
            <?php endif; ?>
            <?php if (have_rows('contacts', 'option')) : ?>
            <?php while (have_rows('contacts', 'option')) : the_row(); ?>
            <div class="text-white">
                <?php the_sub_field('contact_column'); ?>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>
            <?php if ($has_newsletter) : ?>
            <div class="flex-1">
                <?php get_template_part('template-parts/newsletter-signup-form-minimal'); ?>
            </div>
            <?php endif; ?>
            <?php if (class_exists('Cookie_Law_Info')): ?>
            <div>
                <a class="cli_settings_button" href="#"><?php _e('Cookie Einstellungen', BB_TEXT_DOMAIN); ?></a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="border-t border-t-neutral">
    <div class="container py-4 lg:flex lg:items-center lg:h-24">
        <?php
        $has_footer_menu = has_nav_menu('footer');
        // When syncing footer menu, check main site for menu assignment
        if (!$has_footer_menu && is_multisite() && get_current_blog_id() != 1 && get_field('sync_footer_menu', 'options')) {
            switch_to_blog(1);
            $has_footer_menu = has_nav_menu('footer');
            restore_current_blog();
        }
        ?>
        <?php if ($has_footer_menu): ?>
        <div class="lg:flex-1">
            <?php bb_wp_nav_menu(['container' => 'nav', 'menu' => 'footer', 'menu_class' => 'flex flex-col md:flex-row gap-5 text-white', 'theme_location' => 'footer']); ?>
        </div>
        <?php else: ?>
        <div class="p-4 my-2 border-2 border-dotted border-error rounded-2xl">
            <h3>
                <?php _e('Kein Footer-Menü zugewiesen!', BB_TEXT_DOMAIN); ?>
                TBD
            </h3>
            <a class="btn btn-error" href="<?php echo admin_url('nav-menus.php'); ?>">
                <?php _e('Menüs bearbeiten', BB_TEXT_DOMAIN); ?>
            </a>
        </div>
        <?php endif; ?>
        <div class="flex items-center gap-4 text-white">
            <h3 class="mb-0 text-base"><?php _e('Wir befreien Wissen', BB_TEXT_DOMAIN); ?></h3>
        </div>
    </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>