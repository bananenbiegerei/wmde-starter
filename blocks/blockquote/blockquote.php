<?php
$text = get_field('text');
$output = apply_filters('the_content', $text);
if ($text) :
?>

<div class="container grid grid-cols-12">
  <div class="col-span-8 col-start-3 relative">
    <blockquote class="text-xl lg:text-3xl leading-tight font-normal ml-32 mt-0 mb-5">
      <?php echo wp_kses($output, array()); ?>
    </blockquote>
    <?=bb_icon('quote','absolute -top-8 left-0 w-24 h-24')?>
    <?php if( get_field('source') ): ?>
      <cite class="ml-32 font-normal text-gray-400"><?php the_field('source'); ?></cite>
    <?php endif; ?>
  </div>
</div>
  
<?php endif; ?>