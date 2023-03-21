<?php
$members = [];
foreach (get_field('team_members') as $member_id) {
	$member = [
		'name' => get_the_title($member_id),
		'details' => get_field('details', $member_id),
		'email' => get_field('email', $member_id),
		'label_for_related_project' => get_field('label_for_related_project', $member_id),
		'related_project' => get_field('related_project', $member_id) ? get_field('related_project', $member_id) : [],
		'photo' => get_the_post_thumbnail($member_id, 'medium', null),
	];
	$member['related_project_ext'] = [];
	while (have_rows('related_project_ext', $member_id)) {
		the_row();
		$member['related_project_ext'][get_sub_field('title')] = get_sub_field('link');
	}
	$members[] = $member;
}
?>
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
				<?php foreach ($members as $member): ?>
					<div>
							<?= $member['photo'] ?>
							<div class="font-alt text-base text-inherit mt-2">
									<h4><?= $member['name'] ?></h4>
									<p class="margin-bottom-0 font-size-h4"><?= $member['details'] ?></p>
									<p><a href="mailto:<?= $member['email'] ?>">E-mail</a></p>
									<?php $related_project = $member['related_project']; ?>
									<?php $related_project_ext = $member['related_project_ext']; ?>
									<?php if ($related_project || $related_project_ext): ?>
										<?= $member['label_for_related_project'] ?>
										<ul>
											<?php foreach ($related_project as $post): ?>
												<li><a href="<?= get_permalink($post->ID) ?>"><?= get_the_title($post->ID) ?></a></li>
											<?php endforeach; ?>
											<?php foreach ($related_project_ext as $title => $url): ?>
												<li><a href="<?= $url ?>"><?= $title ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
							</div>
					</div>
				<?php endforeach; ?>
		</div>
