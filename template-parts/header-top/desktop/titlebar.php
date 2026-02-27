<?php $titlebar_color = bb_get_component_color('titlebar_color'); ?>
<header aria-hidden="true" id="titlebar_desktop" class="hidden border-b border-neutral md:block nohover:hidden <?= $titlebar_color['class']; ?>" <?php if ($titlebar_color['style']): ?>style="<?= $titlebar_color['style']; ?>"<?php endif; ?>>
	<div class="container flex items-center py-3 mx-4">
		<?php get_template_part('template-parts/header-top/titlebar_content'); ?>
	</div>
</header>
