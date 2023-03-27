<?php
$link = get_field('link') ? get_field('link') : ['title' => 'Missing Link!', 'url' => '#', 'target' => '_self'];
$style = get_field('display')['style'];
$size = get_field('display')['size'];
$position = get_field('display')['position'];
$color = get_field('display')['color'] ?? 'primary';
// FIXME: button colors not defined yet!
$icon = get_field('display')['icon'];
$icon_size = 'icon-' . explode('-', $size)[1];
?>

<div id="<?= $block['id'] ?>" class="bb-button-block flex <?= $position ?> <?= $size ?> <?= $icon ? 'btn-icon-left' : '' ?>">
	<a class="btn <?= $size ?> btn-<?= $color ?> <?= $style ?>" href="<?= esc_url($link['url']) ?>" target="<?= esc_attr($link['target']) ?>">
		<?= bb_icon($icon, $icon_size) ?>
		<?= esc_html($link['title']) ?>
	</a>
</div>

