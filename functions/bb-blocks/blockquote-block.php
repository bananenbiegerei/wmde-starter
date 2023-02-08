<?php
$text = get_field('text');
$output = apply_filters('the_content', $text);
if ($text) :
?>
<?php if ( get_field( 'blury' ) == 1 ) : ?>
  <blockquote class="text-gray-200 text-xl lg:text-4xl leading-none font-menu blur-xs font-normal my-3">
    <?php echo wp_kses($output, array()); ?>
  </blockquote>
<?php else : ?>
  <blockquote class="text-xl lg:text-4xl leading-none font-menu font-normal my-3">
    <?php echo wp_kses($output, array()); ?>
  </blockquote>
<?php endif; ?>
  
<?php endif; ?>