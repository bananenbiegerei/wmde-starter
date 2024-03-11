<?php get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>
<div id="swup">
    <div class="fixed top-0 left-0 w-full h-full z-40 content" id="swup-modal">
        <div class="relative h-full w-full p-10">
            <a class="block absolute top-0 left-0 w-full h-full bg-black bg-opacity-60" href="/timeline/"></a>
            <div
                class="relative max-w-7xl h-specialscreen overflow-auto mx-auto z-10 bg-white border-4 border-black p-6">
                <a class="btn btn-ghost absolute top-2 right-2" href="/timeline/"><?php _e('Close', BB_TEXT_DOMAIN); ?>
                    <?= bb_icon('x', 'icon-xs') ?></a>
                <?php if (get_field('date')): ?>
                <time><?php the_field('date'); ?></time>
                <?php endif; ?>
                <h1><?php the_title(); ?></h1>
                <div class="no-container-styles">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>
