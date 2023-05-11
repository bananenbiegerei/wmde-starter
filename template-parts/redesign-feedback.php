<?php $FORMID = get_field('redesign_feedback_form_id', 'options'); ?>

<script>
	function setC() {
		document.cookie = 'redesign_feedback=1;expires=Tue, 19 Jan 2038 03:14:07 GMT;path="/"';
	}
	window.addEventListener('load', ( ) => {
		document.querySelector('#redesign-feedback-form button[type="submit"]').addEventListener('click', () => { setC(); });
	});

	function getCookie(name) {
			var nameEQ = name + "=";
			var ca = document.cookie.split(';');
			for(var i=0;i < ca.length;i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1,c.length);
					if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
			}
			return null;
	}
</script>

<div x-data="{ showObject: false }" x-show="showObject"
	x-init="() => { window.addEventListener('scroll', () => {
		if (window.scrollY > (window.innerHeight / 2) && !getCookie('redesign_feedback') ) { showObject = true; } });
	}">
	<div class="fixed bottom-10 right-10 bg-neon rounded-xl p-5 drop-shadow-xl z-50 flex flex-col justify-center max-w-sm" x-data="{ close: true }" x-show="close">
		<div class="flex gap-5">
			<p class="mb-0">
				Wie gefällt Ihnen unser Redesign? Ihre Meinung ist uns wichtig.
			</p>
			<div>
				<button x-on:click="close = ! close; setC();">
					<span class="sr-only">
						<?php _e('schliessen'); ?>
					</span>
					<?= bb_icon('x', 'icon-xs') ?>
					</button>
			</div>
		</div>
		<div id="redesign-feedback-form" >
			<?php echo do_shortcode("[wpforms id='{$FORMID}' title='false']"); ?>
		</div>
	</div>
</div>
