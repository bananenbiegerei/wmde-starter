<?php if (class_exists('bbTeamMember') && ($args['name'] ?? '') !== ''): ?>
  <?php $author = new bbTeamMember($args); ?>
  <div class="flex flex-col gap-1 Xw-24">
    <?php /* NOTE: Enable when team member photos are available
    <div class="w-24 h-24 rounded overflow-hidden">
      <?= $author->get_photo('rounded-full h-full object-cover w-full team-members-scheme') ?>
    </div>
    */ ?>
    <p class="mb-0 font-bold text-sm">
      <?= esc_html($author->name) ?>
    </p>
  </div>
<?php endif; ?>
