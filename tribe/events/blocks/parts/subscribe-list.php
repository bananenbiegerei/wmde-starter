<?php
/**
 * Subscribe Dropdown Part.
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/blocks/parts/subscribe-list.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @link    http://evnt.is/1aiy
 *
 * @version 5.16.0
 *
 * @var array<Tribe\Events\Views\V2\iCalendar\Links\Link_Abstract> $items Array containing subscribe/export objects.
 *
 */
if ( empty( $items ) ) {
	return;
}

remove_filter( 'the_content', 'do_blocks', 9 );
?>
	<div class="tribe-block tribe-block__events-link p-0 bg-neutral rounded p-5 h-full">
		<p class="font-medium font-alt mb-2"><?php _e('Zum Kalender hinzufügen', BB_TEXT_DOMAIN); ?></p>
		<ul class="text-base w-full" tabindex="0">
			<?php foreach ( $items as $item ) : ?>
				<li class="tribe-events-c-subscribe-dropdown__list-item">
					<a
						href="<?php echo esc_url( $item->get_uri( null ) ); ?>"
						class="tribe-events-c-subscribe-dropdown__list-item-link"
						tabindex="0"
						target="_blank"
						rel="noopener noreferrer nofollow noindex"
					>
						<?php echo esc_html( $item->get_label( null ) ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

<?php add_filter( 'the_content', 'do_blocks', 9 );
