<?php if (class_exists('bbTeamMember')): ?>
	<?php $author = new bbTeamMember($args); ?>
	<div class="flex flex-col gap-1">
		<div class="w-24 h-24 rounded overflow-hidden">
			<?= $author->photo ?>
		</div>
		<p class="mb-0 font-bold text-sm">
			<?= esc_html($author->name) ?>
		</p>
	</div>
<?php endif; ?>
