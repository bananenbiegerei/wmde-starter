<?php
/**
 * Block template file: /Users/ingoschmid/Dropbox/BB SERVER/htdocs/wmde-redesign-23/app/public/wp-content/themes/wmde/template-parts/bb-blocks/spacer.php
 *
 * Spacer Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'spacer-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-spacer';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
?>
<?php
$height = ''; // set default value

if ( get_field('size') == 'xs' ) {
    $height = 'h-4';
}
if ( get_field('size') == 'sm' ) {
    $height = 'h-6';
}
if ( get_field('size') == 'base' ) {
    $height = 'h-10';
}
if ( get_field('size') == 'lg' ) {
    $height = 'h-20';
}
if ( get_field('size') == 'xl' ) {
    $height = 'h-40';
}

if ( $height ) { ?>
    <div id="<?php echo esc_attr( $id ); ?>" class="<?php echo $height; ?>">
    </div>
<?php }
?>

