<div class="border rounded-lg p-2">
    <h3 class="mb-0 h5 sr-only"><?php _e('Audio Beitrag', BB_TEXT_DOMAIN); ?></h3>
    <?php if (!empty($audio_file)): ?>
    <audio controls class="w-full mb-2">
        <source src="<?php echo esc_url($audio_file); ?>" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <?php endif; ?>
    <div class="flex gap-3 items-center mb-2"><?php if ($audio_text): ?>
        <strong> <?php echo $audio_text; ?></strong>
        <?php endif; ?>

        <?php if ($audio_image): ?>
        <?php
        $image_attributes = wp_get_attachment_image_src($audio_image['ID'], 'thumbnail');
        if ($image_attributes): ?>
        <img class="rounded-full w-10 h-10" src="<?php echo esc_url($image_attributes[0]); ?>"
            alt="<?php echo esc_attr($audio_image['alt']); ?>">
        <?php endif;
        ?>
        <?php endif; ?>
    </div>
</div>