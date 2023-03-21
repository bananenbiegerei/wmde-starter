<?php
$selected_publication = get_field('select_publication');
if( $selected_publication ): 
	$post_id = $selected_publication->ID;
	$post_title = get_the_title($post_id);
	$post_permalink = get_permalink($post_id);
	$post_excerpt = get_the_excerpt($post_id);
	$post_thumbnail = get_the_post_thumbnail($post_id, 'medium', array('class' => 'h-3/4 w-auto drop-shadow-xl'));
	$post_download = get_field('pdf', $post_id); // get ACF field
	?>
	<div class="bb-card-publication-block lg:grid lg:grid-cols-2 gap-5">
		<div class="rounded-3xl mb-10">
			<?php if ( $post_thumbnail ): ?>
				<div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-xl overflow-hidden">
					<div class="flex flex-col items-center justify-center">
						<?php echo $post_thumbnail; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div>
			<?php if ( get_field( 'hide_excerpt' ) ): ?>
				<a href="<?php echo $post_permalink; ?>">
					<h2 class="uppercase text-base text-primary font-bold text-sm font-alt"><?php echo $post_title; ?></h2>
				</a>		
			<?php else: ?>
			<a href="<?php echo $post_permalink; ?>">
				<h2 class="uppercase text-base text-primary font-bold text-sm font-alt"><?php echo $post_title; ?></h2>
				<p class="font-alt">
					<?php echo $post_excerpt; ?>
				</p>
			</a>
			<?php endif; ?>
			<a href="<?php echo $post_download; ?>" class="btn btn-xs btn-hollow btn-icon-left">
				<?= bb_icon('arrow-down') ?> <?php _e('Download', BB_TEXT_DOMAIN) ?>
			</a>
		</div>
	</div>
	
<?php endif; ?>
