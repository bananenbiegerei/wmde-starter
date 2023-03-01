<div class="bb-responsive-table-block">
	<table class="min-w-full divide-y divide-gray-300">
		<?php while (have_rows('rows')): ?>
  		<?php the_row(); ?>
			<?php if (get_sub_field('is_table_head')): ?>
				<?php if (have_rows('columns')): ?>
					<thead>
						<tr>
						<?php while (have_rows('columns')): ?>
      				<?php the_row(); ?>
							<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
				        <?php the_sub_field('column'); ?>
							</th>
						<?php endwhile; ?>
					</tr>
				</thead>
				<?php endif; ?>
			<?php else: ?>
				<?php /* if (have_rows('columns')): ?>
					<tbody>
						<tr class="bg-white even:bg-gray">
							<?php while (have_rows('columns')): ?>
								<?php the_row(); ?>
								<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
									<?php the_sub_field('column'); ?>
								</td>
							<?php endwhile; ?>
						</tr>
					</tbody>
				<?php endif; */ ?>
			<?php endif; ?>
		<?php endwhile; ?>
	</table>
</div>
