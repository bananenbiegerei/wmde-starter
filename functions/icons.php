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
	return "<span class='bb-icon {$classes}'>" . file_get_contents($filename) . '</span>';
}
