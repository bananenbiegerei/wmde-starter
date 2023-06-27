<?php
/**
 * Single Event Template
 *
 * A single event complete template, divided in smaller template parts.
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/single-event-blocks.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 4.7
 *
 */

$event_id = $this->get( 'post_id' );

$is_recurring = '';

if ( ! empty( $event_id ) && function_exists( 'tribe_is_recurring_event' ) ) {
	$is_recurring = tribe_is_recurring_event( $event_id );
}
?>
<div id="tribe-events-content" class="tribe-events-single tribe-blocks-editor">
    <div class="bg-gray min-h-[12rem] pt-5 pb-10 pt-5">
          <div class="container lg:grid lg:grid-cols-12 lg:gap-10">
                <div class="col-span-12 lg:col-span-10">
                  <?php $this->template( 'single-event/back-link' ); ?>
                  <?php $this->template( 'single-event/title' ); ?>
                  <?php $this->template( 'single-event/notices' ); ?>
                    <?php /* if ( $is_recurring ) { ?>
                        <?php $this->template( 'single-event/recurring-description' ); ?>
                    <?php } */ ?>
                    <?php if (has_excerpt()): ?>
                      <div class="font-alt text-xl lg:text-2xl font-normal mb-10">
                        <?php echo strip_tags(get_the_excerpt()); ?>
                      </div>
                    <?php endif; ?>
                </div>
                <div class="lg:col-span-6">
                    <?php echo tribe_events_event_schedule_details( $event_id, '<h2 class="font-normal text-2xl">', '</h2>' ); ?>
                    <?php if ( ! empty( $cost ) ) : ?>
                    <p class="text-2xl"><?php echo esc_html( $cost ) ?></p>
                    <?php endif; ?>
                    <?php while ( have_posts() ) :  the_post(); ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                        <!-- Event content -->
                        <?php do_action( 'tribe_events_single_event_before_the_content' ); ?>
                        <div class="tribe-events-single-event-description tribe-events-content">
                            <?php
                                $excerpt = get_the_excerpt();
                                $excerpt = wp_trim_words( $excerpt, 99 ); // Set your desired length here
                                echo $excerpt;
                            ?>
                        </div>
                        <!-- .tribe-events-single-event-description -->
                        <?php do_action( 'tribe_events_single_event_after_the_content' ); ?>


                    
                    </div> <!-- #post-x -->
                    <?php endwhile; ?>
                </div>
                <div class="lg:col-span-6">
                    <?php get_template_part('template-parts/featured-image-rounded'); ?>
                </div>
          </div>
      </div>
      
      <?php while (have_posts()): ?>
      <?php the_post(); ?>
          <div class="content pt-10">
              <?php the_content(); ?>
          </div>
      <?php endwhile; ?>
	
	<?php //$this->template( 'single-event/comments' ); ?>
	<?php // $this->template( 'single-event/footer' ); ?>
</div>
