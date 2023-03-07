<div class="wikimedia-bubbles-container">
	<?php
	$team_tax = get_terms( array(
		'taxonomy' => 'team_category',
		'hide_empty' => false
	) );
	if ( !empty($team_tax) ) :
		foreach( $team_tax as $category ) {
			if( $category->parent == 0 ) { ?>
				<div class="bubble small <?php echo $category->slug; ?>">
					<button class="button clear">
						<?php echo $category->name; ?>
					</button>
				</div>
			<?php }
		}
	endif;
	?>
</div>