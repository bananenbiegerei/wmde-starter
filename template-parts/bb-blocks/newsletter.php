<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
	$anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

//$meta = get_field('meta')['theme'] ? get_field('meta')['theme'] : get_field('meta')['format'];
?>

<div <?php echo $anchor; ?>
	class="bb-newsletter-block rounded-3xl p-4 mb-6 flex flex-col gap-8"
	style="background-color: <?= get_field('bg_color') ?>;">

		<!-- Theme or format -->
		<div class="uppercase text-primary font-bold text-base font-alt mb-0">
			<?= esc_html(get_field('heading')) ?>
		</div>

		<!-- Text -->
		<div class="font-alt font-light font-sans text-2xl text-inherit">
			<?= get_field('text') ?>
		</div>

		<!-- Button and extra info -->
		<form>
			<div class="mt-6 flex flex-row gap-4">
				<input type="text" name="email" placeholder="your@email.com">
					<input class="button hover:text-blue-700" type="submit" value="TEST">
			</div>
		</form>

		<div class="font-alt font-light font-sans text-xs text-inherit">
			<?= get_field('disclaimer') ?>
		</div>

</div>
