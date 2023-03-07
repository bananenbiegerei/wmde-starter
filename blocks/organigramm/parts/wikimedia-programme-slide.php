<?php $term_id = 2936;?>
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
			<ul class="no-bullet">
				<li>
					<a href="<?php the_permalink('45850') ?>/#programme">
						Programme
					</a>
				</li>
				<li>
					<a href="<?php the_permalink('45850') ?>/#bildung">
						Bildung, Wissenschaft & Kultur
					</a>
				</li>
				<li>
					<a href="<?php the_permalink('45850') ?>/#ideenfoerderung">
						Ideenförderung
					</a>
				</li>
				<li>
					<a href="<?php the_permalink('45850') ?>/#politik-recht">
						Politik & Recht
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>