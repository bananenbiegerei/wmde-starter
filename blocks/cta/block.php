<?php $meta = get_field('meta')['theme'] ? get_field('meta')['theme'] : get_field('meta')['format']; ?>

<div id="<?= $block['id'] ?>" class="bb-cta-block rounded-3xl p-10 grid grid-cols-12" style="background-color: <?= get_field('style')['bg_color'] ?>;">
	<!-- Image -->
	<?php if (get_field('style')['image']): ?>
		<div class="col-span-4">
			<div class="aspect-w-4 aspect-h-3 relative -translate-x-10 -translate-y-10 rounded-tl-3xl rounded-br-3xl overflow-hidden">
				<?php echo wp_get_attachment_image(get_field('style')['image'], 'medium', false, ['class' => 'w-full h-full object-cover']); ?>
			</div>
		</div>
		<div class="col-span-8 flex flex-col">
			<div>
				<!-- Theme or format -->
				<?php if ($meta): ?>
				<div class="uppercase text-primary font-bold text-base font-alt">
					<?= esc_html($meta->name) ?>
				</div>
				<?php endif; ?>
				
				<!-- Title -->
				<?php if( get_field('content')['title'] ): ?>
					<h2 class="text-4xl"><?= get_field('content')['title']; ?></h2>
				<?php endif; ?>
			</div>
			<!-- Text -->
			<?php if( get_field('content')['text'] ): ?>
				<div class="text-2xl text-inherit flex-grow pr-5 pb-5">
					<div class="font-alt text-2xl">
						<?= get_field('content')['text'] ?>
					</div>
				</div>
			<?php endif; ?>
			<!-- Button and extra info -->
			<div class="flex-1 flex items-end pb-10">
				<?php $link = get_field( 'cta_button_link' ); ?>
				<?php if ( $link ) : ?>
					<?php if ( have_rows( 'cta_button_display' ) ) : ?>
						<?php while ( have_rows( 'cta_button_display' ) ) : the_row(); ?>
							<a class="btn btn-icon-left <?php the_sub_field( 'style' ); ?> <?php the_sub_field( 'size' ); ?>" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>">
							<?php if ( have_rows( 'icon' ) ) : ?>
								<?php while ( have_rows( 'icon' ) ) : the_row(); ?>
									<?php if ( get_sub_field( 'has_icon' ) == 1 ) : ?>
										<?php $icon = get_sub_field( 'select_icon' ); ?>
										<?=bb_icon('arrow-right'); ?>
										<?php echo esc_html( $link['title'] ); ?>
									<?php else : ?>
										<?php echo esc_html( $link['title'] ); ?>
									<?php endif; ?>
								<?php endwhile; ?>
							<?php endif; ?>
							</a>							
						<?php endwhile; ?>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-span-12">
			<!-- Related -->
			<?php $related = get_field( 'related' ); ?>
			<?php if ( $related ) : ?>
				<div class="lg:grid lg:grid-cols-3">
				<?php foreach ( $related as $related ) : ?>
					<?php setup_postdata ( $related ); ?>
					<div class="pr-10">
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
	<?php endif; ?>
	
	<?php /* <div class="flex flex-wrap sm:flex-nowrap gap-8 h-full">

		<!-- Image -->
		<?php if (get_field('style')['image']): ?>
			<div class="basis-full sm:basis-1/4 flex-shrink-0">
				<?php echo wp_get_attachment_image(get_field('style')['image'], 'medium', false, ['class' => 'relative -translate-x-10 -translate-y-10 rounded-tl-3xl rounded-br-3xl']); ?>
			</div>
		<?php endif; ?>

		<!-- Content -->
		<div class="flex flex-col justify-between space-y-5 text-primary">

			<div>
				<!-- Theme or format -->
				<?php if ($meta): ?>
				<div class="uppercase text-primary font-bold text-base font-alt">
					<?= esc_html($meta->name) ?>
				</div>
				<?php endif; ?>
				
				<!-- Title -->
				<?php if( get_field('content')['title'] ): ?>
					<h2 class="text-4xl"><?= get_field('content')['title']; ?></h2>
				<?php endif; ?>
			</div>
			

			<!-- Text -->
			<?php if( get_field('content')['text'] ): ?>
				<div class="text-2xl text-inherit flex-grow pr-5 pb-5">
					<div class="font-alt text-2xl">
						<?= get_field('content')['text'] ?>
					</div>
				</div>
			<?php endif; ?>
			

			<!-- Button and extra info -->
			<div>
				<?php if ( have_rows( 'button' ) ) : ?>
					<?php while ( have_rows( 'button' ) ) : the_row(); ?>
						<?php $link = get_sub_field( 'link' ); ?>
						<?php if ( $link ) : ?>
							<a class="btn btn-icon-left" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>">
							<?= bb_icon('arrow-right'); ?> <?php echo esc_html( $link['title'] ); ?>
							</a>
						<?php endif; ?>
						<?php the_sub_field( 'link_meta' ); ?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div> */?>

	<!-- Related -->
	<?php /* $related = get_field( 'related' ); ?>
	<?php if ( $related ) : ?>
		<div class="lg:grid lg:grid-cols-3 gap-10">
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
	<?php endif; */ ?>


</div>
