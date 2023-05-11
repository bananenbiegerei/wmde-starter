<?php $FORMID = get_field('redesign_feedback_form_id', 'options'); ?>

<?php if (!isset($_COOKIE['redesign_feedback'])): ?>
	<script>
		function setC() {
			document.cookie = 'redesign_feedback=1;expires=Tue, 19 Jan 2038 03:14:07 GMT';
		}
		window.addEventListener('load', ( ) => {
			document.querySelector('#redesign-feedback-form button[type="submit"]').addEventListener('click', () => { setC(); });
		});
	</script>

	<div x-data="{ showObject: false }" x-show="showObject" x-init="() => { window.addEventListener('scroll', () => { if (window.scrollY > (window.innerHeight / 2)) { showObject = true; } }); }">
		<div class="mx-10 lg:mx-0 fixed bottom-10 lg:right-10 bg-neon rounded-xl p-5 drop-shadow-xl z-50 flex flex-col justify-center max-w-sm" x-data="{ close: true }" x-show="close">
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
<?php else: ?>
	<?php setcookie('redesign_feedback', 1, time() + YEAR_IN_SECONDS); ?>
<?php endif; ?>
