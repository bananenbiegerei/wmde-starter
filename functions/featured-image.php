<?php function bb_featured_image()
{
	?>

	<div class="bb-image-block aspect-w-16 aspect-h-9">
		<figure class="w-full w-full">
			<?php bbWikimediaCommonsMedia::the_post_thumbnail('large', ['class' => 'rounded-3xl object-cover w-full h-full']); ?>
			<figcaption class="invisible flex absolute left-0 bottom-0 right-0 text-white bg-black w-auto h-auto z-20 p-2 text-sm flex items-start gap-4 break-all rounded-b-2xl">
				<?= bb_icon('info') ?> <div class="self-center"><?= bbWikimediaCommonsMedia::get_post_thumbnail_caption() ?></div>
			</figcaption>
		</figure>
	</div>

<?php
}

function bb_has_post_thumbnail()
{
	return bbWikimediaCommonsMedia::has_post_thumbnail();
}

?>
