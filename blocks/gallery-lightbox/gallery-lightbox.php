<?php if (is_admin()): ?>
		<h2>Gallery Lightbox</h2>
		<div class="grid grid-cols-5 gap-4">
			<?php foreach (get_field('images') as $image): ?>
				<img class="h-32 object-contain" src="<?= wp_get_attachment_image_url($image['id'], 'thumbnail') ?>"/>
		<?php endforeach; ?>
	</div>
<?php else: ?>
	<div x-data="{ lightbox: false, imgModalSrc : '', imgModalAlt : '', imgModalCaption : '' }">
		<div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
			<?php foreach (get_field('images') as $image): ?>
				<div class="cursor-pointer">
					<img
						class="block rounded object-cover h-full w-full"
						@click="$dispatch('lightbox',  {  imgModalSrc: '<?= $image['url'] ?>', imgModalAlt: '<?= $image['alt'] ?>', imgModalCaption: '<?= $image['caption'] ?>' })"
						src="<?= $image['sizes']['medium'] ?>"
					>
					<img style="width: 0; height: 0"  src="<?= $image['url'] ?>">
				</div>
			<?php endforeach; ?>
		</div>

		<div x-show="lightbox" @lightbox.window="lightbox = true; imgModalSrc = $event.detail.imgModalSrc; imgModalCaption = $event.detail.imgModalCaption;">
			<div x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="fixed inset-0 z-50 flex items-center justify-center w-full p-2 overflow-hidden bg-black bg-opacity-75 h-100">
				<div @click.away="lightbox = ''" class="">
					<div class="z-50" >
						<!-- button @click="lightbox = ''" class="cursor-pointer float-right pt-2 outline-none focus:outline-none">
							<svg class="fill-current text-white " xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
								<path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
								</path>
							</svg>
						</button -->
					</div>
					<div class="bb-image-block" @click="lightbox = ''">
						<figure class="relative cursor-pointer">
							<img class="max-h-[80vh] max-w-[80vw] rounded-2xl" :src="imgModalSrc" :alt="imgModalAlt">
							<template x-if="imgModalCaption">
								<figcaption class="invisible absolute left-0 bottom-0 right-0 flex text-white bg-black w-auto h-auto z-20 p-2 text-sm flex items-start gap-4 break-all rounded-b-2xl">
									<?= bb_icon('info', 'flex-shrink-0') ?> <div class="self-center"x-text="imgModalCaption"></div>
								</figcaption>
							</template>
						</figure>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
