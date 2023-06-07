<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = Tribe__Events__Main::postIdHelper( get_the_ID() );

/**
 * Allows filtering of the event ID.
 *
 * @since 6.0.1
 *
 * @param int $event_id
 */
$event_id = apply_filters( 'tec_events_single_event_id', $event_id );

/**
 * Allows filtering of the single event template title classes.
 *
 * @since 5.8.0
 *
 * @param array  $title_classes List of classes to create the class string from.
 * @param string $event_id The ID of the displayed event.
 */
$title_classes = apply_filters( 'tribe_events_single_event_title_classes', [ 'tribe-events-single-event-title' ], $event_id );
$title_classes = implode( ' ', tribe_get_classes( $title_classes ) );

/**
 * Allows filtering of the single event template title before HTML.
 *
 * @since 5.8.0
 *
 * @param string $before HTML string to display before the title text.
 * @param string $event_id The ID of the displayed event.
 */
$before = apply_filters( 'tribe_events_single_event_title_html_before', '<h1 class="mb-10 ' . $title_classes . '">', $event_id );

/**
 * Allows filtering of the single event template title after HTML.
 *
 * @since 5.8.0
 *
 * @param string $after HTML string to display after the title text.
 * @param string $event_id The ID of the displayed event.
 */
$after = apply_filters( 'tribe_events_single_event_title_html_after', '</h1>', $event_id );

/**
 * Allows filtering of the single event template title HTML.
 *
 * @since 5.8.0
 *
 * @param string $after HTML string to display. Return an empty string to not display the title.
 * @param string $event_id The ID of the displayed event.
 */
$title = apply_filters( 'tribe_events_single_event_title_html', the_title( $before, $after, false ), $event_id );
$cost  = tribe_get_formatted_cost( $event_id );

?>

<div id="tribe-events-content">
	<div class="bg-gray min-h-[12rem] pt-5 pb-10">
		<div class="container lg:grid lg:grid-cols-12 lg:gap-5">
			<div class="col-span-12">
				<div class="mb-5">
					<a class="!no-underline text-sm font-normal" href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '&laquo; ' . esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' ), $events_label_plural ); ?></a>
				</div>

				
				<!-- Notices -->
				<?php tribe_the_notices() ?>

				<?php echo $title; ?>
				
				<div class="grid grid-cols-2 gap-10">
					<div>
						<div class="mt-2">
							<?php echo tribe_events_event_schedule_details( $event_id, '<h2 class="font-normal text-2xl">', '</h2>' ); ?>
							<?php if ( ! empty( $cost ) ) : ?>
							<p class="text-2xl"><?php echo esc_html( $cost ) ?></p>
							<?php endif; ?>
						</div>
						<?php /* 
						<!-- Event header -->
						<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
							<!-- Navigation -->
							<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
								<ul class="tribe-events-sub-nav">
									<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
									<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
								</ul>
								<!-- .tribe-events-sub-nav -->
							</nav>
						</div>
						<!-- #tribe-events-header -->
						*/ ?>
						<div>
							<?php while ( have_posts() ) :  the_post(); ?>
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							
								<!-- Event content -->
								<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
								<div class="tribe-events-single-event-description tribe-events-content">
									<?php echo get_the_excerpt(); ?>
								</div>
								<!-- .tribe-events-single-event-description -->
								<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
							
							</div> <!-- #post-x -->
							<?php endwhile; ?>
						</div>
					</div>
					<div>
						<div class="rounded-3xl overflow-hidden">
							<!-- Event featured image, but exclude link -->
							<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php while ( have_posts() ) :  the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('mt-10'); ?>>
		<div class="container lg:grid lg:grid-cols-12 lg:gap-5">
			<div class="lg:col-span-8">
				<!-- Event content -->
				<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
				<div class="tribe-events-single-event-description tribe-events-content">
					<?php the_content(); ?>
				</div>
				<!-- .tribe-events-single-event-description -->
				<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
				
				<!-- Event meta -->
				<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
				<?php tribe_get_template_part( 'modules/meta' ); ?>
				<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
			</div>
			<div class="lg:col-span-4">
				<!-- Event footer -->
				<div id="tribe-events-footer">
					<!-- Navigation -->
					<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
						<ul class="flex flex-col gap-5">
							<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
							<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
						</ul>
						<!-- .tribe-events-sub-nav -->
					</nav>
				</div>
				<!-- #tribe-events-footer -->
			</div>
		</div>
		
	</div> <!-- #post-x -->
	<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>

</div><!-- #tribe-events-content -->