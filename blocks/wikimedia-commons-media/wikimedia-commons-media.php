<?php
// FIXME: requires Image block

$placeholder = esc_url(get_template_directory_uri() . '/blocks/wikimedia-commons-media/placeholder.svg');
$image_data = bbWikimediaCommonsMedia::get_media(get_field('media_url'));

if ($image_data && $image_data['type'] == 'image') {
	get_template_part('blocks/image/image', null, [
		'wmc_data' => $image_data,
		'wide' => get_field('style')['wide'] ?? false,
		'rounded' => get_field('style')['rounded'] ?? false,
	]);
} elseif ($image_data && $image_data['type'] == 'video') {
	// FIXME: set correct container for video..
	echo '<figure>';
	echo '<video preload="none" poster="' . $image_data['image'] . '" controls><source src="' . $image_data['media_url'] . '" type="' . $image_data['mime_type'] . '"></video>';
	echo '</figure>';
} else {
	echo '<figure>';
	echo "<img src='{$placeholder}'>";
	echo '<figcaption>' . __('Error: Unsupported or missing media', BB_TEXT_DOMAIN) . '</figcaption>';
	echo '</figure>';
}
?>
