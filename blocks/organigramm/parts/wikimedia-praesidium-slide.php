<?php $term_id = 16426107;?>
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
			<h3><?php echo get_the_title('351') ?></h3>
			<p class="margin-bottom-0">
				Gehe zur Seite:
			</p>
			<ul class="no-bullet">
				<li>
					<a href="<?php the_permalink('351'); ?>">
						<?php echo get_the_title('351') ?>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>