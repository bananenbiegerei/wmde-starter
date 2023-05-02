<?php
/**
 * Block template file: template-parts/blocks/article-loop-block.php.
 *
 * Article Loop Block Template.
 *
 * @param array  $block      the block settings and attributes
 * @param string $content    the block inner HTML (empty)
 * @param bool   $is_preview true during AJAX preview
 * @param   (int|string) $post_id The post ID this block is saved to
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'acf-block-text-image-float-' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

$image = get_field('bild');
$size = 'full';
$align = get_field('bild_ausrichtung') == 'links' ? 'float-left mr-6 mb-2' : 'float-right ml-6 mb-2';
?>

<div id="<?php echo esc_attr($id); ?>">

<?php if ($image): ?>
    <?php if (get_field('bildgrose')): ?>
        <style>
            <?php echo '#' . $id; ?> .acf-block-text-image-float > a > div,
            <?php echo '#' . $id; ?> .acf-block-text-image-float > div {
                width: <?php the_field('bildgrose'); ?>px;
                height: auto;
            }
        </style>
    <?php endif; ?>

    <div class="bb-text-image-float-block clearfix">

        <?php if (get_field('link_auf_bild')): ?>

        <?php
        $link = get_field('link_auf_bild');
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
            <div class="<?php echo $align; ?>"><?php echo wp_get_attachment_image($image, $size, ''); ?></div>
            </a>

        <?php the_field('text'); ?>

        <?php else: ?>

        <div class="<?php echo $align; ?>"><?php echo wp_get_attachment_image($image, $size, ''); ?></div>
                <?php the_field('text'); ?>
        <?php endif; ?>

    </div>
    <?php endif; ?>
</div>
