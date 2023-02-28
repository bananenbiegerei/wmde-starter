<?php

$link = get_field('link') ? get_field('link') : ['title' => 'Missing Link!', 'url' => '#', 'target' => '_self'];
$style = get_field('display')['style'];
$size = get_field('display')['size'];
$position = get_field('display')['position'];
$color = get_field('display')['color'] ?? 'primary';
$icon = get_field('display')['icon'];
?>

<div id="<?= $block['id'] ?>" class="bb-button-block flex <?= $position ?> <?= $size ?>">
	<a class="btn btn-<?= $size ?> btn-<?= $color ?> <?= $style ?>" href="<?= esc_url($link['url']) ?>" target="<?= esc_attr($link['target']) ?>">
		<?= bb_icon($icon) ?>
		<?= esc_html($link['title']) ?>
	</a>
</div>

