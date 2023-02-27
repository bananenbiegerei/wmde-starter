<div class="bb-accordion-block container grid grid-cols-12">
	<ul class="col-span-12 lg:col-span-8 lg:col-start-3">
		<?php while (have_rows('acfb_add_accordion')): ?>
		<?php the_row(); ?>
		<li>
			<details>
				<summary class="font-alt text-xl py-7 cursor-pointer border-b border-gray-200 pr-10">
					<?php echo esc_html(get_sub_field('acfb_accordion_title')); ?>
				</summary>
				<div class="text-inherit text-base my-7 text-xl">
					<?php the_sub_field('acfb_accordion_content'); ?>
				</div>
			</details>
		</li>
		<?php endwhile; ?>
	</ul>
</div>