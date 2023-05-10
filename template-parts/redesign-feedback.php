<div x-data="{ showObject: false }" x-show="showObject" x-init="() => {
	window.addEventListener('scroll', () => {
		if (window.scrollY > (window.innerHeight / 2)) {
			showObject = true;
		}
	});
}">
  <div class="fixed bottom-10 right-10 bg-neon rounded-xl p-5 drop-shadow-xl z-50 flex flex-col justify-center max-w-sm" x-data="{ close: true }" x-show="close">
	  <div class="flex gap-5">
		  <p class="mb-0">
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

	  <div>
		  <?php
		  echo do_shortcode('[wpforms id="59443" title="false"]');
		  ?>
	  </div>
  </div>
</div>