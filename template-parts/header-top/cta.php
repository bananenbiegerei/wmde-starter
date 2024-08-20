<ul class="flex flex-col md:flex-row items-center md:space-x-2 space-y-3 md:space-y-0 mb-4 md:mb-0">
    <?php if ( have_rows( 'call_to_actions', 'option' ) ) : ?>
    <?php while ( have_rows( 'call_to_actions', 'option' ) ) : the_row(); ?>
    <?php $link = get_sub_field( 'link' ); ?>
    <?php $link_color = get_sub_field( 'color' );?>
    <?php if ( $link ) : ?>
    <a class="w-full md:w-auto btn btn-<?php echo $link_color; ?>" href="<?php echo esc_url( $link['url'] ); ?>"
        target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
    <?php endif; ?>
    <?php endwhile; ?>
    <?php endif; ?>
</ul>