<div x-data="{ showSearchInput: true }" class="flex flex-row-reverse items-center gap-2">
  <div>
	  <button class="btn btn-ghost" @click="showSearchInput = !showSearchInput">
		  <?= bb_icon('search') ?>
	</button>
  </div>
  <div x-show="showSearchInput" class="search-input" x-transition>
	<input type="text" placeholder="Search...">
  </div>
</div>
