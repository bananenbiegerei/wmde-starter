<div class="bb-blockquote-block relative flex gap-5">
  <div class="flex-none">
    <?= bb_icon('quote', 'icon-xxl') ?>
  </div>
  <div class="flex-1">
    <blockquote class="text-xl lg:text-3xl leading-tight font-normal mb-5">
      <?= get_field('text') ?>
    </blockquote>
    <?php if (get_field('source')): ?>
      <cite class="font-normal text-gray-400 block"><?= get_field('source') ?></cite>
    <?php endif; ?>
  </div>
</div>
