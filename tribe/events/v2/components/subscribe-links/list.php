<?php
/**
 * Component: Subscribe To Calendar List
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/components/subscribe-links/list.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.12.0
 *
 * @var array<Tribe\Events\Views\V2\iCalendar\Links\Link_Abstract> $items Array containing subscribe/export objects.
 *
 */
if ( empty( $items ) ) {
	return;
}
?>
<div class="tribe-events-c-subscribe-dropdown__container">
	<div class="">
		<div class="text-neutral-500 !mb-2" tabindex="0">
			<?php echo esc_html__( 'Subscribe to calendar', 'the-events-calendar' ); ?>
		</div>
		<div class="">
			<ul class="" tabindex="0">
				<?php foreach ( $items as $item ) : ?>
					<?php $this->template( 'components/subscribe-links/item', [ 'item' => $item ] ); ?>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>
