<div
    class="px-5 lg:px-5 pb-16 rounded-bl-xl rounded-br-xl bg-gray-light mb-10 h-auto lg:h-[30rem] rounded-bl-xl rounded-br-xl overflow-hidden relative text-white">
    <div class="container p-10 grid grid-cols-12">
        <div class="self-end col-span-12 lg:col-span-8">
            <h1 class="z-10 relative"><?php the_title(); ?></h1>
            <?php if (has_excerpt()): ?>
            <div class="font-alt text-xl lg:text-2xl font-normal mb-5">
                <?php the_excerpt(); ?>
            </div>
            <?php endif; ?>
            <?php
/* if (have_rows('call_to_actions_in_header')): ?>
            <div class="btn-group">
                <?php while (have_rows('call_to_actions_in_header')):
                	the_row(); ?>
                <?php $cta_link = get_sub_field('cta_link'); ?>
                <?php if ($cta_link): ?>
                <a class="btn " href="<?php echo esc_url($cta_link['url']); ?>"
                    target="<?php echo esc_attr($cta_link['target']); ?>">
                    <?= bb_icon('arrow-right', 'icon-base') ?>
                    <?php echo esc_html($cta_link['title']); ?></a>
                <?php endif; ?>
                <?php
                endwhile; ?>
            </div>
            <?php endif; */
?>
        </div>
    </div>
    <?php if (has_post_thumbnail()) { ?>
    <div class="absolute top-0 left-0 w-full h-full -z-10">
        <?php the_post_thumbnail('full', ['class' => '-mb-10 object-cover h-full w-full']); ?>
    </div>
    <?php } ?>
</div>
<?php get_template_part('template-parts/anchor-nav'); ?>
