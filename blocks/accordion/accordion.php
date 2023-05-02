<div class="bb-accordion-block mb-10">
	<ul>
		<?php while (have_rows('acfb_add_accordion')): ?>
		<?php the_row(); ?>
		<li>
			<details>
				<summary class="font-alt lg:text-xl py-6 cursor-pointer border-b border-gray-200 pr-10">
					<?php echo esc_html(get_sub_field('acfb_accordion_title')); ?>
				</summary>
				<div class="my-5 accordion-content">
					<?php the_sub_field('acfb_accordion_content'); ?>
				</div>
			</details>
		</li>
		<?php endwhile; ?>
	</ul>
</div>
