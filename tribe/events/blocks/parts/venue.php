<?php
/**
 * Venue template part for the Event Venue block
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/blocks/parts/venue.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.1
 *
 */

if ( ! tribe_get_venue_id() ) {
	return;
}
$attributes = $this->get( 'attributes', [] );

$phone   = tribe_get_phone();
$website = tribe_get_venue_website_link();

?>

<div class="tribe-block__venue__meta bg-gray rounded p-5 h-full">
	<h3>Ort</h3>
	<div class="">
		<div class="tribe-block__venue__name">
			<h3><?php echo tribe_get_venue_link() ?></h3>
		</div>
		
		<?php do_action( 'tribe_events_single_meta_venue_section_start' ) ?>
		
		<?php if ( tribe_address_exists() ) : ?>
			<address class="tribe-block__venue__address">
				
				<?php
				$full_address = tribe_get_full_address(); // Get the full address
				
				// Split the full address into parts based on the comma (assuming the standard format "Street, City, State Zip")
				$address_parts = explode(',', $full_address);
				
				// Check if we have at least three parts (city, state, and zip)
				if (count($address_parts) >= 3) {
					$zip_state = trim(array_pop($address_parts)); // Get the last part as zip code and state
					$city = trim(array_shift($address_parts)); // Get the first part as city
					$state_zip_parts = explode(' ', $zip_state); // Split zip code and state
					$zip_code = trim($state_zip_parts[0]); // Get the zip code
					$state = trim($state_zip_parts[1]); // Get the state
				
					// Output the zip code, state, city
					echo $zip_code;
					echo $state;
					echo $city;
				} else {
					// If there are less than three parts, just output the original full address
					echo $full_address;
				}
				?>


				
				<?php //echo tribe_get_full_address(); ?>
		
				<?php if ( tribe_show_google_map_link() ) : ?>
					<?php echo tribe_get_map_link_html(); ?>
				<?php endif; ?>
			</address>
		<?php endif; ?>
		
		<?php if ( ! empty( $phone ) ) : ?>
			<span class="tribe-block__venue__phone"><?php echo $phone ?></span><br />
		<?php endif ?>
		
		<?php if ( ! empty( $website ) ) : ?>
			<span class="tribe-block__venue__website"><?php echo $website ?></span><br />
		<?php endif ?>
		
		<?php do_action( 'tribe_events_single_meta_venue_section_end' ) ?>
	</div>
</div>
