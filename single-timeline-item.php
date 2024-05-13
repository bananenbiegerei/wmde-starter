<?php get_header(); ?>
<?php while (have_posts()):
	the_post(); ?>
<?php
$date = get_field('date');
$color = get_field('custom_color');
?>
<div id="swup">
    <div class="fixed top-0 left-0 w-full h-full z-40 content" id="swup-modal">
        <div class="relative h-full w-full p-10">
            <a class="block absolute top-0 left-0 w-full h-full bg-black bg-opacity-60" href="/timeline/"></a>
            <div class="relative max-w-7xl h-specialscreen overflow-auto mx-auto z-10 bg-white border-4 border-black p-6 bg-wmde20-<?= $color ?>">
                <div class="absolute top-2 right-2">
                  <a onclick="cardSwipe(-1)" class="btn btn-ghost"><?= bb_icon('arrow-left', 'icon-s') ?></a>
                  <a onclick="cardSwipe(1)" class="btn btn-ghost"><?= bb_icon('arrow-right', 'icon-s') ?></a>
                  <a class="btn btn-ghost" href="/timeline/"><?= bb_icon('x', 'icon-s') ?></a>
                </div>
                <?php if ($date): ?>
                <time><?= $date ?></time>
                <?php endif; ?>
                <h1><?php the_title(); ?></h1>
                <div class="no-container-styles">
                    <div class="flex gap-4 ">
                        <div class="no-container-styles basis-2/3">
                            <?php the_content(); ?>
                        </div>
                        <div class="basis-1/3 flex flex-col space-y-8">
                            <?php include locate_template('template-parts/timeline-media-video.php'); ?>
                            <?php include locate_template('template-parts/timeline-media-audio.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
endwhile; ?>
<?php get_footer(); ?>
