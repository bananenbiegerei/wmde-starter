<div id="<?= $block['id'] ?>"
	class="bb-newsletter-block rounded-3xl p-10 flex flex-col mb-10"
	style="background-color: <?= get_field('bg_color') ?>;">

		<div class="uppercase text-primary font-bold font-alt text-sm">
			<?= esc_html(get_field('heading')) ?>
		</div>

		<div class="font-alt font-light font-alt text-2xl text-inherit mb-5">
			<div class="font-alt text-4xl">
				<?= get_field('text') ?>
			</div>
		</div>

		<form action="" method="post">
			<div class="flex flex-row gap-4  mb-3">
				<input class="text-sm" type="text" name="email" placeholder="Email">
				<label class="flex-shrink-0">
					<input class="hidden" type="submit">
					<span class="btn btn-lg btn-icon-left">
						<?= bb_icon('arrow-right') ?>
						<?= _e('Register', BB_TEXT_DOMAIN) ?>
					</span>
				</label>
				</div>
		</form>

		<div class="font-alt font-light font-sans text-xs text-inherit h-full flex items-end">
			<?= get_field('disclaimer') ?>
		</div>

</div>
