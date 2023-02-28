<?php
$placeholder = esc_url(get_template_directory_uri() . '/blocks/wikimedia-commons-media/placeholder.svg');
$image_data = bbwkc_get_media(get_field('media_url'));

if ($image_data && $image_data['type'] == 'image') {
	get_template_part('blocks/image/block', null, ['wmc_data' => $image_data, 'wide' => get_field('wide')]);
} elseif ($image_data && $image_data['type'] == 'video') {
	echo '<figure>';
	echo '<video preload="none" poster="' . $image_data['image'] . '" controls><source src="' . $image_data['media_url'] . '" type="' . $image_data['mime_type'] . '"></video>';
	echo '</figure>';
} else {
	// FIXME: set correct container for video..
	echo '<figure>';
	echo "<img src='{$placeholder}'>";
	echo '<figcaption>' . __('Error: Unsupported or missing media', BB_TEXT_DOMAIN) . '</figcaption>';
	echo '</figure>';
}
?>
