<?php get_header(); ?>
<?php while (have_posts()):
	the_post(); ?>
<?php
$date = get_field('date');
$video_title = get_field('video_title');
$video = get_field('video');
$audio_group = get_field('audio');
$color = get_field('custom_color');
$audio_file = $audio_group['audio_file'];
$audio_text = $audio_group['audio_source_text'];
$audio_image = $audio_group['audio_source_image'];
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
                    <?php if ($audio_file || $video): ?>
                    <div class="flex gap-4 ">
                        <div class="no-container-styles basis-2/3">
                            <?php the_content(); ?>
                        </div>
                        <div class="basis-1/3 flex flex-col space-y-8">
                            <?php if ($video):
                            	include locate_template('template-parts/timeline-media-video.php');
                            endif; ?>
                            <?php if ($audio_file):
                            	include locate_template('template-parts/timeline-media-audio.php');
                            endif; ?>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="no-container-styles max-w-4xl">
                        <?php the_content(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
endwhile; ?>
<?php get_footer(); ?>
