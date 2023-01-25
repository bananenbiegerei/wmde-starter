<ul class="accordion acf-block-accordion" data-accordion data-multi-expand="true" data-allow-all-closed="true">
    <?php while (have_rows('acfb_add_accordion')) : the_row(); ?>
    <li class="accordion-item" data-accordion-item>
        <a href="#" class="accordion-title"><?php echo esc_attr(get_sub_field('acfb_accordion_title')); ?></a>
        <div class="accordion-content" data-tab-content>
            <?php // @TODO Bereinigung
        // ist das formatierter Text mit <p> etc.? Dann mit diesem Code ersetzen:
        // $text = get_sub_field('acfb_accordion_content');
        // if ($text) :
        //   $output = apply_filters('the_content', $text);
        //   echo wp_kses_post($output);
        // endif;
        the_sub_field('acfb_accordion_content');
        ?>
        </div>
    </li>
    <?php endwhile; ?>
</ul>