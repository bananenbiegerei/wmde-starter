<button class="wikimedia-bubbles-close button icon">
	<i class="material-icons">
		arrow_back
	</i>
	<span class="icon-button-label"><?php pll_e('zurück'); ?></span>
</button>
<div class="grid-x grid-margin-x">
	<div class="cell medium-8 position-relative">
		<?php get_template_part("template-parts/blocks/organigramm/bubbles"); ?>
	</div>
	<div class="cell medium-4">
		<div class="has-white-background-color padding-1">
			<h2>
				<?php $term = get_term_by( 'id', $term_id, 'team_category' );
				?>
				<h3><?php echo $term->name; ?></h3>
			</h2>
			<p>
				<?php echo $term->description; ?>
			</p>
			<h3 class="h6">
				Ansprechpartner*innen
			</h3>
			<?php
			$taxonomy_name = 'team_category';
			$termchildren = get_term_children( $term_id, $taxonomy_name );

			echo '<ul class="no-bullet">';
			foreach ( $termchildren as $child ) {
				$term = get_term_by( 'id', $child, $taxonomy_name );
				echo '<li><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . '</a></li>';
			}
			echo '</ul>';
			?>
		</div>
	</div>
</div>