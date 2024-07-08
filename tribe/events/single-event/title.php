<?php
/**
 * Single Event Title Template Part
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/single-event/title.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 4.7.2
 *
 */
?>
<p class="topline mt-5 mb-0"><?php _e('Veranstaltung', BB_TEXT_DOMAIN); ?></p>
<?php the_title( '<h1 class="text-2xl lg:text-5xl mb-2">', '</h1>' );