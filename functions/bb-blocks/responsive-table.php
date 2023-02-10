<?php
acf_register_block_type([
	'name' => 'Responsive Table',
	'title' => __('Responsive Table'),
	'description' => __('Table block optimized for mobile'),
	'render_template' => 'template-parts/bb-blocks/responsive-table.php',
	'category' => 'wkmde-custom-blocks',
	'icon' => 'excerpt-view',
	'keywords' => [],
	'mode' => false,
]);
