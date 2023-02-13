<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
	$anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}
?>

<div <?php echo $anchor; ?>
	class="bb-newsletter-block rounded-3xl p-4 flex flex-col mb-6"
	style="background-color: <?= get_field('bg_color') ?>;">

		<div class="uppercase text-primary font-bold text-base font-alt mb-0">
			<?= esc_html(get_field('heading')) ?>
		</div>

		<div class="font-alt font-light font-alt text-2xl text-inherit">
			<?= get_field('text') ?>
		</div>

		<form action="" method="post">
			<div class="mt-6 flex flex-row gap-4">
				<input class="text-sm" type="text" name="email" placeholder="Email">
				<label class="flex-shrink-0">
					<input class="hidden" type="submit">
					<span class="button inline-block text-lg hover:text-blue-700">
						<?= _e('Register', BB_TEXT_DOMAIN) ?>
						<?= bb_icon('arrow-right') ?>
					</span>
				</label>
				</div>
		</form>

		<div class="font-alt font-light font-sans text-xs text-inherit h-full flex items-end ">
			<?= get_field('disclaimer') ?>
		</div>

</div>
