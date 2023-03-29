<?php
$members = [];
foreach (get_field('team_members') as $member_id) {
	$member = [
		'name' => get_the_title($member_id),
		'details' => get_field('details', $member_id),
		'email' => get_field('email', $member_id),
		'label_for_related_project' => get_field('label_for_related_project', $member_id),
		'related_project' => get_field('related_project', $member_id) ? get_field('related_project', $member_id) : [],
		'photo' => get_the_post_thumbnail($member_id, 'thumbnail', array('class' => 'rounded-lg  max-w-max w-full')),
		
	];
	$member['related_project_ext'] = [];
	while (have_rows('related_project_ext', $member_id)) {
		the_row();
		$member['related_project_ext'][get_sub_field('title')] = get_sub_field('link');
	}
	$members[] = $member;
}
?>
		<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
				<?php foreach ($members as $member): ?>
							<div class="sm:flex sm:gap-5">
								<div class="overflow-hidden basis-1/4 self-start">
									<?= $member['photo'] ?>
								</div>
								<div class="basis-3/4 -translate-y-1">
									<?php $related_project = $member['related_project']; ?>
									<?php $related_project_ext = $member['related_project_ext']; ?>
									<?php if ($related_project || $related_project_ext): ?>
										<?= $member['label_for_related_project'] ?>
										<ul>
											<?php foreach ($related_project as $post): ?>
												<li><a class="uppercase text-sm text-primary font-bold text-sm font-alt mb-2" href="<?= get_permalink($post->ID) ?>"><?= get_the_title($post->ID) ?></a></li>
											<?php endforeach; ?>
											<?php foreach ($related_project_ext as $title => $url): ?>
												<li><a class="uppercase text-xs text-primary font-bold text-sm font-alt mb-2" href="<?= $url ?>"><?= $title ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
										<h4 class="text-lg"><?= $member['name'] ?></h4>
										<p class="margin-bottom-0 text-lg"><?= $member['details'] ?></p>
										<p class="text-lg"><a href="mailto:<?= $member['email'] ?>">E-mail</a></p>
								</div>
							</div>
				<?php endforeach; ?>
		</div>
