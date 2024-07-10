<?php
$home_url = is_home() ? 'https://www.wikimedia.de/' : get_home_url();
$logo_big = esc_attr(get_field('logo_big', 'options') ?: get_stylesheet_directory_uri() . '/img/wikimedia-logo.svg');
$logo_small = esc_attr(get_field('logo_small', 'options') ?: get_stylesheet_directory_uri() . '/img/wikimedia-logo-mini.svg');
?>


<div class="flex w-full items-center">

    <div>
        <a href="<?= $home_url ?>" class="hidden md:block">
            <img class="logo" style="max-height: 41px" src="<?= $logo_big ?>" alt="Wikimedia Logo">
        </a>
        <a href="<?= $home_url ?>" class="block md:hidden">
            <img style="max-height: 41px" src="<?= $logo_small ?>" alt="Wikimedia Logo">
        </a>
    </div>

    <div class="flex justify-end grow gap-5">
        <ul class="flex items-center space-x-2 md:space-x-5 mb-0">
            <?php if ( have_rows( 'call_to_actions', 'option' ) ) : ?>
            <?php while ( have_rows( 'call_to_actions', 'option' ) ) : the_row(); ?>
            <?php $link = get_sub_field( 'link' ); ?>
            <?php $link_color = get_sub_field( 'color' );?>
            <?php if ( $link ) : ?>
            <a class="btn btn-<?php echo $link_color; ?>" href="<?php echo esc_url( $link['url'] ); ?>"
                target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
            <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>