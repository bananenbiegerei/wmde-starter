<div>
    <h3 class="h5"><?php _e('Video Beitrag', BB_TEXT_DOMAIN); ?></h3>
    <video class="w-full h-auto max-w-full" controls>
        <source src="<?php echo esc_url($video['url']); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>