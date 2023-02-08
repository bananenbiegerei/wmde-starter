<?php
/**
 * Block template file: template-parts/blocks/paragraph-block.php
 *
 * Heading Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'heading-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
	$id = $block['anchor'];
}
?>
<?php if ( get_field( 'headline_size' ) ):
$size = get_field('headline_size');    
?>
<div id="<?php echo esc_attr( $id ); ?>" class="headline-block">
    <<?php the_field( 'options' ); ?> class="<?php the_field('headline_size'); ?> mb-1 text-base">
        <?php the_field( 'headline' ); ?>
    </<?php the_field( 'options' ); ?>>
</div>

<?php endif; ?>
