<div class="bb-responsive-table-block">
	<table class="hover <?php echo get_field('has_fullwidth') ? 'fullwidth' : 'scroll hover'; ?>">
		<?php while (have_rows('rows')): ?>
  		<?php the_row(); ?>
			<?php if (get_sub_field('is_table_head')): ?>
				<?php if (have_rows('columns')): ?>
					<thead>
						<tr>
						<?php while (have_rows('columns')): ?>
      				<?php the_row(); ?>
							<th class="<?php echo get_sub_field('right_align') ? 'text-right' : ''; ?>">
				        <?php the_sub_field('column'); ?>
							</th>
						<?php endwhile; ?>
					</tr>
				</thead>
				<?php endif; ?>
			<?php else: ?>
				<?php if (have_rows('columns')): ?>
					<tbody>
						<tr>
							<?php while (have_rows('columns')): ?>
								<?php the_row(); ?>
								<td class="<?php echo get_sub_field('right_align') ? 'text-right' : ''; ?>"
									<?php the_sub_field('column'); ?>
								</td>
							<?php endwhile; ?>
						</tr>
					</tbody>
				<?php endif; ?>
			<?php endif; ?>
		<?php endwhile; ?>
	</table>
</div>
