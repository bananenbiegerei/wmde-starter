<?php if ( have_rows( 'audio_posts' ) ) : ?>
<div class="border bg-white rounded-lg p-2">
    <h3 class="mb-0 h5 sr-only"><?php _e('Audio Beitrag', BB_TEXT_DOMAIN); ?></h3>
    <div class="flex flex-col divide-y divide-gray-400">
        <?php while ( have_rows( 'audio_posts' ) ) : the_row(); ?>
        <div class="py-4">
            <div class="flex gap-2 mb-2">
                <?php $audio_source_image = get_sub_field( 'audio_source_image' ); ?>
                <?php if ( $audio_source_image ) : ?>
                <div class="basis-1/3">
                    <img class="h-auto w-full rounded-full" src="<?php echo esc_url( $audio_source_image['url'] ); ?>"
                        alt="<?php echo esc_attr( $audio_source_image['alt'] ); ?>" />
                </div>
                <?php endif; ?>
                <div class="basis-2/3">
                <p class="mb-0"><?php the_sub_field( 'audio_source_text' ); ?></p>
                <?php if ( $audio_source_image ) : ?>
                        <p class="text-xs"><?php echo esc_html( $audio_source_image['description'] ); ?></p>
                <?php endif; ?>
                </div>
            </div>
            <?php if ( get_sub_field( 'audio_file' ) ) : ?>
            <audio class="w-full" controls>
                <source src="<?php the_sub_field( 'audio_file' ); ?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            <?php endif; ?>
        </div>
        <?php endwhile; ?>
    </div>
</div>
<?php endif; ?>