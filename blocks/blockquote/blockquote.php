<div class="bb-blockquote-block relative">
  <blockquote class="text-xl lg:text-3xl leading-tight font-normal ml-32 mt-0 mb-5">
    <?= get_field('text') ?>
  </blockquote>
  <?= bb_icon('quote', 'absolute top-0 left-8 icon-xxl') ?>
  <?php if (get_field('source')): ?>
    <cite class="ml-32 font-normal text-gray-400 block"><?= get_field('source') ?></cite>
  <?php endif; ?>
</div>
