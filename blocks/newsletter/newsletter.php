<div id="<?= $block['id'] ?>"
	class="bb-newsletter-block rounded-3xl p-10 flex flex-col mb-10 h-full"
	style="background-color: <?= get_field('bg_color') ?>;">

		<div class="topline">
			<?= esc_html(get_field('heading')) ?>
		</div>

		<div class="font-alt font-light font-alt text-2xl text-inherit mb-5">
			<div class="font-alt text-3xl">
				<?= get_field('text') ?>
			</div>
		</div>
		
		<form action="https://t874ad7c5.emailsys1a.net/191/2155/d537ac9314/subscribe/form.html" method="post">
					<ul class="grid grid-cols-2 gap-5">
						<li style="position:absolute; z-index: -100; left:-6000px;" aria-hidden="true">
							<label class="field_label required" for="rm_email"><?php pll_e('E-Mail:') ?> </label>
							<input type="text" class="form_field" name="rm_email" id="rm_email" value="" tabindex="-1" />
							<label class="field_label required" for="rm_comment">Comment: </label>
							<textarea class="form_field" name="rm_comment" tabindex="-1" id="rm_comment"></textarea>
						</li>
						<li class="col-span-2">
							<label class="field_label required text-sm font-bold" for="email"><?php pll_e('E-Mail:') ?> * </label>
							<input type="text" class="form_field" name="email" id="email" value="" />
						</li>
						<li id="firstname_form" class="basis-1/2">
							<label id="firstname_label" class="field_label text-sm font-bold" for="firstname"><?php pll_e('Vorname:') ?> </label>
							<input type="text" class="form_field" name="firstname" id="firstname" value="" />
						</li>
						<li id="lastname_form" class="basis-1/2">
							<label id="lastname_label" class="field_label text-sm font-bold" for="lastname"><?php pll_e('Nachname:') ?> </label>
							<input type="text" class="form_field" name="lastname" id="lastname" value="" />
						</li>
						<li class="form_button">
							<input type="submit" class="form_button_submit btn btn-lg" value="<?php pll_e('Anmelden') ?>" />
						</li>
					</ul>
		</form>

		<div class="font-alt font-light font-sans text-xs text-inherit h-full flex items-end">
			<?= get_field('disclaimer') ?>
		</div>

</div>
