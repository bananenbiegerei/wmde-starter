<?php
/**
 * Block template file: template-parts/blocks/paragraph-block.php
 *
 * Paragraph Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'paragraph-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Text Sizes
if( get_field('options') == 'small' ) { ?>
	<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> text-xs paragraph-block">
        <?php the_field( 'paragraph' ); ?>
    </div>
<?php }
if( get_field('options') == 'default' ) {?>
	<div id="<?php echo esc_attr( $id ); ?>" class="text-base paragraph-block">
        <?php the_field( 'paragraph' ); ?>
    </div>
<?php }
?>