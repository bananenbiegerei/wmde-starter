<?php $meta = get_field('meta')['theme'] ? get_field('meta')['theme'] : get_field('meta')['format']; ?>

<div id="<?= $block['id'] ?>" class="bb-cta-block rounded-3xl p-5" style="background-color: <?= get_field('style')['bg_color'] ?>;">

	<div class="flex flex-wrap sm:flex-nowrap gap-8 h-full">

		<!-- Image -->
		<?php if (get_field('style')['image']): ?>
			<div class="basis-full sm:basis-1/4 flex-shrink-0">
				<?php echo wp_get_attachment_image(get_field('style')['image'], 'medium', false, ['class' => 'relative -translate-x-5 -translate-y-5 rounded-tl-3xl rounded-br-3xl']); ?>
			</div>
		<?php endif; ?>

		<!-- Content -->
		<div class="flex flex-col justify-between space-y-5">

			<div>
				<!-- Theme or format -->
				<?php if ($meta): ?>
				<div class="uppercase text-primary font-bold text-base font-alt">
					<?= esc_html($meta->name) ?>
				</div>
				<?php endif; ?>
				
				<!-- Title -->
				<?php if( get_field('content')['title'] ): ?>
					<h2 class="text-3xl pr-5">
						<?= esc_html(get_field('content')['title']) ?>
					</h2>
				<?php endif; ?>
			</div>
			

			<!-- Text -->
			<?php if( get_field('content')['text'] ): ?>
				<div class="font-alt font-light font-sans text-2xl text-inherit flex-grow pr-5 pb-10">
					<?= get_field('content')['text'] ?>
				</div>
			<?php endif; ?>
			

			<!-- Button and extra info -->
			<div>
				<?php if ( have_rows( 'button' ) ) : ?>
					<?php while ( have_rows( 'button' ) ) : the_row(); ?>
						<?php $link = get_sub_field( 'link' ); ?>
						<?php if ( $link ) : ?>
							<a class="btn btn-hollow -translate-y-5" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>">
							<?= bb_icon('arrow-right'); ?> <?php echo esc_html( $link['title'] ); ?>
							</a>
						<?php endif; ?>
						<?php the_sub_field( 'link_meta' ); ?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- Related -->
	<?php $related = get_field( 'related' ); ?>
	<?php if ( $related ) : ?>
		<div class="lg:grid lg:grid-cols-3 gap-10 p-10 pb-5">
		<?php foreach ( $related as $related ) : ?>
			<?php setup_postdata ( $related ); ?>
			<div>
				<?php
					$terms = get_the_terms( $related->ID, 'theme' );
					if ( $terms && ! is_wp_error( $terms ) ) :
						$term_names = array();
						foreach ( $terms as $term ) {
							$term_names[] = $term->name;
						}
						echo '<div class="uppercase text-primary font-bold text-base font-alt">' . implode( ', ', $term_names ) . '</div>';
					endif;
				?>
			<a href="<?php the_permalink(); ?>">
				<h3><?php echo get_the_title($related->ID); ?></h3>
			</a>
			</div>
		<?php endforeach; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>


</div>
