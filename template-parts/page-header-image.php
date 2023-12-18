<div class="px-5 lg:px-5 pb-16 rounded-bl-xl rounded-br-xl bg-gray-light mb-10">
    <div
        class="contianer h-auto lg:h-[30rem] bg-gradient-to-r from-primary to-secondary rounded-bl-xl rounded-br-xl p-10 grid grid-cols-12">
        <div class="col-span-12">
            <a href="<?php echo get_bloginfo('url'); ?>">
                <img class="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/src/img/wikimove-logo.png"
                    alt="Logo">
            </a>
        </div>
        <div class="self-end col-span-12 lg:col-span-8">
            <h1 class="text-white"><?php the_title(); ?></h1>
            <?php if (get_field('subline')): ?>
            <p class="text-secondary"><?php the_field('subline'); ?></p>
            <?php endif; ?>
        </div>
        <?php if (has_post_thumbnail()) { ?>
        <div class="self-end col-span-12 lg:col-span-4">
            <?php the_post_thumbnail('full', ['class' => '-mb-10']); ?>
        </div>
        <?php } ?>
    </div>
    <?php if (get_field('embeded_player')): ?>
    <div class="max-w-3xl mx-auto mb-5 mt-10 bg-secondary">
        <?php the_field('embeded_player'); ?>
    </div>
    <?php endif; ?>
</div>
<?php get_template_part('template-parts/anchor-nav'); ?>
