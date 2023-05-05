<?php
/**
 * Block template file: template-parts/blocks/organigramm.php
 *
 * Organigramm Block Template.
 *
 */

$id = 'organigramm-' . $block['id']; ?>

<div id="<?php echo esc_attr($id); ?>" class="bg-gray mb-10 lg:mb-20 rounded-xl p-10 pt-0">
	<div id="<?php echo esc_attr($id); ?>" class="orga-scheme flex flex-col gap-10">
			<?php get_template_part('blocks/organigramm/partials/orga-header'); ?>
			<?php get_template_part('blocks/organigramm/partials/orga-middle'); ?>
			<?php get_template_part('blocks/organigramm/partials/orga-bottom'); ?>
	</div>
</div>
