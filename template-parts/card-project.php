<div x-show="!selectedFilter || '<?php echo $classes; ?>' == selectedFilter" class="<?php echo $classes; ?> rounded-3xl mb-5 lg:mb-0  p-5 bg-gray z-10 relative">
	<?php include( locate_template( 'template-parts/card-project-inner.php', false, false ) ); ?>
</div>