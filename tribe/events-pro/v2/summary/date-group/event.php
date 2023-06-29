<?php
/**
 * View: Summary Event
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events-pro/v2/summary/date-group/event.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.7.0
 *
 * @var WP_Post                          $event      The event post object with properties added by the `tribe_get_event` function.
 * @var \Tribe\Utils\Date_I18n_Immutable $group_date The date for the date group.
 *
 * @see tribe_get_event() For the format of the event object.
 */

$event_classes = tribe_get_post_class( [ '', '', '' ], $event->ID );
$event_classes['tribe-events-pro-summary__event-row--featured'] = $event->featured;
?>
<article <?php tribe_classes( $event_classes ) ?>>

	<div class="">

		<header class="">
            <?php get_template_part("tribe/events/v2/components/tribe-cats"); ?>
            <?php $this->template( 'summary/date-group/event/title', [ 'event' => $event ] ); ?>
			<?php $this->template( 'summary/date-group/event/date', [ 'event' => $event, 'group_date' => $group_date ] ); ?>
		</header>

	</div>
</article>
