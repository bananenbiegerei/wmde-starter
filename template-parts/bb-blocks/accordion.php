<div class="accordion acf-block-accordion m-5">
    <ul>
        <?php while (have_rows('acfb_add_accordion')): ?>
    	    <?php the_row(); ?>
            <li>
                <details>
                    <summary class="font-alt text-xl py-10 border-b border-gray-200"><?php echo esc_html(get_sub_field('acfb_accordion_title')); ?></summary>
                    <div class="text-inherit text-base my-9">
                        <?php the_sub_field('acfb_accordion_content'); ?>
                    </div>
                </details>
            </li>
        <?php endwhile; ?>
    </ul>
</div>
