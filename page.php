<?php get_header(); ?>
<?php while (have_posts()): ?>
<?php the_post(); ?>
<div class="mt-10 outer-container">
    <div class="bb-container-default rounded-t-xl">
        <h1 class="my-5"><?php the_title(); ?></h1>
        <?php if (has_excerpt()): ?>
        <div class="mb-10 text-xl font-normal lg:text-2xl">
            <?php echo strip_tags(get_the_excerpt()); ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<div class="content">
    <?php the_content(); ?>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>