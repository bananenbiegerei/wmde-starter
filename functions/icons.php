<?php

// FIXME: should be moved to blocks submodule?
function bb_icon($name, $classes = '')
{
	if ($name == 'none') {
		return;
	}
	$filename = get_stylesheet_directory() . "/img/icons/{$name}.svg";
	if (!file_exists($filename)) {
		return esc_html("{$name} not found");
	}

	// Read the SVG content from the file
	$svgContent = file_get_contents($filename);

	// Add role="presentation" and aria-hidden="true" attributes to the root <svg> element
	$svgContent = preg_replace('/<svg(.*?)>/i', '<svg$1 role="presentation" aria-hidden="true">', $svgContent);

	// Return the modified SVG within the <span> element
	return "<span class='bb-icon {$classes}'>{$svgContent}</span>";
}

// Inline an SVG media library attachment so its fill can follow the surrounding
// text color (an <img src="…svg"> ignores CSS color entirely). Falls back to a
// normal <img> for non-SVG attachments.
function bb_inline_svg_attachment($attachment_id, $classes = '')
{
	if (!$attachment_id || get_post_mime_type($attachment_id) !== 'image/svg+xml') {
		return wp_get_attachment_image($attachment_id, 'full', false, ['class' => $classes]);
	}

	$filename = get_attached_file($attachment_id);
	if (!$filename || !file_exists($filename)) {
		return wp_get_attachment_image($attachment_id, 'full', false, ['class' => $classes]);
	}

	$svgContent = file_get_contents($filename);

	// Only set a default fill if the root <svg> doesn't already declare one,
	// so intentionally multi-color icons are left alone.
	$svgContent = preg_replace('/<svg(?![^>]*\bfill=)([^>]*)>/i', '<svg$1 fill="currentColor">', $svgContent, 1);
	// Add role="presentation" and aria-hidden="true" attributes to the root <svg> element
	$svgContent = preg_replace('/<svg(.*?)>/i', '<svg$1 role="presentation" aria-hidden="true">', $svgContent, 1);

	return "<span class='bb-icon {$classes}'>{$svgContent}</span>";
}
