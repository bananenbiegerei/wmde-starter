<?php if ( have_rows( 'middle_section' ) ) : ?>
	<div class="flex flex-col sm:flex-row gap-5 items-center">
	<?php while ( have_rows( 'middle_section' ) ) : the_row(); ?>
		<?php if ( have_rows( 'circle_middle' ) ) : ?>
			<div class="w-3/4 sm:w-1/2 lg:w-1/3 sm:order-2">
				<div class="bg-red aspect-h-1 aspect-w-1 rounded-full text-white">
					<div class="w-full-h-full flex justify-center items-center">
						<div class="text-center">
						<?php while ( have_rows( 'circle_middle' ) ) : the_row(); ?>
							<h3>
								<?php the_sub_field( 'headline' ); ?>
							</h3>
							<?php if ( have_rows( 'people' ) ) : ?>
								<div class="grid grid-cols-2 divide-x divide-white">
								<?php while ( have_rows( 'people' ) ) : the_row(); ?>
									<h4 class="p-5">
										<?php the_sub_field( 'name' ); ?>
									</h4>
								<?php endwhile; ?>
								</div>
							<?php else : ?>
								<?php // No rows found ?>
							<?php endif; ?>
						<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
		
		
		
		<?php if ( have_rows( 'chapters_left' ) ) : ?>
			<div class="w-full sm:w-1/3 sm:order-1">
				<ul class="text-sm lg:text-md bg-cyan divide-y divide-white">
					<?php while ( have_rows( 'chapters_left' ) ) : the_row(); ?>
						<li class="p-2">
						<?php the_sub_field( 'text' ); ?>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
		<?php endif; ?>
		
		
		
		<?php if ( have_rows( 'chapters_right' ) ) : ?>
			<div class="w-full sm:w-1/3 sm:order-3">
				<ul class="text-sm lg:text-md bg-cyan divide-y divide-white">
				<?php while ( have_rows( 'chapters_right' ) ) : the_row(); ?>
					<li class="p-2">
					<?php the_sub_field( 'text' ); ?>
					</li>
				<?php endwhile; ?>
				</ul>
			</div>
		<?php endif; ?>

	<?php endwhile; ?>
	</div>
<?php endif; ?>