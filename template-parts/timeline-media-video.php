<?php if ( have_rows( 'video_posts' ) ) : ?>
    <div class="bg-lime-500 flex flex-col space-y-4">
<?php while ( have_rows( 'video_posts' ) ) : the_row(); ?>
<div>
<?php the_sub_field( 'video_title' ); ?>
<?php $video = get_sub_field( 'video' ); ?>
<?php if ( $video ) : ?>
<video class="w-full h-auto max-w-full" controls>
    <source src="<?php echo esc_url( $video['url'] ); ?>" type="video/mp4">
    Your browser does not support the video tag.
</video>
<?php endif; ?>
</div>
<?php endwhile; ?>
</div>
<?php endif; ?>