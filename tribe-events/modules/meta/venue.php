<?php
/**
 * Single Event Meta (Venue) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/venue.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 */

if ( ! tribe_get_venue_id() ) {
	return;
}

$phone   = tribe_get_phone();
$website = tribe_get_venue_website_link();
$website_title = tribe_events_get_venue_website_title();

?>

<div class="">
	<h2 class="topline"> <?php esc_html_e( tribe_get_venue_label_singular(), 'the-events-calendar' ) ?> </h2>
	<dl class="text-xl font-normal">
		<?php do_action( 'tribe_events_single_meta_venue_section_start' ) ?>

		<dd class=""> 
		<?php
		$venue = tribe_get_venue();
		echo strip_tags( $venue );
		?>
		</dd>

		<?php if ( tribe_address_exists() ) : ?>
			<dd class="">
				<address class="">
					<?php echo tribe_get_full_address(); ?>
					<?php if ( tribe_show_google_map_link() ) : ?>
						<?php echo tribe_get_map_link_html(); ?>
					<?php endif; ?>
				</address>
			</dd>
		<?php endif; ?>

		<?php if ( ! empty( $phone ) ): ?>
			<dt class="tribe-venue-tel-label"> <?php esc_html_e( 'Phone:', 'the-events-calendar' ) ?> </dt>
			<dd class="tribe-venue-tel"> <?php echo $phone ?> </dd>
		<?php endif ?>

		<?php if ( ! empty( $website ) ): ?>
			<?php if ( ! empty( $website_title ) ): ?>
				<dt class="tribe-venue-url-label"> <?php echo esc_html( $website_title ) ?> </dt>
			<?php endif ?>
			<dd class="tribe-venue-url"> <?php echo $website ?> </dd>
		<?php endif ?>

		<?php do_action( 'tribe_events_single_meta_venue_section_end' ) ?>
	</dl>
</div>
