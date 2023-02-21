<div id="<?= $block['id'] ?>"
	class="bb-newsletter-block rounded-3xl p-5 flex flex-col mb-10"
	style="background-color: <?= get_field('bg_color') ?>;">

		<div class="uppercase text-primary font-bold font-alt text-sm">
			<?= esc_html(get_field('heading')) ?>
		</div>

		<div class="font-alt font-light font-alt text-2xl text-inherit mb-5">
			<?= get_field('text') ?>
		</div>

		<form action="" method="post">
			<div class="flex flex-row gap-4  mb-3">
				<input class="text-sm" type="text" name="email" placeholder="Email">
				<label class="flex-shrink-0">
					<input class="hidden" type="submit">
					<span class="button inline-block text-lg">
						<?= _e('Register', BB_TEXT_DOMAIN) ?>
						<?= bb_icon('arrow-right') ?>
					</span>
				</label>
				</div>
		</form>

		<div class="font-alt font-light font-sans text-xs text-inherit h-full flex items-end">
			<?= get_field('disclaimer') ?>
		</div>

</div>
