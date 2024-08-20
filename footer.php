</main>
<footer class="bg-white text-primary mt-36 site-footer" role="contentinfo" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="border-t-2 border-b border-b-neutral-light py-8 mb-12 lg:mb-0">
        <div class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 xl:gap-20">
            <?php if ( get_field('social_media_links', 'option') ) : ?>
                <div>
                    <?php get_template_part('template-parts/social-media-menu'); ?>
                </div>
            <?php endif; ?>
            <?php if ( have_rows( 'contacts', 'option' ) ) : ?>
            <?php while ( have_rows( 'contacts', 'option' ) ) : the_row(); ?>
            <div>
                <?php the_sub_field( 'contact_column' ); ?>
            </div>
            <?php endwhile; ?>
            <?php else : ?>
            <?php // No rows found ?>
            <?php endif; ?>


            <?php if ( get_field( 'show_wikimedia_newsletter_signup_form', 'option' ) == 1 ) : ?>
            <div class="flex-1">
                <?php get_template_part('template-parts/newsletter-signup-form-minimal'); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="container lg:flex lg:items-center lg:h-24">
        <?php if (has_nav_menu('footer')): ?>
        <div class="lg:flex-1">
            <?php bb_wp_nav_menu(['container' => 'nav', 'menu' => 'footer', 'menu_class' => 'flex flex-col md:flex-row gap-5', 'theme_location' => 'footer']); ?>
        </div>
        <?php else: ?>
        <div class="border-2 my-2 border-error border-dotted rounded-2xl p-4">
            <h3>
                <?php _e('Kein Footer-Menü zugewiesen!', BB_TEXT_DOMAIN); ?>
                TBD
            </h3>
            <a class="btn btn-error" href="<?php echo admin_url('nav-menus.php'); ?>">
                <?php _e('Menüs bearbeiten', BB_TEXT_DOMAIN); ?>
            </a>
        </div>
        <?php endif; ?>
        <div class="">
            <h3 class="mb-0 text-base"><?php _e('Wir befreien Wissen', BB_TEXT_DOMAIN); ?></h3>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>