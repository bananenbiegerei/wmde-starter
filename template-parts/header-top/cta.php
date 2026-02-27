<ul class="flex flex-col items-center mb-4 space-y-3 md:flex-row md:space-x-2 md:space-y-0 md:mb-0">
    <?php if ( have_rows( 'call_to_actions', 'option' ) ) : ?>
    <?php while ( have_rows( 'call_to_actions', 'option' ) ) : the_row(); ?>
    <?php
        $link = get_sub_field( 'link' );
        $color = get_sub_field( 'color' ) ?: 'primary';
        $style = get_sub_field( 'style' );
        $icon = get_sub_field( 'icon' );
        $style_class = $style ? "btn-{$style}" : '';
    ?>
    <?php if ( $link ) : ?>
    <a class="w-full md:w-auto btn <?php echo $style_class; ?> btn-<?php echo $color; ?>" href="<?php echo esc_url( $link['url'] ); ?>"
        target="<?php echo esc_attr( $link['target'] ); ?>">
        <?php if ( $icon ) : echo bb_icon( $icon, 'icon-sm' ); endif; ?>
        <?php echo esc_html( $link['title'] ); ?>
    </a>
    <?php endif; ?>
    <?php endwhile; ?>
    <?php endif; ?>
</ul>