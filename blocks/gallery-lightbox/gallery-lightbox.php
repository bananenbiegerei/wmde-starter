<?php if (is_admin()): ?>
		<h2>Gallery Lightbox</h2>
		<div class="grid grid-cols-5 gap-4">
			<?php foreach (get_field('images') as $image): ?>
				<img class="h-32 object-contain" src="<?= wp_get_attachment_image_url($image['id'], 'thumbnail') ?>"/>
		<?php endforeach; ?>
	</div>
<?php else: ?>
	<div x-data="{ lightbox: false, imgModalSrc : '', imgModalAlt : '', imgModalDesc : '' }">
		<div class="flex -mx-2">
			<?php foreach (get_field('images') as $image): ?>
				<div class="w-1/6 px-2 cursor-pointer">
					<img
						class="block w-24 p-3 mb-4 text-white bg-gray-600 rounded object-cover h-full w-full"
						@click="$dispatch('lightbox',  {  imgModalSrc: '<?= $image['url'] ?>', imgModalAlt: '<?= $image['alt'] ?>', imgModalDesc: '<?= $image['description'] ?>' })"
						src="<?= $image['sizes']['medium'] ?>"
					>
					<img style="width: 0; height: 0"  src="<?= $image['url'] ?>">
				</div>
			<?php endforeach; ?>
		</div>

		<div x-show="lightbox" @lightbox.window="lightbox = true; imgModalSrc = $event.detail.imgModalSrc; imgModalDesc = $event.detail.imgModalDesc;">
			<div x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="fixed inset-0 z-50 flex items-center justify-center w-full p-2 overflow-hidden bg-black bg-opacity-75 h-100">
				<div @click.away="lightbox = ''" class="">
					<div class="z-50">
						<button @click="lightbox = ''" class="float-right pt-2 outline-none focus:outline-none">
							<svg class="fill-current text-white " xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
								<path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
								</path>
							</svg>
						</button>
					</div>
					<img class="max-h-[80vh] max-w-[80vw]" :src="imgModalSrc" :alt="imgModalAlt">
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
