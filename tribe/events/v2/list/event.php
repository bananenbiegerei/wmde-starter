<?php
/**
 * View: List Event
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

$container_classes = [ 'mb-20' ];
$container_classes['tribe-events-calendar-list__event-row--featured'] = $event->featured;

$event_classes = tribe_get_post_class( [ 'tribe-events-calendar-list__event' ], $event->ID );
?>
<div <?php tribe_classes( $container_classes ); ?>>

	<?php // $this->template( 'list/event/date-tag', [ 'event' => $event ] ); ?>
	<div class="image-hover-effect">
		
		<article <?php tribe_classes( $event_classes ) ?>>
			<?php 
			if (! $event->thumbnail->exists) { ?>
				<div class="">
					<header class="">
						<?php $this->template( 'list/event/date', [ 'event' => $event ] ); ?>
						<?php $this->template( 'list/event/title', [ 'event' => $event ] ); ?>
						<?php $this->template( 'list/event/venue', [ 'event' => $event ] ); ?>
					</header>
					<?php // $this->template( 'list/event/description', [ 'event' => $event ] ); ?>
					<?php $this->template( 'list/event/cost', [ 'event' => $event ] ); ?>
				</div>
			<?php }
			if ($event->thumbnail->exists) { ?>
				<div class="lg:grid lg:grid-cols-12 lg:gap-10">
					<div class="lg:col-span-4">
						<?php
						$this->template( 'list/event/featured-image', [ 'event' => $event ] );
						?>
					</div>
					<div class="lg:col-span-8">
						<header class="">
							<?php $this->template( 'list/event/date', [ 'event' => $event ] ); ?>
							<?php $this->template( 'list/event/title', [ 'event' => $event ] ); ?>
							<?php $this->template( 'list/event/venue', [ 'event' => $event ] ); ?>
						</header>
						<?php // $this->template( 'list/event/description', [ 'event' => $event ] ); ?>
						<?php $this->template( 'list/event/cost', [ 'event' => $event ] ); ?>
					</div>
				</div>
			<?php }
			?>
		</article>
	</div>
</div>
