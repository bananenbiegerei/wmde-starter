<div>
  <blockquote class="text-xl lg:text-3xl leading-tight font-normal ml-32 mt-0 mb-5">
    <?= get_field('text') ?>
  </blockquote>
  <?= bb_icon('quote', 'absolute -top-8 left-0 w-24 h-24') ?>
  <?php if (get_field('source')): ?>
    <cite class="ml-32 font-normal text-gray-400"><?= get_field('source') ?></cite>
  <?php endif; ?>
</div>
