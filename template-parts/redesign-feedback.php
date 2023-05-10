<div class="fixed bottom-10 right-10 bg-neon rounded-xl p-5 drop-shadow-xl z-50 flex flex-col justify-center max-w-sm" x-data="{ open: false, close: true }" x-show="close">
	<div class="flex gap-5">
		<p>
			Wie gefällt Ihnen unser ReDesign? Ihre Meinung ist uns wichtig.
		</p>
		<div>
			<button x-on:click="close = ! close">
			<span class="sr-only">
				<?php _e('schliessen'); ?>
			</span>	
			<?= bb_icon('x', 'icon-xs'); ?>
			</button>
		</div>
	</div>
	<button x-on:click="open = ! open" x-bind:class="{ 'rotate-180': open }">
		<span class="sr-only">
			<?php _e('öffnen'); ?>
		</span>	
		<?= bb_icon('chevron-down-circle', 'icon-xl'); ?>
	</button>
	
	<div class="bg-neon-100 p-5 rounded-xl mt-2" x-show="open">
		<label class="block mb-2">
		  <span class="text-gray-700">Ihre Nachricht</span>
		  <textarea class="form-textarea mt-1 block w-full h-24" rows="3"></textarea>
		</label>
		<button class="btn btn-sm">
			Absenden
		</button>
	</div>
</div>