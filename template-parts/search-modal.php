<?php
// NOTE: included by `header-top.php`
?>
<div x-data="{ open: false }" class="flex justify-center">
	<!-- Trigger -->
	<span x-on:click="open = true">
		<button type="button" class="btn btn-ghost btn-icon text-red-500">
			<span class="sr-only"><?php _e('Search'); ?></span>
			l
		</button>
	</span>
	<!-- Modal -->
	<div x-show="open" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 z-50 overflow-y-auto">
		<!-- Overlay -->
		<div x-show="open" x-transition.opacity class="fixed inset-0 bg-primary/50 backdrop-blur transition-opacity opacity-100"></div>

		<!-- Panel -->
		<div x-show="open" x-transition x-on:click="open = false" class="relative flex min-h-screen items-center justify-center p-4">
			<div x-on:click.stop x-trap.noscroll.inert="open" class="relative w-full max-w-2xl overflow-y-auto rounded-xl shadow-lg">
				<!-- Title -->
				<h2 class="sr-only" :id="$id('modal-title')">Search</h2>

				<!-- Content -->
				<div>

				</div>


				<div class="relative p-10 bg-transparent">
					<div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none z-10">
						<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary dark_xxx:text-white" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
							<path fill="currentColor" d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14z" />
						</svg>
					</div>
					<label for="default-search" class="mb-2 text-primary sr-only dark:text-primary"><?php _e('Suche', BB_TEXT_DOMAIN); ?></label>
					<?php get_search_form(); ?>

				</div>
			</div>
		</div>
	</div>
</div>
