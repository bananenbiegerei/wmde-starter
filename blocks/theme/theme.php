<?php
$theme = get_field('theme');
$color = get_field('color_for_theme', $theme->ID);
$related = get_field('related_links');
$thumbnail_url = get_the_post_thumbnail_url($theme, 'medium');
$theme_url = get_the_permalink($theme);
if( get_field('white_type') ):
	$type_color = 'text-white';
endif;
?>
<div class="bb-theme-block mb-10 lg:mb-20">
	<div class="rounded-3xl lg:px-10 lg:grid lg:grid-cols-12 overflow-hidden
	<?php if( get_field('white_type') ): ?>
		<?php echo $type_color; ?>
	<?php endif; ?>
	"
	style="background-color: <?= $color ?>;">
		<!-- Image -->
			<div class="lg:col-span-4">
				<div class="aspect-w-4 aspect-h-3 relative lg:-translate-x-10 rounded-tl-3xl rounded-br-3xl overflow-hidden">
					<?php
					  echo '<img class="w-full h-full object-cover" src="' . $thumbnail_url . '" />';
					?>
				</div>
			</div>
			<div class="lg:col-span-8 flex flex-col p-5 lg:p-0">
				<div class="pt-8">
					<!-- Theme or format -->
					<div class="uppercase font-bold font-alt text-sm <?php echo $type_color; ?>">
						<?= __('Theme', BB_TEXT_DOMAIN) ?>
						
					</div>
					<!-- Title -->
					<h2 class="text-2xl lg:text-3xl text-bg-related"><?= esc_html($theme->post_title) ?></h2>
				</div>

				<!-- Text -->
				<p class="font-normal flex-grow pr-5 pb-5 text-xl text-bg-related">
					<?= $theme->post_excerpt ?>
				</p>

				<!-- Button and extra info -->
				<div class="flex-1 flex items-end lg:pb-8">
					<a href="<?php echo $theme_url; ?>" class="btn btn-hollow">
						<?= bb_icon('arrow-right',''); ?>
						<?= __('Zum Thema', BB_TEXT_DOMAIN) ?>						
					</a>
				</div>

			</div>
	
			<!-- Related -->
			<?php if ( have_rows( 'related_links' ) ) : ?>
				<div class="col-span-12 my-10">
				<div class="lg:grid lg:grid-cols-3">
				<?php while ( have_rows( 'related_links' ) ) : the_row(); ?>
					<?php $link = get_sub_field( 'link' ); ?>
					<?php if ( $link ) : ?>
						<a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>">
						<?php if( get_sub_field('alt_meta_info') ): ?>
							<p class="uppercase font-bold font-alt text-sm <?php echo $type_color; ?>">
								<?php the_sub_field('alt_meta_info'); ?>
							</p>
						<?php endif; ?>
						<h3 class="text-base lg:text-xl text-bg-related">
						<?php echo esc_html( $link['title'] ); ?>
						</h3>
						</a>
					<?php endif; ?>
				<?php endwhile; ?>
				</div>
				</div>
			<?php endif; ?>

	</div>
</div>
