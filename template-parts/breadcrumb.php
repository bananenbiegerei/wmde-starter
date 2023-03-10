<?php

if (is_front_page() || is_404()) {
	return;
}

global $post;
$breadcrumbs = [];

if (is_archive()) {
	$breadcrumbs[] = '<li>' . post_type_archive_title('', false) . '</li>';
} elseif (is_page()) {
	if ($post->post_parent) {
		$anc = get_post_ancestors($post->ID);
		$anc = array_reverse($anc);
		if (!isset($parents)) {
			$parents = null;
		}
		foreach ($anc as $ancestor) {
			$breadcrumbs[] = '<li><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
		}
		echo $parents;
		$breadcrumbs[] = '<li>' . bb_icon('caret-right', 'text-red-500') . get_the_title() . '</li>';
	} else {
		$breadcrumbs[] = '<li>' . bb_icon('caret-right', 'text-red-500') . get_the_title() . '</li>';
	}
} elseif (get_post_type() == 'projects') {
	$breadcrumbs[] = '<li><a href="' . get_post_type_archive_link('projects') . '">' . __('Projects') . '</a></li>';
	$breadcrumbs[] = '<li>' . bb_icon('caret-right', 'text-red-500') . get_the_title() . '</li>';
}
?>

<div class="flex items-center h-16 mb-6">
	<ul class="menu horizontal breadcrumbs">
		<?= join('', $breadcrumbs) ?>
	</ul>
</div>










