<?php 
$post_title = get_the_title($p->ID); 
$post_date = get_the_date('d.m.Y', $p->ID);
?>
<div class="rounded-xl bg-gray p-5 flex flex-col divide-y">
  <p class="text-sm"><?php echo $post_date; ?></p>
  <h2 class="text-base pt-2"><?php echo $post_title; ?></h2>
</div>