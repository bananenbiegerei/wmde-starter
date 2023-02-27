<?php
$text = get_field('text');
$output = apply_filters('the_content', $text);
if ($text) :
?>

<div class="relative">
  <blockquote class="text-xl lg:text-4xl leading-tight font-normal ml-32 mt-12 mb-5">
    <?php echo wp_kses($output, array()); ?>
  </blockquote>
  <?=bb_icon('quote','absolute -top-8 left-0 w-24 h-24')?>
  <?php if( get_field('source') ): ?>
    <cite class="ml-32 font-normal text-gray-400"><?php the_field('source'); ?></cite>
  <?php endif; ?>
  
</div>
  
<?php endif; ?>