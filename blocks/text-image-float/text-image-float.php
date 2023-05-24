<?php
$image = get_field('bild');
$size = 'full';
$align = get_field('bild_ausrichtung') == 'links' ? 'float-left mr-6 mb-2' : 'float-right ml-6 mb-2';

if (get_field('link_auf_bild')) {
	$link = get_field('link_auf_bild');
	$link_url = $link['url'];
	$link_title = $link['title'];
	$link_target = $link['target'] ? $link['target'] : '_self';
}
?>

<div class="bb-text-image-float-block" id="<?= $block['id'] ?>">

<?php if ($image): ?>
  <?php if (get_field('bildgrose')): ?>
    <style>
      <?= '#' . $block['id'] ?> > div > a > div,
      <?= '#' . $block['id'] ?> > div > div {
        width: <?php the_field('bildgrose'); ?>px;
        height: auto;
      }
    </style>
  <?php endif; ?>

  <div class="clearfix">
    <?php if (get_field('link_auf_bild')): ?>
      <a href="<?= esc_url($link_url) ?>" target="<?= esc_attr($link_target) ?>">
        <div class="<?= $align ?>">
          <?php get_template_part('blocks/image/image', null, ['image' => ['id' => $image], 'rounded' => false]); ?>
        </div>
      </a>
      <?php the_field('text'); ?>
    <?php else: ?>
    <div class="<?= $align ?>">
      <?php get_template_part('blocks/image/image', null, ['image' => ['id' => $image], 'rounded' => false]); ?>
    </div>
      <?php the_field('text'); ?>
    <?php endif; ?>
  </div>
  <?php endif; ?>
</div>
