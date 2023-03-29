<?php

$text_color = get_field('style_text_color_color_dark');
$text_color = $text_color == 'default' ? '' : $text_color;
if ($text_color) {
	$text_color = "text-{$text_color}";
}

$text_size = get_field('style_text_size');
?>

<div class="bb-paragraph-block mb-5 font-inherit <?= $text_color ?> <?= $text_size ?>">
		<?= get_field('paragraph') ?>
</div>
